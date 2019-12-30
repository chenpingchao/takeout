<?php

namespace App\Http\Controllers\Home;

use App\Advertis_list;
use App\Guestbook;
use App\GuestbookReply;
use App\Member;
use App\Menu;
use App\MenuComment;
use App\MenuCommentReply;
use App\MenuImage;
use App\Collection;
use App\Cart;
use App\Orders;
use App\OrdersMenu;
use App\Shop;
use App\ShopCate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    //显示主页
    public function index(){
        session() -> put(['province'=> '河南省']);
        session() -> put(['city'=> '郑州']);
        //店铺分类名
        $scName=ShopCate::where('active',1)
            ->select('id','sc_name')
            ->paginate();
        //查询订单表信息 订单状态1未付款2已付款3已发货4已签收5已评论6已取消
        $orders=Orders::join('member','orders.mid','=','member.id')
            ->orderBy('member.add_time','desc')
            ->where('orders.active','<>', 6)
            ->select('orders.orders_num','member.username','orders.active')
            ->paginate(3);
//        dd($orders);
        //店铺留言---用户名 菜馆 留言内容
        $Guestbooks=Guestbook::join('member','guestbook.mid','=','member.id')
            ->join('shop','guestbook.sid','=','shop.id')
            ->orderBy('guestbook.add_time','desc')
            ->select('username','shop_name','content','shop.logo')
            ->paginate(2);
//        dd($Guestbooks);
        //菜品评论---用户名-菜馆-菜品-评论
        $Gcomment=MenuComment::join('member','menu_comment.mid','=','member.id')
            ->join('menu','menu_comment.uid','=','menu.id')
            ->join('shop','menu.sid','=','shop.id')
            ->orderBy('menu_comment.add_time','desc')
            ->select('username','shop_name','menu_name','menu_comment.detail','menu.image_dir','menu.image')
            ->paginate(2);
//        dd($Gcomment);
        //查询主页菜品信息（按销量）
        $menu = Menu::where('active',1) ->orderBy('salde_num','desc') -> offset(0) ->paginate(3);
        //查询主页店铺信息（评分）
        $shop = Shop::where('active',1) -> orderBy('grade','desc') -> paginate(10);

        $Leftindexad = Advertis_list::where('ap_id',77)->where('start_time','<=',time())->where('end_time','>=',time())->where('active',1) ->first();
        $indexad = Advertis_list::where('ap_id',78)->where('start_time','<=',time())->where('end_time','>=',time())->where('active',1)->first();
        $shopad = Advertis_list::where('ap_id',79)->where('start_time','<=',time())->where('end_time','>=',time())->where('active',1)->first();
        return view("home.index.index",compact('menu','shop','orders','Guestbooks','Gcomment','Leftindexad','indexad','shopad','scName'));
    }

    //显示商品详情页面
    public function menuDetail($uid){
        $menu_msg = Menu::find($uid);
        $total = MenuComment:: where('uid',$uid)
                            -> count('id');
        //异步分页
        $page = new \AjaxPage($total,15,'search');

        $show = $page -> show();

        //当前菜品副图
        $menu_image = MenuImage :: where('uid',$uid)
                                -> get();

        //评论列表
        $menu_eval = MenuComment :: from('menu_comment as mc')
                                 -> join('member as m','m.id','=','mc.mid')
                                 -> leftJoin('menu_comment_reply as mcr','mcr.mc_id','=','mc.id')
                                 -> where('mc.uid',$uid)
                                 -> offset($page -> firstRow)
                                 -> limit($page -> listRows)
                                 -> select('mc.*','m.username','reply')
                                 -> get();

        //查询当前菜品月销量
        $month_num = Menu:: getMonthNum($uid,time());
        //根据评分查询出总评分
        $fenshu=MenuComment:: where('uid',$uid)
                           -> avg('fenshu');
        $fenshus=round($fenshu,1);//四舍五入
        //dd($menu_eval);
        if (\request() -> ajax()){
            return view('home.detail.evalPage',compact('menu_eval','show','uid'));
        }else{
            return view('home.detail.menuDetail', compact('menu_msg','menu_eval','month_num','show','menu_image','uid','fenshus'));
        }
    }

    //显示店铺详情页面
    public function shopDetail($sid){
        //查询店铺详情
        $shop_msg = Shop::find($sid);
        //查询店铺的回复总数
        $menu_comment_num = MenuComment::where('sid',$sid)
            ->count('id');

        //判断异步分页请求的类型
        if(\request('type') == 'comment' ){
            //评论异步分页
            $page = new \AjaxPage($menu_comment_num,3,'comment');
            $show = $page -> show();
            //显示店铺菜品评价
            $menu_comment = MenuComment::from('menu_comment as mc')
                ->join('menu as u','mc.uid','=','u.id')
                ->join('member as m','mc.mid','=','m.id')
                ->where('mc.sid',$sid)
                ->select('menu_name','username','mc.*')
                ->paginate(3);
            //显示店铺回复
            foreach ($menu_comment as $k=> $v){
                $menu_comment[$k]['reply'] = '';
                $menu_comment[$k]['reply_name'] = '';
                $menu_comment_reply = MenuCommentReply::where('mc_id',$v->id)->select('reply','mid')->get()->toArray();
                //判断是否有回复
                if(!empty($menu_comment_reply)){
                    $menu_comment[$k]['reply'] = $menu_comment_reply[0]['reply'];
                    //判断回复是店铺还是商家
                    if($menu_comment_reply[0]['mid'] == 0){
                        //商家回复
                        $menu_comment[$k]['reply_name'] = $shop_msg->shop_name;
                    }else{
                        //用户回复
                        $reply_name = Member::where('id',$menu_comment_reply[0]['mid'])
                            ->select('username')
                            ->get() ->toArray();
                        $menu_comment[$k]['reply_name'] = $reply_name[0]['username'];
                    }
                }
            }
            //返回评论页面
            return view('home.detail.shopDetailPage',compact('menu_comment','show'));

        }elseif(\request('type') == 'guestbook'){
            //店铺留言的异步分页
            //店铺留言的数量
            $guestbook_num = Guestbook::where('sid',$sid)-> count('id');

            $page = new \AjaxPage( $guestbook_num,3,'guestbook' );
            $show = $page -> show();
            //显示店铺留言
            $guestbook = Guestbook::from( 'guestbook as g' )
                ->join( 'member as m','g.mid','=','m.id' )
                ->where( 'g.sid',$sid )
                ->select( 'username','g.*' )
                ->paginate(3);
            //显示店铺回复
            foreach ($guestbook as $k=> $v){
                $guestbook[$k]['reply'] = '';
                $guestbook_reply = GuestbookReply::where('Gid',$v->id)->select('reply')->get()->toArray();
                //判断是否有回复
                if(!empty($guestbook_reply)){
                    $guestbook[$k]['reply'] = $guestbook_reply[0]['reply'];
                    $guestbook[$k]['reply_name'] = $shop_msg->shop_name;
                }
            }
            //返回留言页面
            return view('home.detail.guestbookPage',compact('guestbook','show'));
        }else{
            //菜品的异步分页
            $shop_menu_num = Menu::where('sid',$sid) ->count('id');
            //店铺菜品的异步分页
           /* $page = new \AjaxPage( $shop_menu_num,4,'menu' );
            $show = $page -> show();*/
            //查询店铺的菜品
            $shop_menu = Menu::orderBy('add_time','desc')
                ->where('sid',$sid)
                ->get();
        }

        //店铺收藏总数
        $Collection=collection::where('sid',$sid)
            ->count('id');
        //dd($Collection);
        if (\request() -> ajax()){
            return view('home.detail.menuPage',compact('shop_menu','show','sid'));
        }else{
            return view('home.detail.shopDetail',compact('shop_msg','shop_menu','menu_comment_num','show','Collection','sid'));
        }
    }

    //店铺点击--判断收藏数量--决定收藏或取消
    public function shop_Collection($sid){
        $Scoll=Collection::where('mid',session('mid'))
            ->where('sid',$sid)
            ->get()
            ->toArray();
//dd($Scoll);
        if (empty($Scoll)){
            //创建
            Collection::Insert(['mid'=>session('mid'),'sid'=>$sid]);
            //同时更改店铺表收藏总数
            $num=collection::where('sid',$sid)
                ->count('id');
            if ($num){
                Shop::where('id',$sid) -> update(['num_Z'=>$num]);
            }
            return response() -> json(['stats' => 'add' , 'msg'=> '收藏成功']);
        }else{
            //删除
            Collection::where('mid',session('mid'))
                ->where('sid',$sid)
                ->delete();
            //同时更改店铺表收藏总数
            $num=collection::where('sid',$sid)
                ->count('id');
            if ($num){
                Shop::where('id',$sid) -> update(['num_Z'=>$num]);
            }
            return response() -> json(['stats' => 'error' , 'msg'=> '取消收藏']);
        }
    }
    //店铺留言板
    public function guestbook($sid){
            $data['mid'] = session('mid');
            $data['detail'] = request('guestbook');
            $data['add_time'] = time();
            $data['sid'] =$sid;
            $data['active'] =2;
            if(Guestbook::insert($data) ){
                return response() -> json(['status' => 'ok' , 'msg'=> '留言成功']);
            }else{
                return response() -> json(['status' => 'error' , 'msg'=> '留言失败']);
            }
    }


    //商品搜索 hunt_list
    public function hunt_list(){
        //菜品无限极分类
        if (request()->isMethod('post')){
            //判断是菜品搜索还是店铺搜索
            if (request()->has('shop_name')){
                $shop_name=trim(request('shop_name'));
                //判断是否为空
                if (!empty($shop_name)){
                    return response()->json(['msg'=>'店铺搜索成功','url'=>route('H_list_shop',['shop_name'=>$shop_name]) ]);
                }
                return response()->json(['msg'=>'店铺搜索失败','url'=>route('/')]);
            }else{
                $menu_name=trim(request('menu_name'));
                if (!empty($menu_name)){
                    return response()->json(['msg'=>'菜品搜索成功','url'=>route('H_list_menu',['menu_name'=>$menu_name])]);
                }
                return response()->json(['msg'=>'菜品搜索失败','url'=>route('/')]);
            }
        }else{
            return response()->json(['msg'=>'搜索失败','url'=>route('/')]);
        }
    }
    //店铺搜索
    public function H_list_shop($shop_name){
        if (request()->isMethod('post')){
            //接收ab信息
            request() -> flash();
            $scName=trim(request('ab')['scName']);
            $site=trim(request('ab')['site']);
            $money=trim(request('ab')['money']);
            //查询数据库 按用户收藏排先后 //处理数据 写成搜索条件
            $ShopName=Shop::join('shop_cate','shop.sc_id','=','shop_cate.id')
                ->where(function ($query) use($scName){
                    if( $scName ){
                        $query -> where('sc_name', 'like', "%$scName%" );
                    }
                })//店铺类别
                ->where(function ($query) use($site){
                    if( $site ){
                        $query -> where('site', 'like', "%$site%" );
                    }
                })//区域
                ->where(function ($query) use($money){
                    if($money=='20元以下'){
                        $query -> where('avg_price', '<=', 20);
                    }elseif ($money=='20-40元'){
                        $query -> whereBetween('avg_price',[20,40]);
                    }elseif ($money=='40-60元'){
                        $query -> whereBetween('avg_price',[40,60]);
                    }elseif ($money=='60-80元'){
                        $query -> whereBetween('avg_price',[60,80]);
                    }elseif ($money=='80-100元'){
                        $query -> whereBetween('avg_price',[80,100]);
                    }elseif ($money=='100元以上'){
                        $query -> where('avg_price', '>=', 100 );
                    }
                })//价格区间
                ->where('shop_name','like',"%$shop_name%")
                ->orwhere('sc_name','like',"%$shop_name%")
                ->orderBy('num_Z','desc')
                ->where('shop_cate.active',1)
                ->where('shop.active',1)
                ->select('sc_name','shop.id','sc_id','shop_name','logo','grade','location','site','avg_price','image')
                ->paginate(3);//排序

            if ($ShopName){
                return view('home.index.seach',compact('ShopName'));//html 接收
            }
        }else{
            //查询数据库 按用户收藏排先后 //处理数据 写成搜索条件
            $ShopName=Shop::join('shop_cate','shop.sc_id','=','shop_cate.id')
                ->where('shop_name','like',"%$shop_name%")
                ->orwhere('sc_name','like',"%$shop_name%")
                ->orderBy('num_Z','desc')
                ->where('shop_cate.active',1)
                ->where('shop.active',1)
                ->select('sc_name','shop.id','sc_id','shop_name','logo','grade','location','site','avg_price','image')
                ->get();
            //店铺分类
            $ShopCate=ShopCate::where('active',1)->select('id','sc_name')->get();
            return view('home.index.list',compact('ShopName','ShopCate','shop_name'));
        }
    }
    //菜品搜索
    public function H_list_menu($menu_name){
        //查询数据库 按销量排先后 //salde_num eval_num add_time
        if (request()->isMethod('post')){
            //接收ab信息
            request() -> flash();
            $site=trim(request('ab')['site']);
            $money=trim(request('ab')['money']);
            //查询数据库 按用户收藏排先后 //处理数据 写成搜索条件
            $MenuName=Menu::join('shop','menu.sid','=','shop.id')
                ->leftjoin('menu_comment','menu.id','=','menu_comment.uid')
                ->where(function ($query) use($site){
                    if( $site ){
                        $query -> where('shop.site', 'like', "%$site%" );
                    }
                })//区域
                ->where(function ($query) use($money){
                    if($money=='20元以下'){
                        $query -> where('price', '<=', 20);
                    }elseif ($money=='20-40元'){
                        $query -> whereBetween('price',[20,40]);
                    }elseif ($money=='40-60元'){
                        $query -> whereBetween('price',[40,60]);
                    }elseif ($money=='60-80元'){
                        $query -> whereBetween('price',[60,80]);
                    }elseif ($money=='80-100元'){
                        $query -> whereBetween('price',[80,100]);
                    }elseif ($money=='100元以上'){
                        $query -> where('price', '>=', 100 );
                    }
                })//价格区间
                ->where('menu_name','like',"%$menu_name%")
                ->orWhere('key_words','like',"%$menu_name%")
                ->where('shop.active',1)
                ->where('menu.active',1)
                ->select('fenshu','shop.site','menu.id','menu.image_dir','menu.image','menu_name','menu.sid','or_price','price')
                ->get();
            if ($MenuName){
                return view('home.index.seach_m',compact('MenuName'));//html 接收
            }
        }else{
            $MenuName=Menu::join('shop','menu.sid','=','shop.id')
                ->leftjoin('menu_comment','menu.id','=','menu_comment.uid')
                ->where('menu_name','like',"%$menu_name%")
                ->orWhere('key_words','like',"%$menu_name%")
                ->where('shop.active',1)
                ->where('menu.active',1)
                ->select('fenshu','shop.site','menu.id','menu.image_dir','menu.image','menu_name','menu.sid','or_price','price')
                ->get();
//        dd($MenuName);
            return view('home.index.list_m',compact('MenuName','menu_name'));
        }
    }

}
