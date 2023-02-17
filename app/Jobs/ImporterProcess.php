<?php

namespace App\Jobs;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Color;
use App\Models\Importer;
use App\Models\ImporterProductMap;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Upload;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ImporterProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $importer;
    public $data;

    public function __construct($data, $importer)
    {
        $this->data = $data;
        $this->importer = $importer;
    }

    public function handle()
    {
        foreach ($this->data as $product) {
                $product = $this->store($product,  $this->importer);
        }
    }

    public function store(array $data, int $importId)
    {
        $collection = collect($data);

        $productExits = ImporterProductMap::where('scrapper_id', $collection['scrapper_id'])->first();

            $scrape_data = array();
            if (isset($collection['scrapper_id'])) {
                $scrape_data['scrapper_id'] = $collection['scrapper_id'];
                unset($collection['scrapper_id']);
            }
            if (isset($collection['scrapper_url'])) {
                $scrape_data['scrapper_url'] = $collection['scrapper_url'];
                unset($collection['scrapper_url']);
            }

            if (!isset($collection['description'])) {
                $collection['description'] = '';
            }

            $approved = 1;
            if (isset($collection['added_by'])) {
                $user_id = $collection['added_by'];
                $collection['user_id'] = $collection['added_by'];
                $collection['added_by'] = 'seller';

            } else {
                $user_id = User::where('user_type', 'admin')->first()->id;
            }


            $tags = array();
            if (isset($collection['tags']) && $collection['tags'][0] != null) {
                foreach (json_decode($collection['tags'][0]) as $key => $tag) {
                    array_push($tags, $tag->value);
                }
            }
            $collection['tags'] = implode(',', $tags);
            $discount_start_date = null;
            $discount_end_date = null;
            if (isset($collection['date_range']) && $collection['date_range'] != null) {
                $date_var = explode(" to ", $collection['date_range']);
                $discount_start_date = strtotime($date_var[0]);
                $discount_end_date = strtotime($date_var[1]);
            }
            unset($collection['date_range']);




            if (isset($collection['thumbnail_img'])) {

                if (isset($collection['photos'])) {
                    $collection['photos'] = $this->downloadGalleryImages($collection['photos']);
                }
                else
                {
                    $collection['photos'] = $this->downloadGalleryImages($collection['thumbnail_img']);
                }

                $collection['thumbnail_img'] = $this->downloadThumbnail($collection['thumbnail_img']);

            }


            if (!isset($collection['meta_title']) || $collection['meta_title'] == null) {
                $collection['meta_title'] = $collection['name'];
            }
            if (!isset($collection['meta_description']) || $collection['meta_description'] == null) {
                $collection['meta_description'] = strip_tags($collection['description']);
            }

            if (!isset($collection['meta_img']) || $collection['meta_img'] == null) {
                $collection['meta_img'] = $collection['thumbnail_img'];
            }


            $shipping_cost = 0;
            if (isset($collection['shipping_type'])) {
                if ($collection['shipping_type'] == 'free') {
                    $shipping_cost = 0;
                } elseif ($collection['shipping_type'] == 'flat_rate') {
                    $shipping_cost = $collection['flat_shipping_cost'];
                }
            }
            unset($collection['flat_shipping_cost']);

            $slug = Str::slug($collection['name']);
            $same_slug_count = Product::where('slug', 'LIKE', $slug . '%')->count();
            $slug_suffix = $same_slug_count ? '-' . $same_slug_count + 1 : '';
            $slug .= $slug_suffix;

            $colors = array();
            $choice_options = array();
            $choice_attributes = array();
            $attributes = array();
            if (isset($collection['choice'])) {
                $arrayI = 0;
                foreach ($collection['choice'] as $key => $choice) {

                    if ($key == 'color') {
                        $filters = array();
                        foreach ($choice as $filter) {
                            $filters[] = str_replace(' ', '', $filter);
                        }

                        $colors = Color::whereIn('name', $filters)->get()->pluck('code')->toArray();
                    } else {

                        $getAttr = Attribute::where('name', $key)->first();
                        if ($getAttr) {

                            $choice_attributes[] = $getAttr->id;
                            $attributes[] = $getAttr->id;
                        } else {

                            $getAttr = new Attribute();
                            $getAttr->name = $key;
                            $getAttr->save();
                            $choice_attributes[] = $getAttr->id;
                            $attributes[] = $getAttr->id;
                        }

                        $choice_options[$arrayI]['attribute_id'] = $getAttr->id;
                        $choice_options[$arrayI]['values'] = $choice;
                        $arrayI++;
                    }

                }
            }

            $colors = json_encode($colors);
            $choice_options = json_encode($choice_options);
            $choice_attributes = json_encode($choice_attributes);
            $attributes = json_encode($attributes);

            if (isset($collection['category'])) {
                $collection['category_id'] = $this->getCateID($collection['category']);
                unset($collection['category']);

            }



            $published = 1;

            $data = $collection->merge(compact(
                'user_id',
                'approved',
                'discount_start_date',
                'discount_end_date',
                'shipping_cost',
                'slug',
                'colors',
                'choice_options',
                'choice_attributes',
                'attributes',
                'published',
            ))->toArray();

        unset($data['choice_attributes']);

        if(!$productExits){
            $product = Product::create($data);
            if ($product) {
                $productScrape = new ImporterProductMap();
                $productScrape->link = $scrape_data['scrapper_id'];
                $productScrape->scrapper_id = $scrape_data['scrapper_id'];
                $productScrape->product_id = $product->id;
                $productScrape->importer_id = $importId;
                $productScrape->save();

                ProductStock::create([
                    'product_id' => $product->id,
                    'qty' => $data['current_stock'],
                    'price' => $data['unit_price'],
                    'sku' => (isset($data['sku']) ?  $data['sku']  :$scrape_data['scrapper_id'].rand(4,6)) ,
                    'variant' => '',
                ]);

                $importer = Importer::find($importId);
                $importer->completed_records = $importer->completed_records + 1;
                $importer->save();

            }

        }
        else
        {
            Product::where('id', $productExits->product_id)->update($data);
            ProductStock::where('product_id',$productExits->product_id)->delete();
            ProductStock::create([
                'product_id' => $productExits->product_id,
                'qty' => $data['current_stock'],
                'price' => $data['unit_price'],
                'sku' => (isset($data['sku']) ?  $data['sku']  :$scrape_data['scrapper_id'].rand(4,6)) ,
                'variant' => '',
            ]);

        }
    }

    public function downloadThumbnail($url)
    {
        try {
            $upload = new Upload;
            $upload->external_link = $url;
            $upload->type = 'image';
            $upload->save();

            return $upload->id;
        } catch (\Exception $e) {
        }
        return null;
    }

    public function downloadGalleryImages($urls)
    {
        $data = array();
        foreach (explode(',', str_replace(' ', '', $urls)) as $url) {
            $data[] = $this->downloadThumbnail($url);
        }
        return implode(',', $data);
    }


    public function getCateID($collection){
        $id = null;
        $category = explode('>', $collection);
        $parent_id = 0;
        $arrIndex = 0;
        $count = count($category);
        foreach ($category as $cate)
        {
            $getCate = Category::where('name', $cate)->where('parent_id', $parent_id)->first();
            if($getCate){
                $id = $getCate->id;
                $getCate->parent_id = $parent_id;

                $slug = createSlug($getCate->name);
                $same_slug_count = Category::where('slug', 'LIKE', $slug . '%')->count();
                $slug_suffix = --$same_slug_count ? '-' . $same_slug_count + 1 : '';
                $slug .= $slug_suffix;
                $getCate->slug = $slug;
                $getCate->save();

            }else
            {
                $getCate = new Category();
                $getCate->name = $cate;
                $getCate->parent_id = $parent_id;
                $slug = createSlug($getCate->name);
                $same_slug_count = Category::where('slug', 'LIKE', $slug . '%')->count();
                $slug_suffix = $same_slug_count ? '-' . $same_slug_count + 1 : '';
                $slug .= $slug_suffix;
                $getCate->slug = $slug;
                $getCate->save();


            }
            $parent_id = $getCate->id;
        }

        return $id;

    }


}
