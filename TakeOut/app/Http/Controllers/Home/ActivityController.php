<?php

namespace App\Http\Controllers\home;

use App\Tg;
use App\TgMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    //活动首页
    public function index(){
//        dd(session() ->all());
        //查询团购信息
        $tg = Tg:: join('shop as s','s.id','tg.sid')
                -> select('tg.*','s.shop_name','s.logo')
                -> orderBy('tg.start_time','desc')
                -> get()
                -> toArray();
        foreach ($tg as $k => $v){
            if ($v['active']==1){
                $num = TgMember:: where('tg_id',$v['id'])
                    -> count('id');
                $tg[$k]['join_num'] = $num;
                $tg[$k]['member'] = empty(Tg::getMember($v['id']))?1:Tg::getMember($v['id']);
                $tg[$k]['time'] = Tg::getTime($v['id']);
            }else{
                $tg[$k]['member'] = 1;
            }
        }
        $active = ['未开启','','已成团','已结束'];
//        dd($tg);
        return view('home/activity/index',compact('tg','active'));
    }
}
