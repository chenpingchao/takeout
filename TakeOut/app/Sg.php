<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sg extends Model
{
    //表
    protected $table = 'shan';
    //关闭自动维护时间戳
    public $timestamps = false;

/*    //获取参团最后三人的信息
    public static function getMember($id){
        $members = self:: join('tg_member as tgm','tgm.tg_id','tg.id')
            -> join('member as m','tgm.mid','m.id')
            -> select('m.username','tgm.add_time')
            -> where('tg.id',$id)
            -> limit(3)
            -> get()
            -> toArray();
        return $members;
    }

    //获取成团倒计时
    public static function getTime($id){
        $end_time = self:: where('id',$id)
                        -> value('end_time');
        $time = $end_time - time();
        if ($time > 0){
            return $time;
        }else{
            if(self:: where('id',$id) -> update(['active'=>2])){
                return -1;
            }else{
             return false;
            }
        }
    }*/


}
