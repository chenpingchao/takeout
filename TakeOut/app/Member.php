<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //会员表
    protected  $table = 'member';
    //关闭自动维护时间戳
    public $timestamps = false;
}
