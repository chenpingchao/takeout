<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //购物车表
        protected  $table = 'cart';
   //关闭自动维护时间戳
        public $timestamps = false;
}
