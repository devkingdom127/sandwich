<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsFeature extends Model
{
    public $table = "products_feature";

    public $fillable = ['id','name',
        'type',
        'summary',
        'avatar',
        'language_id',
        'user_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function Products(){
        return $this->belongsTo(Products::class,"products_id","id");
    }

}
