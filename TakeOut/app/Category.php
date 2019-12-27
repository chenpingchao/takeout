<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //分类表
    protected  $table = 'category';
    //关闭自动维护时间戳
    public $timestamps = false;
}
