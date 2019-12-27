<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin_logs extends Model
{
    //表
    protected  $table = 'admin_logs';
    //关闭自动维护时间戳
    public $timestamps = false;
}
