<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TgMenu extends Model
{
    //表
    protected $table = 'tg_menu';
    //关闭自动维护时间戳
    public $timestamps = false;
}
