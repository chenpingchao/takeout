<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //商店表
    protected $table = 'shop';
    //关闭自动维护时间戳
    public $timestamps = false;
}
