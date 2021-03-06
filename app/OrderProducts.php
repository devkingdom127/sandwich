<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    public $table = "order_products";

    public $fillable = ['id','name',
        'type',
        'summary',
        'avatar',
        'language_id',
        'user_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function Order(){
        return $this->belongsTo(Order::class,"order_id","id");
    }

    public function OrderProductsFeature(){
        return $this->hasMany(OrderProductsFeature::class,"order_products_id","id");
    }

    public function Products(){
        return $this->belongsTo(Products::class,"products_id","id");
    }

}
