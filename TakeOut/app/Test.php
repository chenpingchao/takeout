<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //设定表
    protected $table = "test";
    //关闭自动维护时间戳
    public $timestamps = false;
}
