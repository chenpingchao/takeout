<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuComment extends Model
{
    //菜品评论表
    protected  $table = 'menu_comment';
    //关闭自动维护时间戳
    public $timestamps = false;
}
