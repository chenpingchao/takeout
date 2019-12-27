<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //表
    protected  $table = 'feedback';
    //关闭自动维护时间戳
    public $timestamps = false;
}