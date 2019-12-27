<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberMsg extends Model
{
    //会员信息表
    protected  $table = 'member_msg';
    //关闭自动维护时间戳
    public $timestamps = false;
}
