<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuImage extends Model
{
    //菜品图片表
    protected  $table = 'menu_image';
    //关闭自动维护时间戳
    public $timestamps = false;
}
