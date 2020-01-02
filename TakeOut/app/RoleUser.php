<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    //管理员表
    protected  $table = 'role_user';
    //关闭自动维护时间戳
    public $timestamps = false;

}

