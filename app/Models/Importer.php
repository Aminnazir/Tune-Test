<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use Illuminate\Database\Eloquent\SoftDeletes;

class Importer extends Model
{

    use  SoftDeletes;


    protected $with = ['maps'];

    public function maps()
    {
        return $this->hasMany(ImporterProductMap::class, 'importer_id', 'id');
    }

    public static function boot() {

        parent::boot();

        static::deleting(function($importer) {
         /*   $importer->maps()->products()->delete;
            $importer->maps()->delete();*/
        });
    }

}
