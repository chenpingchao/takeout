<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopAudit extends Model
{
    //定义表
    protected $table = 'shop';
    //关闭自动维护时间戳
    public $timestamps = false;
}
