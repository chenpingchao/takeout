<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestbookReply extends Model
{
    //表
    protected  $table = 'guestbook_reply';
    //关闭自动维护时间戳
    public $timestamps = false;
}