<?php

namespace App\Http\Controllers\home;

use App\Cart;
use App\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class cartController extends Controller
{
    //购物车控制器
    //显示购物车页面
    public function index(){
        $cart_shop = null ;
        if(session() -> has('mid') ){
            //已登录
            $mid = session('mid');
            //查询购物车中所有的商品
            $cart_shop = Cart::from('cart as c')
                ->join('menu as u','c.uid','=','u.id')
                ->orderBy('c.add_time','desc')
                ->where('mid',$mid)
                ->select('u.id','menu_name','image','or_price','price','buynum','c.active')
                ->get();
        }else{
            //未登录
            //查询出session中的商品
            $session_shop = session('cart');
            if(!empty($session_shop)){
                //遍历查询出商品的信息
                foreach($session_shop as $k => $v ){

                    $menu = Menu::orderBy('add_time','desc')
                        ->where('id',$k)
                        ->select('id','menu_name','image','or_price','price')
                        ->get();
                    $cart_shop[$k] = $menu[0];
                    //商品的数量
                    $A_num=$cart_shop[$k]['buynum'] = $v['buynum'];
                    //session 共享
                    session() -> put(['A_num'=>$A_num]);
                    //商品状态
                    $cart_shop[$k]['active'] = $v['active'];
                }
            }else{
                $session_shop = '';
            }
//            dd(session('A_num'));
        }
//        dd(empty($cart_shop));
        return view('home.cart.cart',compact('cart_shop'));
    }

    //添加购物车（异步）
    public function joinCart($uid){
        $num = request('Number');

        //判断用户是否登陆
        if( session() -> has('mid') ){
            //用户已登录
            $mid = session('mid');
            //查询表中是否有该商品信息
            $menu = Cart::orderBy('add_time','desc')
                ->where('mid',$mid)
                ->where('uid',$uid)
                ->get() -> toArray();
            //判断购物车中是否有该商品的信息
            if($menu){
                //购物车中有该商品
               $result = Cart::where('mid',$mid)
                    ->where('uid',$uid)
                    ->increment('buynum' , $num );
            }else{
                //购物车中没有该商品
                $result = Cart::insert([ 'mid'=>$mid, 'uid'=>$uid, 'buynum'=>$num, 'add_time'=>time() ]);
            }

            if($result){
                return response()-> json(['stats' => 'ok' , 'msg' => '购物车已添加' ]);
            }else{
                return response()-> json(['stats' => 'error' , 'msg' => '购物车添加失败' ]);
            }


        }else{
            //未登陆
            //设置session保存时间为1周
            Cookie::queue(session_name() , session_id() ,-1 ,'/' );

            //判断session中购物车
            if( session() -> has('cart') ){
                $cart = session('cart');
                //有购物车  判断购物车中是否有该商品
                if( isset( $cart[$uid] ) ){
                    //有该商品
                    $cart[$uid]['buynum'] += $num ;
                    session() -> put(['cart' =>$cart]);
                    return response()-> json(['stats' => 'ok' , 'msg' => '购物车已添加' ]);
                }else{
                    //没有该商品
                    $cart[$uid] = [ 'uid' => $uid , 'buynum' => $num, 'active' => 1 ] ;
                    session() -> put(['cart' =>$cart]);
                    return response()-> json(['stats' => 'ok' , 'msg' => '购物车已添加' ]);
                }
            }else{
                //没有 购物车
                session() -> put([ 'cart' =>[ $uid =>[ 'uid' => $uid , 'buynum' => $num,'active' => 1 ] ] ] );
                return response()-> json(['stats' => 'ok' , 'msg' => '购物车已添加' ]);
            }
        }

    }

    //购物车商品增加
    public function menuCartAdd($uid){
        //判断用户是否登录
        if(session() -> has('mid')){
            //用户已登录(自曾)
            $mid = session('mid');
            if( Cart::where( 'uid' , $uid )->where( 'mid' , $mid ) ->increment('buynum',1) ){
                return response()-> json(['stats' => 'ok' , 'msg' => '增加成功' ]);
            }else{
                return response()-> json(['stats' => 'error' , 'msg' => '增加失败' ]);
            }
        }else{
            //用户未登录
            $cart = session('cart');
            $cart[$uid]['buynum'] += 1;
            session() -> put(['cart' => $cart]);
            return response()-> json(['stats' => 'ok' , 'msg' => '更新成功' ]);


        }
    }
    //购物车商品减少
    public function menuCartMin($uid){
        //判断用户是否登录
        if(session() -> has('mid')){
            //用户已登录(自减)
            $mid = session('mid');
            $buynum = Cart::where( 'uid' , $uid )->where( 'mid' , $mid ) ->select('buynum')->get() -> toArray();
            if( $buynum[0]['buynum'] > 1){
                if( Cart::where( 'uid' , $uid )->where( 'mid' , $mid ) ->decrement('buynum',1) ){
                    return response()-> json(['stats' => 'ok' , 'msg' => '减少成功' ]);
                }else{
                    return response()-> json(['stats' => 'error' , 'msg' => '减少失败' ]);
                }
            }else{
                return response()-> json(['stats' => 'error' , 'msg' => '减少失败' ]);
            }

        }else{
            //用户未登录
            $cart = session('cart');
            if( $cart[$uid]['buynum'] > 1 ){
                $cart[$uid]['buynum'] -= 1;
                session() -> put(['cart' => $cart]);
                return response()-> json(['stats' => 'ok' , 'msg' => '更新成功' ]);
            }
        }
    }
    //购物车商品指定数量
    public function menuCartAssign($uid,$num=0){
        //判断$num是否大于0
        if(! $num > 0 || is_int($num) ){
            return response() -> json(['stats'=> 'error' ,'msg'=> "请输入大于0的整数"] );
        }
        //判断用户是否登录
        if(session() -> has('mid')){
            //用户已登录
            $mid = session('mid');
            if( Cart::where( 'uid' , $uid )->where( 'mid' , $mid ) ->update(['buynum' => $num]) ){
                return response()-> json(['stats' => 'ok' , 'msg' => '修改成功' ]);
            }else{
                return response()-> json(['stats' => 'error' , 'msg' => '修改失败' ]);
            }
        }else{
            //用户未登录
            $cart = session('cart');
            $cart[$uid]['buynum'] = $num;
            session() -> put(['cart' => $cart]);
            return response()-> json(['stats' => 'ok' , 'msg' => '更新成功' ]);
        }
    }

    //购物车商品状态修改
    public function menuCartActive($uid,$active){
        $active = $active ==1 ? 2 : 1 ;
        $msg = $active ==1 ? '选中' : '取消' ;
        //判断用户是否登录
        if(session() -> has('mid')){
            //用户已登录
            $mid = session('mid');
            if( Cart::where( 'uid' , $uid )->where( 'mid' , $mid ) ->update( [ 'active' => $active ] ) ){
                return response()-> json(['stats' => 'ok' ,'url' => route('home.menuCartActive',['uid'=>$uid ,'active'=>$active ]) , 'msg' => $msg.'成功' ]);
            }else{
                return response()-> json(['stats' => 'error' , 'msg' => $msg.'失败' ]);
            }
        }else{
            //用户未登录
            $cart = session('cart');
            $cart[$uid]['active'] = $active;
            session() -> put(['cart' => $cart]);
            return response()-> json(['stats' => 'ok' ,'url' => route('home.menuCartActive',['uid'=>$uid ,'active'=>$active ]) , 'msg' => $msg.'成功' ]);

        }
    }

    //购物车商品全选或取消
    public function menuCartAll($active){
        $msg = $active ==1 ? '全选': '取消';
        //判断用户是否登录
        if(session() -> has('mid')){
            //用户已登录
            $mid = session('mid');
            if( Cart::where( 'mid' , $mid ) ->update( [ 'active' => $active ] ) ){
                return response()-> json(['stats' => 'ok' , 'msg' => $msg.'成功' ]);
            }else{
                return response()-> json(['stats' => 'error' , 'msg' => $msg.'失败' ]);
            }
        }else {
            //用户未登录
            $cart = session('cart');
            foreach ($cart as $k => $v ){
                $cart[$k]['active'] = $active;
            }
            session()->put(['cart' => $cart]);
            return response()->json(['stats' => 'ok', 'msg' => $msg.'成功']);
        }
    }

    //购物车商品反选(没做)
    public function menuCartAdverse(){
        $chk = request('chk');
        //判断用户是否登录
        if(session() -> has('mid')){
            //用户已登录
        }else{
            //用户未登录
            $cart = session('cart');

            //先全部选中
            foreach($cart as $k => $v){
                $cart[$k]['active'] = 1;
            }
            if( ! empty($chk)){
                //再把传过来的ID代表的产品取消
                foreach($chk as $v){
                    $cart[$v]['active'] = 2;
                }
            }
            session()->put(['cart' => $cart]);
            return response()->json(['stats' => 'ok', 'msg' => '反选成功']);
        }
    }

    //删除购物车商品
    public function deleteCart($uid){
        //判断用户是否登录
        if(session() -> has('mid')){
            //用户已登录
            $mid = session('mid');
            if( Cart::where( 'uid' , $uid )->where( 'mid' , $mid ) ->delete() ){
                return response()-> json(['stats' => 'ok' , 'msg' => '删除成功' ]);
            }else{
                return response()-> json(['stats' => 'error' , 'msg' => '删除失败' ]);
            }
        }else {
            //用户未登录
            $cart = session('cart');
            unset($cart[$uid]);
            session()->put(['cart' => $cart]);
            return response()->json(['stats' => 'ok', 'msg' => '删除成功']);
        }
    }


}
