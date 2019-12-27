<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //订单表
    protected $table = "orders";
    public $timestamps = false;
}
