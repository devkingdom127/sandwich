<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = "order";

    public $fillable = ['id', 'name',
        'type',
        'summary',
        'avatar',
        'language_id',
        'user_id',
        'created_at', 'updated_at'];

    public $dates = ['created_at', 'updated_at'];
    public $primaryKey = 'id';

    public function date()
    {
        return date_format($this->created_at, 'd m,Y');
    }

    public function Items(){
        return $this->hasMany(OrderProducts::class,"order_id","id");
    }

    public function CountPrice(){
        return $this->hasMany(OrderProducts::class,"order_id","id")->sum('total');
    }

    public function City(){
        return $this->belongsTo(City::class,"city_id","id");
    }

    public function status()
    {
        $st = "<span class='badge badge-warning'>Pending</span>";
        if ($this->status == 2) {
            $st = "<span class='badge badge-primary'>Progress</span>";
        }
        else if ($this->status == 3) {
            $st = "<span class='badge badge-danger'>Rejected</span>";
        }
        else if ($this->status == 4) {
            $st = "<span class='badge badge-dark'>Accepted</span>";
        }
        else if ($this->status == 5) {
            $st = "<span class='badge badge-dark'>Completed</span>";
        }
        return $st;
    }

    public function cash()
    {
        $st = "Cash";
        if ($this->status == 2) {
            $st = "Visa";
        }
        else if ($this->status == 3) {
            $st = "Online";
        }
        return $st;
    }

    public function status1()
    {
        $st = "<td class=\"ball pending\">progress</td>";
        if ($this->status == 2) {
            $st = "<td class=\"ball pending\">pending</td>";
        }
        else if ($this->status == 3) {
            $st = "<td class=\"ball rejected\">Rejected</td>";
        }
        else if ($this->status == 4) {
            $st = "<td class=\"ball accepted\">Canceled</td>";
        }
        else if ($this->status == 5) {
            $st = "<td class=\"ball accepted\">Accepted</td>";
        }
        return $st;
    }

}