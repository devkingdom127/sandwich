<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use  Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function UserResaurant(){
        return $this->hasOne(Restaurant::class,"user_id","id");
    }

    public function UserRide(){
        return $this->hasOne(UserRide::class,"user_id","id");
    }

    public  function CheckRole($x){
        if($this->role  == $x){
            return true;
        }
        return false;
    }

    public  function NameRole(){
        if($this->role  == 1){
            return "Admin";
        }
        else if($this->role  == 2){
            return "Clients";
        }
        else if($this->role  == 3){
            return "Rider";
        }
        else if($this->role  == 4){
            return "Restaurants";
        }
        else if($this->role  == 5){
            return "Non";
        }
    }

    public  function route(){
        if($this->role  == 1){
            return route('dashboard_admin.index');
        }
        else {
            return route('home');
        }
    }

}
