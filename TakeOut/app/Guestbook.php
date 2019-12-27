<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guestbook extends Model
{
    //表
    protected  $table = 'guestbook';
    //关闭自动维护时间戳
    public $timestamps = false;
}