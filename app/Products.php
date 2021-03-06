<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $table = "products";

    public $fillable = ['id','name',
        'type',
        'summary',
        'avatar',
        'language_id',
        'user_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function Restaurant(){
        return $this->belongsTo(Restaurant::class,"restaurant_id","id");
    }

    public function ProductsCategory(){
        return $this->hasMany(ProductsCategory::class,"products_id","id");
    }

    public function ProductsFeature(){
        return $this->hasMany(ProductsFeature::class,"products_id","id");
    }

    public function Orders(){
        return $this->hasMany(OrderProducts::class,"products_id","id");
    }

    public function date(){
        return date_format($this->created_at,'d m,Y');
    }

    public function img(){
        return env('PATH_IMAGE').$this->avatar;
    }

}
