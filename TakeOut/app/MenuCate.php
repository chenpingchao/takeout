<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCate extends Model
{
     //菜品表
    protected  $table = 'menu_cate';
    //关闭自动维护时间戳
    public $timestamps = false;
}
