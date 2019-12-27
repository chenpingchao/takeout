<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //表
    protected  $table = 'collection';
    //关闭自动维护时间戳
    public $timestamps = false;
}
