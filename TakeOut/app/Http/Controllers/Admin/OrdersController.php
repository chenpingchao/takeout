<?php

namespace App\Http\Controllers\Admin;

use App\Orders;
use App\OrdersMenu;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    //交易中心控制器
    //交易中心首页
    public function index(){
        //查询order表数据一年的数据
        //订单总金额
        $sum = Orders::where("add_time" ,">" ,time()-3153600)
                        ->sum("orders_price");
        //订单总数量
        $order_sum = Orders::where("add_time" ,">" ,time()-3153600)
                    ->count("id");
        //商品交易成功数量
        $order_win_sum = Orders::from("orders as o")
                        ->join("orders_menu as om",'o.id','=','om.oid')
                        ->where("add_time" ,">" ,time()-3153600)
                        ->where("active" ,"<>" , "6")
                        ->count("om.id");
        //商品交易失败数量（订单取消）
        $order_lost_sum = Orders::join('orders_menu','orders.id','=','orders_menu.oid')
                        ->where("add_time" ,">" ,time()-3153600)
                        ->where("active" ,"=" , "6")
                        ->count('orders_menu.id');
       //退款金额
        $order_lost_price = Orders::from("orders as o")
                          ->join("orders_menu as om",'o.id','=','om.oid')
                          ->join("menu as u","om.uid",'=','u.id' )
                          ->where("o.add_time" ,">" ,time()-3153600)
                          ->where("o.active" ,"=" , 6)
                          ->orWhere("o.active" ,"=" , 7)
                          ->selectRaw('one_u.price * one_om.num as p')
                          ->get();

//              dd($order_lost_price[0]['p']);
        //柱状图所需的数据
//        dd(strtotime(date('Y-1',time() ) ) );
       //所有订单
        for($m= 1 ; $m <= 12 ; $m++ ){
            $n = $m+1;
            $allOrders_sql = Orders::whereBetween('add_time',[strtotime(date("Y-$m-1",time() ) ),strtotime(date( "Y-$n-1",time() ) ) ] )
                ->count('id');
            $allOrders[] = $allOrders_sql;
        }
        //待付款订单
        for($m= 1 ; $m <= 12 ; $m++ ){
            $n = $m+1;
            $noPay_sql = Orders::whereBetween('add_time',[strtotime(date("Y-$m-1",time() ) ),strtotime(date( "Y-$n-1",time() ) ) ] )
                ->where('active',1)
                ->count('id');
            $noPay[] = $noPay_sql;
        }
        //已付款
        for($m= 1 ; $m <= 12 ; $m++ ){
            $n = $m+1;
            $Pay_sql = Orders::whereBetween('add_time',[strtotime(date("Y-$m-1",time() ) ),strtotime(date( "Y-$n-1",time() ) ) ] )
                ->whereBetween('active',[2,5])
                ->count('id');
            $Pay[] = $Pay_sql;
        }
        //退货
        for($m= 1 ; $m <= 12 ; $m++ ){
            $n = $m+1;
            $return_sql = Orders::whereBetween('add_time',[strtotime(date("Y-$m-1",time() ) ),strtotime(date( "Y-$n-1",time() ) ) ] )
                ->whereBetween('active',[6,7])
                ->count('id');
            $return[] = $return_sql ;
        }
//        dd($return);
        return view("admin.orders.transaction",
            compact('sum','order_sum',"order_win_sum","order_lost_sum","order_lost_price",'allOrders','noPay','Pay','return'));
    }

    //订单列表
    public function order(){
        //将表单信息存入闪存
        request() -> flash();
        //接受表单数据
        $orders_num = trim(request("orders_num"));
        $start_time = strtotime(request("start_time"));
        $end_time = strtotime(request("end_time"));
        $active = request("active");
        //查询订单列表
        $data = Orders::orderBy("add_time",'desc')
            //订单编号
           ->where(function($query) use($orders_num){
                if( $orders_num ){
                    $query -> where('orders_num', 'like', "%$orders_num%" );
                }
           })
            //起始和结束时间
           ->where(function($query) use($start_time,$end_time){
               if( $start_time && $end_time ){
                   $query -> whereBetween('add_time', [ $start_time, $end_time ]);
               }elseif( $start_time && !$end_time ){
                   $query -> where("add_time", '>=', $start_time);
               }elseif( !$start_time && $end_time){
                   $query -> where("add_time", '<=', $end_time);
               }
           })
            //状态
           ->where(function($query) use($active){
               if( $active==1 || $active==2 || $active==3 || $active==4 || $active==5 || $active==6){
                   $query -> where("active" , $active);
               }
           })
           ->paginate(10);
//      dd($active);
        //查询商品种类
        foreach( $data as $k => $v ){
            $data[$k]['orders_menu_num'] = Orders::from("Orders as o")
                ->join("orders_menu as om",'o.id','=','om.oid')
                ->where("o.id",$v->id)
                ->count("om.id");
        }
//        dd($data);
        return view("admin.orders.orderform",compact('data','orders_num','start_time', 'end_time','active'));
    }

    //发货
    public function shipments($id){
        if(Orders::where('id',$id ) ->update( [ 'active' => 3 ] )){
            return response() -> json([ 'stats'=> 'ok' , 'msg'=>'发货成功' ]);
        }else{
            return response() -> json([ 'stats'=> 'error' , 'msg'=>'发货失败' ]);
        }
    }

    //删除订单
    public function delete(){
        $id = request('id');
        //开启事物处理
        DB::beginTransaction();
        //删除订单
        if(Orders::destroy($id) ){
            //删除订单商品
            if(OrdersMenu::where('oid',$id) -> delete() ){
                //成功后提交
                DB::commit();
                return response() -> json([ 'stats'=> 'ok' , 'msg'=>'删除成功' ]);
            }else{
                //失败后回滚
                DB::rollBack();
                return response() -> json([ 'stats'=> 'error' , 'msg'=>'删除失败' ]);
            }
        }else{
            return response() -> json([ 'stats'=> 'error' , 'msg'=>'删除失败' ]);
        }
    }

    //订单详情
    public function detail($id){
        //查询订单编号及收货人的信息（不是会员的信息）
        $orders_msg = Orders::from( "Orders as o" )
            ->join("member_msg as msg","o.msg_id",'=','msg.id')
            ->where("o.id",$id)
            ->select("orders_num",'msg.*')
            ->get();
        //查询订单中的商品
        $menu_msg = Orders::from( "Orders as o" )
            ->join("orders_menu as om","o.id",'=','om.oid')
            ->join("menu as u","om.uid",'=','u.id')
            ->where("o.id",$id)
            ->select("u.*",'om.num','o.*')
            ->get();
//        dd($orders_msg);
        return view("admin.orders.order_detailed",compact('orders_msg','menu_msg'));
    }

    //交易金额
    public function price($time = 0){
        //接受值
        switch($time){
            case 1 ; $add_time = 0 ; break;   //获取全部订单
            case 2 ; $add_time = strtotime("00:00:00") ; break;  //获取当天的订单
            case 3 ; $add_time = strtotime(date('Y-m-01',time())); break;  //获取当月1号到现在的订单
            default : $add_time = strtotime("-1 years") ;  //默认为获取1年的订单
        }
        //查询成交总金额
        $sum_price = Orders::sum("orders_price");
        //查询当天成交的金额
        $day_price = Orders::where("add_time" ,">" ,strtotime("00:00:00"))
            ->sum('orders_price');
        //订单数
        $orders_num = Orders::count("id");
        //查询所有订单信息
        $data = Orders::orderBy('add_time',"desc")
                ->where(function($query) use($add_time){
                    if($add_time){
                        $query -> where("add_time" ,'>=' , $add_time );
                    }
                })
                ->paginate(1);
        //获取柱状图的数据
        //成交订单
        for($m= 1 ; $m <= 31 ; $m++ ){
            $n = $m+1;
            $acc = Orders::whereBetween('add_time',[strtotime(date("Y-m-$m",time() ) ),strtotime(date( "Y-m-$n",time() ) ) ] )
                ->whereBetween('active',[2,5])
                ->count('id');
            $accOrders[] = $acc;
        }
        //成交金额
        for($m= 1 ; $m <= 31 ; $m++ ){
            $n = $m+1;
            $acc_price = Orders::whereBetween('add_time',[strtotime(date("Y-m-$m",time() ) ),strtotime(date( "Y-m-$n",time() ) ) ] )
                ->whereBetween('active',[2,5])
                ->sum('orders_price');
            $all_price[] = $acc_price;
        }
        //失败订单
        for($m= 1 ; $m <= 31 ; $m++ ){
            $n = $m+1;
            $lost = Orders::whereBetween('add_time',[strtotime(date("Y-m-$m",time() ) ),strtotime(date( "Y-m-$n",time() ) ) ] )
                ->whereBetween('active',[6,7])
                ->count('id');
            $lostOrder[] = $lost;
        }
//        dd($lostOrder);
        return view("admin.orders.amounts",compact('sum_price','day_price','orders_num','data' ,'time','accOrders','all_price','lostOrder'));
    }

    //退货订单查询
    public function returns(){

        //搜索查询
        $active = request('active');
        $orders_num = trim( request( 'orders_num' ) );
        $start_time = strtotime(request('start_time'));
        $end_time = strtotime(request('end_time'));

        //查询已退款和未退款的信息(get方式提交的请求 )分页搜索

        $data = Orders::orderBy('add_time',"desc")
            //订单编号模糊搜索
            ->where(function($query) use($orders_num){
                if($orders_num){
                    $query -> where('orders_num','like',"%$orders_num%");
                }
            })
            //起始和结束时间
            ->where(function($query) use($start_time,$end_time){
                if( $start_time && $end_time ){
                    $query -> whereBetween('add_time', [ $start_time, $end_time ]);
                }elseif( $start_time && !$end_time ){
                    $query -> where("add_time", '>=', $start_time);
                }elseif( !$start_time && $end_time){
                    $query -> where("add_time", '<=', $end_time);
                }
            })
            //状态
            ->where(function($query) use($active){
                if($active){
                    $query -> where( "active" , $active );
                }else{
//                    $query -> whereRaw("one_orders.active = 6 or one_orders.active = 7");
                    $query -> orWhere("active", 6)
                           ->orWhere("active", 7);
                }
            })
            ->paginate(10);

        //查询订单总的商品种类数
        foreach( $data as $k => $v ){
            $data[$k]['orders_menu_num'] = Orders::from("Orders as o")
                ->join("orders_menu as om",'o.id','=','om.oid')
                ->where("o.id",$v->id)
                ->count("om.id");
        }
        //查询商品的名称（最多1个）
        foreach( $data as $k => $v ){
             $menu_name = Orders::from("Orders as o")
                ->join("orders_menu as om",'o.id','=','om.oid')
                ->join("menu as u",'om.uid','=','u.id')
                ->where("o.id",$v->id)
                ->select('u.menu_name','u.id')
                ->limit(1)
                ->get()
                ->toArray();
            $data[$k]['orders_menu_name'] = $menu_name[0]['menu_name'];
            $data[$k]['orders_menu_id'] = $menu_name[0]['id'];
        }

        return view("admin.orders.refund",compact("data","orders_num",'start_time','end_time','active'));
    }

    //退货操作（确认退货）
    public function return_operation($id){
        if( Orders::where('id',$id) -> update([ 'active'=>7 ]) ){
            return response() -> json([ 'stats'=> 'ok' , 'msg'=>'退款成功' ]);
        }else{
            return response() -> json([ 'stats'=> 'error' , 'msg'=>'退款失败' ]);
        }
    }


    //退货详情
    public function return_detail($id){
        //查询退款信息
        $data['msg']  = Orders::from("orders as o")
            ->orderBy('o.add_time','desc')
            ->join('member as m','o.mid','=','m.id')
            ->where('o.id',$id)
            ->select('o.*','username','mobile')
            ->get();
        //查询退款商品信息
        $data['menu'] =Orders::from("orders as o")
            ->join("orders_menu as om" , 'o.id' ,'=', 'om.oid' )
            ->join("menu as u" , 'om.uid','=' , 'u.id' )
            ->where('o.id',$id)
            ->select('menu_name','price','num','u.id')
            ->get();
        //查询订单总的商品种类数
        $data['orders_menu_num'] = Orders::from("Orders as o")
                ->join("orders_menu as om",'o.id','=','om.oid')
                ->where("o.id",$id)
                ->count("om.id");

//        dd($data);
        return view("admin.orders.refund_detailed",compact('data'));
    }

    //退货批量删除
    public function return_deletes(){
        $chk = request('chk');

        //批量删除订单
        if( Orders::destroy($chk) ){
            //删除订单商品表中的商品
            foreach($chk as $k => $v ){
                OrdersMenu::where('oid',$v) ->delete();
            }
            return response() -> json([ 'stats'=>'ok' , 'msg'=>'批量删除完成' ]);
        }else{
            return response() -> json([ 'stats'=>'error' , 'msg'=>'批量删除失败' ]);
        }
    }


}
