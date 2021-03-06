<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public $table = "restaurant";

    public $fillable = ['id','name',
        'type',
        'summary',
        'avatar',
        'language_id',
        'user_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function User(){
        return $this->belongsTo(User::class,"user_id","id");
    }

    public function Category(){
        return $this->hasMany(RestaurantCategory::class,"category_id","id");
    }

    public function City(){
        return $this->hasMany(RestaurantCity::class,"city_id","id");
    }

    public function RestaurantCategory(){
        return $this->hasMany(RestaurantCategory::class,"restaurant_id","id");
    }

    public function Comments(){
        return $this->hasMany(RestaurantReview::class,"restaurant_id","id");
    }

    public function Review(){
        return $this->hasMany(RestaurantReview::class,"restaurant_id","id");
    }

    public function TotolComment(){
        return $this->hasMany(RestaurantReview::class,"restaurant_id","id")->count();
    }

    public function SumStarComment(){
        return $this->hasMany(RestaurantReview::class,"restaurant_id","id")->sum('star');
    }

    public function Products(){
        return $this->hasMany(Products::class,"restaurant_id","id")->with("ProductsFeature");
    }

    public function Orders(){
        return $this->hasMany(OrderProducts::class,"restaurant_id","id");
    }

    public function OrdersTotal(){
        return $this->hasMany(OrderProducts::class,"restaurant_id","id")->sum('total');
    }

    public function OrdersPending(){
        return $this->hasMany(OrderProducts::class,"products_id","id")->whereHas('Order',function ($q){
            $q->where("status",1);
        })->count();
    }

    public function OrdersRejected(){
        return $this->hasMany(OrderProducts::class,"products_id","id")->whereHas('Order',function ($q){
            $q->where("status",3);
        })->count();
    }

    public function OrdersCompleted(){
        return $this->hasMany(OrderProducts::class,"products_id","id")->whereHas('Order',function ($q){
            $q->where("status",5);
        })->count();
    }

    public function Restaurant(){
        return $this->belongsTo(Restaurant::class,"restaurant_id","id");
    }

    public function date(){
        return date_format($this->created_at,'d m,Y');
    }

    public function img(){
        return env('PATH_IMAGE').$this->avatar;
    }

}
