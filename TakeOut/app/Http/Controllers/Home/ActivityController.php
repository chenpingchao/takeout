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
                -> get()
                -> toArray();
        foreach ($tg as $k => $v){
            if ($v['active']==1){
                $num = TgMember:: where('tg_id',$v['id'])
                    -> count('id');
                $tg[$k]['join_num'] = $num;
            }
        }
//        dd($tg);
        return view('home/activity/index',compact('tg'));
    }
}
