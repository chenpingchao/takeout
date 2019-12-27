<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopCate extends Model
{
    //定义表
    protected $table = 'shop_cate';
    //关闭自动维护时间戳
    public $timestamps = false;
}
