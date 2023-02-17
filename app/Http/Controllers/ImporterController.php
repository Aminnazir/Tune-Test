<?php

namespace App\Http\Controllers;

use App\Forms\ImporterForm;
use App\Jobs\ImporterProcess;
use App\Lib\FormBuilder\FormBuilder;
use App\Models\Importer;
use App\Models\ImporterProductMap;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use stdClass;

class ImporterController extends Controller
{

    protected $productService;

    private function pagination(){

        $pagination = new stdClass();
        $pagination->column = $this->column();
        $pagination->actions = $this->actions();
        $pagination->route = \request()->getRequestUri();
        return   $pagination;
    }


    public function actions(){

        $return =  array(
            array(
                'type' => 'add',
                'label' => 'Add New Import',
                'icon' => 'add',
                'route'=> 'importer.create',
                'ajax'=> 1,
                'title'=> "Add new import",
            ),
            array(
                'type' => 'settings',
                'label' => 'Settings',
                'icon' => 'setting',
                'route'=> 'importer.settings',
                'title'=> "Import Settings",
            ),
            array(
                'type' => 'edit',
                'label' => 'Edit',
                'icon' => 'edit',
                'route'=> 'importer.edit',
                'title'=> "Import Edit",
            ),
            array(
                'type' => 'delete',
                'label' => 'Delete',
                'icon' => 'trash',
                'route'=> 'importer.destroy',
            )
        );

        return json_decode(json_encode($return));
    }

    public function column(){

        $index = 0;
        $column[$index] = new stdClass;
        $column[$index]->data = 'id';
        $column[$index]->title = 'ID';

        $column[++$index] = new stdClass;
        $column[$index]->data = 'name';
        $column[$index]->title = 'Name';
        $column[$index]->render = function ($row){
            return '<span>'.$row->name.'</span>';
        };

        $column[++$index] = new stdClass;
        $column[$index]->data = 'type';
        $column[$index]->title = 'Type';

        $column[++$index] = new stdClass;
        $column[$index]->data = 'total_records';
        $column[$index]->title = 'Total Products';

        $column[++$index] = new stdClass;
        $column[$index]->data = 'completed_records';
        $column[$index]->title = 'Completed Records';

        $column[++$index] = new stdClass;
        $column[$index]->data = 'action';
        $column[$index]->title = 'Action';


        return $column;

    }

    private function productPagination(){

        $pagination = new stdClass();
        $pagination->column = $this->productColumn();
        $pagination->actions = $this->productActions();
        $pagination->route = \request()->getRequestUri();
        return   $pagination;
    }


    public function productActions(){

        $return =  array(

            array(
                'type' => 'edit',
                'label' => 'Edit',
                'icon' => 'edit',
                'route'=> 'importer.edit',
                'title'=> "Import Edit",
            )
        );

        return json_decode(json_encode($return));
    }

    public function productColumn(){

        $index = 0;
        $column[$index] = new stdClass;
        $column[$index]->data = 'id';
        $column[$index]->title = 'ID';
        $column[$index]->render = function ($row){
            return $row->products->id;

        };

        $column[++$index] = new stdClass;
        $column[$index]->data = 'products';
        $column[$index]->title = 'Product Name';
        $column[$index]->render = function ($row){
            return '<div class="d-flex align-items-center">
            <img src="../../demo/assets/img/icons/products/oneplus.png" alt="Oneplus" height="32" width="32" class="me-2">
            <div class="d-flex flex-column">
            <span class="fw-semibold lh-1">'.$row->products->name.'</span>
           <div>
            <span class="mr-3 badge bg-label-success">'.$row->products->category->name.'</span>'.($row->products->category->parentCategory ? ' <span class="badge bg-label-success">'.$row->products->category->parentCategory->name.'</span>' : '').'</span>
        </div>
            </div>
            </div>';

        };

        $column[++$index] = new stdClass;
        $column[$index]->data = 'Price';
        $column[$index]->title = 'Price';
        $column[$index]->render = function ($row){
            return '<span class="text-primary fw-semibold">'.$row->products->unit_price.'</span>';
        };


        $column[++$index] = new stdClass;
        $column[$index]->data = 'slug';
        $column[$index]->title = 'Slug';
        $column[$index]->render = function ($row){
            return $row->products->slug;
        };

        $column[++$index] = new stdClass;
        $column[$index]->data = 'action';
        $column[$index]->title = 'Action';


        return $column;

    }

    public function __construct(ProductService $productService)
    {
        $this->middleware('auth');
        $this->productService = $productService;
    }

    public function index(Request $request){
        $data = $this->data($request);
        $pagination = $this->pagination();

        if($request->ajax() || $request->wantsJson())
        {
            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'html' => view('common.paginate',compact('data', 'pagination'))->render(),
            ]);

        }else
        {
            return view('pages.importer.index', compact('data', 'pagination'));
        }
    }

    public function create(FormBuilder $formBuilder,Request $request){

        $form = $formBuilder->create(ImporterForm::class, [
            'method' => 'POST',
            'url' => route('importer.store'),
            'class' => 'ss-validation',
            'id' => 'add-import'

        ]);


        $ajax = false;
        if($request->ajax() || $request->wantsJson())
        {
            $ajax = true;
            return response()->json([
                'status' => 1,
                'message' => 'success',
                'html' => view('common.create', compact('ajax', 'form'))->renderSections()['content'],
            ]);

        }else
        {

            return view('common.create', compact('ajax', 'form'));
        }

    }

    public function store(FormBuilder $formBuilder, Request $request){

        $form = $formBuilder->create(\App\Forms\ImporterForm::class);

        if (!$form->isValid()) {


            return response()->json([
                'status' => false,
                'message' => 'success',
                'errors' => $form->getErrors(),
            ], 400);

            //     return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $filePath = null;
        if($file = $request->file('file'))
        {

            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('ImportsFiles', $fileName, 'public');

        }

        $newImport = new Importer();
        $newImport->name = $request->name;
        $newImport->type = $request->type;
        $newImport->file = $filePath;
        $newImport->url = $request->url;
        $newImport->save();

        return response()->json([
            'status' => 1,
            'message' => 'New Import Added Successfully ',
            'url' => route('importer.settings', $newImport->id),
        ], 200);

    }

    public function show(){

        echo 'show Not Implemented';
    }

    public function update(Request $request){

        echo 'update Not Implemented';
    }

    public function destroy($id){

        $importer = Importer::findOrFail($id);
        $importer->delete();

        return redirect()->back()->with('success', 'Importer record deleted');

    }

    public function settings($id){
        $importerHeader = null;
        $url = null;
        $importer = Importer::findOrFail($id);
        if($importer->type  == 'file'){
            $file = storage_path('/app/public/'.$importer->file);
            $importerHeader = $this->importHeader($file);
        }

        $productImportHeader = $this->productImportHeader();

        return view('pages.importer.settings', compact('importer', 'importerHeader', 'productImportHeader'));
    }

    public function settingStore($id, Request $request){

        $importer = Importer::findOrFail($id);
        $fields =   $request->all();
        unset($fields['_token']);
        $importer->maps = $fields;
        $importer->save();
        return redirect()->back()->with('success', 'Importer Maps Successfully');

    }

    public function runImport($id, Request $request){
        $importer = Importer::findOrFail($id);
        $importer->started_at = Carbon::now();
        $importer->save();
        if($importer->type  == 'file'){
            $file = storage_path('/app/public/'.$importer->file);
            $data = $this->csvToArray($file);
            $chunks = array_chunk($data,100);

            $products = [];
            $batch  = Bus::batch([])->dispatch();
            $maps = json_decode($importer->maps, true);
            foreach ($chunks as $chunksKey => $chunk) {
                foreach ($chunk as $chunkKey => $chackData) {
                    $product = [];
                    foreach ($chackData as $rowKey => $row)
                    {

                        if(isset($maps[$rowKey]))
                        {
                            if (str_contains($rowKey, 'choice')) {
                                $choice_key = str_replace('choice_', '', $rowKey);
                                $product['choice'][$choice_key] = explode(',', $row);
                            }
                            else{
                                $product[$maps[$rowKey]] = $this->sanitize($row);
                            }
                        }

                    }
                    $products[] = $product;
                }


                $batch->add(new ImporterProcess($products,$importer->id));
            }
        }

        $importer->total_records = count($data, $importer->id);
        $importer->save();

        $ajax = false;
        if($request->ajax() || $request->wantsJson())
        {
            $ajax = true;
            return response()->json([
                'status' => 1,
                'message' => 'Prouct Importing Start',
                'html' => view('pages.importer.run-import', compact('ajax', 'importer'))->renderSections()['content'],
            ]);

        }else
        {

            return view('pages.importer.run-import', compact('ajax', 'importer'));
        }


    }

    public function viewProducts($id, Request $request){


        $data = $this->productsData($id, $request);
        $pagination = $this->productPagination();

        if($request->ajax() || $request->wantsJson())
        {
            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'html' => view('common.paginate',compact('data', 'pagination'))->render(),
            ]);

        }else
        {
            return view('pages.importer.products', compact('data', 'pagination'));
        }
        $data = $this->productsData($id, $request);
        $pagination = $this->productPagination();

        return view('pages.importer.products', compact('data', 'pagination'));
    }

    public function deleteProducts($id){

        $maps = ImporterProductMap::where('importer_id', $id)->delete();

        $importer = Importer::find($id);
        $importer->completed_records = 0;
        $importer->save();
        return response()->json([
            'status' => 1,
            'message' => 'Imported Products Deleted',
            'data' => $maps,

        ]);

    }

    public function productsData($id, Request $request){
        $data = ImporterProductMap::where('importer_id', $id)->orderBy('id', 'desc');
        //Keyword Search
        if ($request->has('search')){
            $sort_search = $request->search;
            //  $categories = $data->where('name', 'like', '%'.$sort_search.'%');
        }

        $data = $data->paginate(15);

        return $data;
    }

    public function data(Request $request){

        $data = Importer::orderBy('id', 'desc');
        //Keyword Search
        if ($request->has('search')){
            $sort_search = $request->search;
            $categories = $data->where('name', 'like', '%'.$sort_search.'%');
        }

        $data = $data->paginate(15);

        return $data;
    }


    private function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    private function importHeader($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    break;
            }
            fclose($handle);
        }

        return $header;
    }

    private function productImportHeader()
    {
        $fields =[
            "name",
            "category",
            "brand",
            "unit",
            "weight",
            "min_qty",
            "tags",
            "photos",
            "added_by",
            "thumbnail_img",
            "photos",
            "video_provider",
            "video_link",
            "unit_price",
            "date_range",
            "discount",
            "discount_type",
            "current_stock",
            "sku",
            "external_link",
            "hidden_external_link",
            "external_link_btn",
            "description",
            "pdf",
            "meta_title",
            "meta_description",
            "meta_img",
            "shipping_type",
            "flat_shipping_cost",
            "low_stock_quantity",
            "stock_visibility_state",
            "flash_deal_id",
            "flash_discount",
            "flash_discount_type",
            "est_shipping_days",
            "tax_id",
            "tax",
            "tax_type",
            "todays_deal",
            "choice",
            "attibute",
            "scrapper_id",
            "scrapper_url",
        ];

        return $fields;
    }

    private function sanitize($line){
        $clean = iconv('utf-8', 'us-ascii//IGNORE', $line); // attempt to translate similar characters
        //  $clean = preg_replace('/[^\w]/', '', $clean); // drop anything but ASCII
        return $clean;
    }
}
