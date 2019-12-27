<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertis extends Model
{
    //广告表
    protected  $table = 'advertis';
    //关闭自动维护时间戳
    public $timestamps = false;
}
