<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admin extends Authenticatable
{
    use EntrustUserTrait;
    //管理员表
    protected  $table = 'admin';
    //关闭自动维护时间戳
    public $timestamps = false;

}

