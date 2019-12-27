<?php

namespace App\Http\Controllers\admin;

use App\Menu;
use App\Shop;
use App\ShopMember;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ShopController extends Controller
{
    //店铺列表
    public function lists(){
        //判断是否是搜索
        if (\request() -> has('active')){
            //搜索
            //接收搜索条件
            $shop_name = trim(\request('sc_name'));
            $sc_name = trim(\request('sc_name'));
            $sm_name = trim(\request('sm_name'));
            $active = request('active');
            $start_time = strtotime(\request('start_time'));
            $end_time = strtotime(\request('end_time'));
            //闪存搜索条件
            \request() -> flashOnly('sc_name','active','shop_name','start_time','end_time','sm_name');
            $shop_list = Shop:: from('shop as s')
                                -> join('shop_cate as sc','s.sc_id','sc.id')
                                -> join('shop_member as sm','s.sm_id','sm.id')
                                -> where(function ($query)use ($shop_name){
                                    if (!empty($shop_name)){
                                        $query -> where('shop_name','like',"%$shop_name%");
                                    }
                                })
                                -> where(function ($query)use ($sc_name){
                                    if (!empty($sc_name)){
                                        $query -> where('sc.sc_name','like',"%$sc_name%");
                                    }
                                })
                                -> where(function ($query)use ($sm_name){
                                    if (!empty($sm_name)){
                                        $query -> where('sm.shop_member_name','like',"%$sm_name%");
                                    }
                                })
                                -> where(function ($query)use ($active){
                                    if ($active == 1 || $active == 2){
                                        $query -> where('s.active',$active);
                                    }
                                })
                                -> where(function ($query)use ($start_time){
                                    if (!empty($start_time)){
                                        $query -> where('s.add_time','>',$start_time);
                                    }
                                })
                                -> where(function ($query)use ($end_time){
                                    if (!empty($end_time)){
                                        $query -> where('s.add_time','<',$end_time);
                                    }
                                })
                                -> select('s.*','sc.sc_name','sm.shop_member_name as sm_name')
                                -> paginate(10);

        }else{
            //点击菜单进入
            //顶级分类列表
            $shop_list = Shop::from('shop as s')
                -> join('shop_cate as sc','s.sc_id','=','sc.id')
                -> join('shop_member as sm','s.sm_id','=','sm.id')
                -> select('s.*','sc.sc_name','sm.shop_member_name as sm_name')
                -> paginate(10);
            $sc_name = null;
            $shop_name = null;
            $active = null;
        }
        $shop_num = Shop::count('id');
        return view('admin.shop.shop_list',compact('shop_list','sc_name','shop_name','active','shop_num'));
    }

    //店铺申请列表
    public function audit(){
        $shop_audit = Shop::where('active',3)->get();
        $shop_audit_num = Shop::where('active',3)->count('id');
        return view('admin.shop.shop_audit',compact('shop_audit','shop_audit_num'));
    }

    //店铺详情
    public function detail($id){
        $shop_detail = Shop::where('id',$id) ->get();
        return view('admin.shop.shop_detail',compact('shop_detail'));
    }

    //店铺持有人
    public function member(){
        //闪存查询条件
        request() -> flash();
        //接受数据
        $shop_member_name = trim(request('shop_member_name'));
        $active = request('active');
        $shop_member = ShopMember::where(function ($query)use($shop_member_name){
            //查询会员名称
            if ($shop_member_name){
                $query -> where('shop_member_name','like','%'.$shop_member_name.'%');
            }
        })
            ->where(function ($query)use ($active){
                //查询会员状态
                if ($active == 1 || $active == 2){
                    $query -> where('active',$active);
                }
            })
            ->paginate(15);
        return view('admin.shop.shop_member',compact('shop_member','shop_member_name','active'));
    }

    //店铺状态
    public function stop($id,$active){
        $a = $active == 4 ? 2 : 4;
        $text1 = $active == 4 ? '激活' : '禁用';
        $text2 = $active == 4 ? '禁用' : '激活';
        $text3 = $active == 4 ? '打烊中' : '禁用';
        if (Shop::where('id', $id)->update(['active' => $a])) {
            return response()->json(['status' => 'ok', 'msg' => $text1."成功",'active' => $text3 ,'href' => route('bg.shop.stop', ['id' => $id,'active' => $a]), 'text' => $text2]);
        } else {
            return response()->json(['status' => 'error', 'msg' => $text1.'失败']);
        }
    }

    //店铺审核
    public function active($id,$active){
        $a = $active == 3 ? 2 : 3;
        if(Shop::where('id',$id) -> update(['active' => $a])){
            return response() -> json (['status' => 'ok','msg' => '审核通过','url' => route('bg.shop.audit')]);
        }else{
            return response() -> json (['status' => 'error','msg' => '审核失败']);
        }
    }

    //删除
    public function delete($id){
        if(Shop::destroy($id)){
            return response() -> json(['status' => 'ok','msg' => '删除成功']);
        }else{
            return response() -> json(['status' => 'error','msg' => '删除失败']);
        }
    }

    public function deletes(){
        if(Shop::destroy( request('chk'))){
            return response() -> json(['status' => 'ok','msg' => '删除成功']);
        }else{
            return response() -> json(['status' => 'error','msg' => '删除失败']);
        }
    }

    //拒绝店铺审核
    public function turn_down($sid){
        $turn  = request('turn_down') ;
        //查询收件人的邮件地址
        $shop_msg = Shop::where('id',$sid)->select('shop_name','audit_name','e_mail')->first();
        Mail::send('admin.shop.mail', ['shop_msg'=>$shop_msg,'turn'=>$turn], function ($msg) use($shop_msg) {
            $msg->subject('店铺审核拒绝通知');  //邮件标题
            $msg->to($shop_msg->e_mail);       //收件人地址
        });
    }

}
