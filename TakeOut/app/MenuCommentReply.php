<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCommentReply extends Model
{
    //评论回复表
    protected  $table = 'menu_comment_reply';
    //关闭自动维护时间戳
    public $timestamps = false;
}
