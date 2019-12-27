<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedPacket extends Model
{
    //红包表
    protected  $table = 'redpacket';
    //关闭自动维护时间戳
    public $timestamps = false;

    public static function getNew(){
        self:: where('active','<>',1)
            -> where('end_time','<',strtotime('-2 weeks'))
            -> delete();
        self:: where('active',1)
            -> where('end_time','<',time())
            -> update(['active' => 3]);
    }
}
