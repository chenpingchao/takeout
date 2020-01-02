<?php

namespace App;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    //管理员表
    protected  $table = 'roles';
    //关闭自动维护时间戳
    public $timestamps = false;

}

