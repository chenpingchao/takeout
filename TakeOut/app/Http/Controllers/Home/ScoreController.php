<?php

namespace App\Http\Controllers\home;

use App\Member;
use App\RedPacket;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    //积分兑换
    public function convert(){
        if (\request() -> ajax()){
            $data['type'] = \request('type');
            $data['value'] = \request('value');
            $num= \request('num');
            $data['mid'] = session('mid');
            $data['add_time'] = time();
            $data['end_time'] = strtotime('+7 days');
            $score = \request('type') == 1? 1.5*\request('value') : \request('value');
            //验证剩余积分是否够支付
            if ($num*$score > Member::where('id',session('mid')) -> value('score')){
                return \response() -> json(['status' => 'error','msg'=>'当前剩余积分不足']);
            }

            DB::beginTransaction();
            for ($i = 0;$i<$num;$i++) {
                if (RedPacket::insert($data)) {
                    $res = true;
                    Member:: where('id',session('mid'))
                          -> decrement('score',$score);
                } else {
                    DB::rollBack();
                    return response()->json(['status' => 'error', 'msg' => '兑换失败']);
                }
            }
            if ($res) {
                DB::commit();
                return response()->json(['status' => 'ok', 'msg' => '兑换成功']);
            }
        }else{
            $score = Member:: where('id',session('mid'))
                -> value('score');
            return view('home.score.convert',compact('score'));
        }
    }
}
