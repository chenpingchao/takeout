<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersMenu extends Model
{
    //订单菜品表
    protected $table = "orders_menu";
    public $timestamps = false;
}
