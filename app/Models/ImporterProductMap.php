<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImporterProductMap extends Model
{
    protected $with = ['products'];

    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }


    public static function boot() {

        parent::boot();

        static::deleting(function($maps) {
            $maps->products()->stocks()->delete();
            $maps->products()->delete();
        });
    }
}
