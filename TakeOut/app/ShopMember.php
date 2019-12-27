<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopMember extends Model
{
    //商店用户表
    protected $table = 'shop_member';
    //关闭自动维护时间戳
    public $timestamps = false;
}
