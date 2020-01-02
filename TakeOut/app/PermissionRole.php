<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    //管理员表
    protected  $table = 'permission_role';
    //关闭自动维护时间戳
    public $timestamps = false;

}

