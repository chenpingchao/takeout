<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //表
    protected $table = 'article';
    //关闭自动维护时间戳
    public $timestamps;
}
