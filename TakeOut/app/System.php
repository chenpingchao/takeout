<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    //表
    protected $table = 'System';
    //关闭自动维护时间戳
    public $timestamps = false;
}
