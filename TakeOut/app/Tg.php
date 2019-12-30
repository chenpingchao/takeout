<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tg extends Model
{
    //表
    protected $table = 'tg';
    //关闭自动维护时间戳
    public $timestamps = false;
}
