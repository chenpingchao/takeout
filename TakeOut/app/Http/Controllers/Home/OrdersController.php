<?php

namespace App\Http\Controllers\home;

use App\Cart;
use App\Member;
use App\MemberMsg;
use App\Menu;
use App\Orders;
use App\OrdersMenu;
use App\RedPacket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    //订单控制器
    public function ordersPage(){

        $mid = session('mid');
        //查询用户的收货地址
        $member_msg = MemberMsg::where('mid',$mid) -> get();
        //查询商品清单
        $menu = Cart::from('cart as c')
            -> join('menu as u','c.uid','=','u.id')
            -> where('mid',$mid)
            -> where('c.active',1)
            -> select('menu_name','price','buynum')
            -> get();
        //计算总价
        $orders_price = 0;
        foreach($menu as $v){
            $orders_price += $v->buynum * $v->price;
        }
        //查询红包
        $redpacket = RedPacket::where('mid',$mid)
            ->where('end_time','>',time())
            ->where('active',1)
            ->get() ;

        return view('home.orders.confirm_order',compact('member_msg' ,'menu','redpacket','orders_price') );
    }

    //订单生成
    public function ordersCreate(){
        \request() -> flash();
        $data['mid'] = session('mid');
        $data['detail'] = \request('message');
        $data['msg_id'] = \request('siteId');
        $data['add_time'] = time();
        $data['orders_num'] = date('YmdHis',time()).floor(mt_rand(100000,999999));
        //接受红包id
        $redpacket_id = \request('redpacket');
        //查询红包
        $redpacket = RedPacket::where('id',$redpacket_id) -> get() -> toArray();

        //查询被选中购物车商品
        $menu = Cart::from('cart as c')
            -> join('menu as u','c.uid','=','u.id')
            -> where('mid', $data['mid'] )
            -> where('c.active',1)
            -> select('uid','c.id','menu_name','price','buynum')
            -> get()
            ->toArray();
        //查询被选中商品的种类数
        $menu_num = Cart::where('active',1)
            ->where('mid',session('mid'))
            ->count('id');

        //订单总价
        $data['orders_price'] = 0;
        foreach($menu as $v){
            $data['orders_price'] += $v['buynum']*$v['price'];
        }

        //判断是否用红包
        if(!empty($redpacket)){
            //判断红包的类型
            if($redpacket[0]['type'] == 1){
                //无门槛
                $data['orders_price'] = $data['orders_price'] - $redpacket[0]['value'];
                $data['orders_price']<0 ? $data['orders_price']=0 : $data['orders_price'];
            }else{
                //满减
                if( $data['orders_price'] < $redpacket[0]['value']*3 ){
                    //不满足条件后退
                    return back();
                }else{
                    $data['orders_price'] = $data['orders_price'] - $redpacket[0]['value'];
                }
            }
            $data['orders_red'] = $redpacket[0]['type'].','.$redpacket[0]['value'];
        }

        //应获得的积分
        $score =   (int)floor( $data['orders_price'] /10 ) ;
//        dd($menu);

        //开启事物处理
        DB::beginTransaction();

        //将信息写入订单表
        $oid =  Orders::insertGetId($data);

        //商品信息处理
        $order_menu = '';
        foreach($menu as $k => $v){
            $order_menu[$k]['uid'] = $v['uid'];
            $order_menu[$k]['oid'] = $oid;
            $order_menu[$k]['num'] = $v['buynum'];
        }

        //将商品信息写入订单商品表
        $rel1 =OrdersMenu::insert($order_menu);

        //处理购物车的id
        $cartId = '';
        foreach ($menu as $k => $v){
            $cartId[$k] = $v['id'];
        }
        //批量删除购物车信息
        $rel2 = Cart::destroy($cartId);

        //将积分写入用户表中
        $rel3 = Member::where( 'id',session('mid') ) -> increment('score',$score);
        $rel4 = Member::where( 'id',session('mid') ) -> increment('grade',$score);

        //将红包设为已使用
        if(!empty($redpacket)) {
            $rel5 = RedPacket::where('id', $redpacket_id)->update(['active' => 2]);
        }else{
            $rel5 = 1 ;
        }

        //将产品的销售数量进行加减
        $num = 0;
        foreach( $menu as $v ){
            if(Menu::where('id',$v['uid']) ->increment('salde_num',$v['buynum'])){
                $num += 1;
            }
        }
        if($menu_num ==$num){
            $rel6 = 1;
        }else{
            $rel6 = '';
        }

        if( $oid && $rel1 && $rel2 && $rel3 && $rel4 && $rel5 && $rel6){
            DB::commit();
            $stats = 'ok';
            return view('home.orders.order_succed',compact('data','stats'));
        }else{
            DB::rollBack();
            $stats = 'error';
            return view('home.orders.order_succed',compact('stats'));
        }

    }


}
