<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SgMenu extends Model
{
    //表
    protected $table = "shan_menu";
    //关闭自动维护时间戳
    public $timestamps = false;
}
