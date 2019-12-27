<?php

namespace App\Http\Controllers\merchant;

use App\MenuComment;
use App\MenuCommentReply;
use App\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ordersController extends Controller
{
    //商家订单表
    public function index($sid,$active=0){
        $data = Orders::from('orders as o')
            ->join('orders_menu as om','o.id','=','om.oid')
            ->join('menu as u','om.uid','=','u.id')
            ->join('member as m','o.mid','=','m.id')
            ->join('member_msg as mm','o.msg_id','=','mm.id')
            ->where('u.sid',$sid)
            ->where(function($query) use($active){
                if($active ==1 ||$active ==2 ||$active ==3 ||$active ==4 ||$active ==5 ||$active ==6 ||$active ==7  ){
                    $query -> where( "o.active" , $active );
                }
            })
            ->select('o.*','avatar','mm.mobile','name','mm.site','mm.location')
            ->orderBy("o.add_time",'desc')
            ->paginate(5);
        return view('merchant.orders.ordersAll',compact('data','active'));
    }
    public function shipments($oid){
        if(Orders::where('id',$oid) -> update(['active' => 3])){
            return response() -> json(['stats' => 'ok' , 'msg' => '发货成功' ]);
        }else{
            return response() -> json(['stats' => 'error' , 'msg' => '发货失败' ]);
        }
    }
    public function returns($oid){
        if(Orders::where('id',$oid) -> update(['active' => 7])){
            return response() -> json(['stats' => 'ok' , 'msg' => '退货成功' ]);
        }else{
            return response() -> json(['stats' => 'error' , 'msg' => '退货失败' ]);
        }
    }

    //订单详情页面
    public function detail($oid){
        //查询订单编号及收货人的信息（不是会员的信息）
        $orders_msg = Orders::from( "Orders as o" )
            ->join("member_msg as msg","o.msg_id",'=','msg.id')
            ->where("o.id",$oid)
            ->select("orders_num",'msg.*')
            ->get();
        //查询订单中的商品
        $menu_msg = Orders::from( "Orders as o" )
            ->join("orders_menu as om","o.id",'=','om.oid')
            ->join("menu as u","om.uid",'=','u.id')
            ->where("o.id",$oid)
            ->select("u.*",'om.num','o.*')
            ->get();
//        dd($orders_msg);
        return view("merchant.orders.orderDetail",compact('orders_msg','menu_msg'));
    }

    //回复页面
    public function reply($oid,$sid){
        if( \request() -> isMethod('post') ){
            $data['mc_id'] = \request('mc_id');
            $data['reply'] = \request('reply');
            if(MenuCommentReply::insert([$data])){
                return response() -> json(['stats' => 'ok' ]);
            }else{
                return response() -> json(['stats' => 'error' ]);
            }
        }else{
            $reply = MenuComment::from('menu_comment as mc')
                ->join('menu as u','mc.uid','=','u.id')
                ->join('member as m','mc.mid','=','m.id')
                ->join('menu_comment_reply as mcr','mc.id','=','mcr.mc_id')
                ->where('mc.oid',$oid)
                ->where('mc.sid',$sid)
                ->select('menu_name','username','mc.*','mcr.reply')
                ->get();
//            dd($reply);
            return view('merchant.orders.reply',compact('reply'));
        }
    }
}
