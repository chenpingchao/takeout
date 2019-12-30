<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TgMember extends Model
{
    //表
    protected $table = 'tg_member';
    //关闭自动维护时间戳
    public $timestamps = false;
}
