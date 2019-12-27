<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //管理员表
    protected  $table = 'admin';
    //关闭自动维护时间戳
    public $timestamps = false;

}

