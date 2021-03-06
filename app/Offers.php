<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    public $table = "offers";

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

    public function OffersCity(){
        return $this->hasMany(OffersCity::class,"offers_id","id");
    }

    public function OffersCat(){
        return $this->hasMany(OffersCat::class,"offers_id","id");
    }

    public function OffersSubCat(){
        return $this->hasMany(OffersSubCat::class,"offers_id","id");
    }

    public function OffersRestaurant(){
        return $this->hasMany(OffersRestaurant::class,"offers_id","id");
    }

    public function OffersProducts(){
        return $this->hasMany(OffersProducts::class,"offers_id","id");
    }

    public function date(){
        return date_format($this->created_at,'d m,Y');
    }

    public function img(){
        return env('PATH_IMAGE').$this->avatar;
    }

}
