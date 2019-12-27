<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Menu;
use App\MenuImage;
use App\Orders;
use App\OrdersMenu;
use App\Shop;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    //菜品列表
    public function list(){
            //搜索
            //接收搜索条件
            $menu_name = trim(\request('menu_name'));
            $key_words = trim(\request('key_words'));
            $shop_name = trim(\request('shop_name'));
            $active = request('active');
            //闪存搜索条件
            \request() -> flashOnly('menu_name','active','key_words','shop_name');
            //根据条件搜索菜品
            $menu = Menu:: from('menu as m')
                         -> orderBy('salde_num','desc')
                         -> join('shop as s','s.id','=','m.sid')
                         -> select('m.*','s.shop_name as shop_name')
                         -> where(function ($query)use ($menu_name){
                                if (!empty($menu_name)){
                                    $query -> where('menu_name','like','%'.$menu_name.'%');
                                }
                        })
                        -> where(function ($query)use ($key_words){
                            if (!empty($key_words)){
                                $query -> where('key_words','like','%'.$key_words.'%');
                            }
                        })
                        -> where(function ($query)use ($shop_name){
                            if (!empty($shop_name)){
                                //查询符合条件的店铺id
                                $query -> where('s.shop_name','like',"%$shop_name%");
                            }
                        })
                        -> where(function ($query) use ($active){
                            if ($active == 1 || $active == 2){
                                $query -> where('m.active',$active);
                            }
                        })
                        -> orderBy('m.sid')
                        -> paginate(10);
        //查询菜品总数
        $data['menu_num'] = count($menu);
        return view('admin.menu.list',compact("menu",'data','menu_name','active'));
    }

    //添加菜单
    public function add(){
        session(['sid' => '1']);
        if (request() -> ajax()){
            //表单验证
            $this -> validate(\request(),[
                'menu_name' => 'bail|required',
                'price' => 'numeric|max:10000',
                'or_price' => 'numeric|max:10000',
                'thirdCate' => 'required'
            ],[
               'menu_name.required' => '菜名不能为空',
               'price.numeric' => '请输入正确的价格',
               'price.max' => '价格不能超过一万',
               'or_price.numeric' => '请输入正确的价格',
                'or_price.max' => '价格不能超过一万',
               'thirdCate.required' => '请选择分类'
            ]);

            //接受表单数据
            $data = \request() -> only('menu_name','key_words','price','or_price','detail');

            //将cid  sid写入数据
            $data['cid'] = \request('thirdCate');
            $data['sid'] = session('sid');

            //判断是否上传主图
            if (\request() -> hasFile('image')){

                $arr = upload(\request() -> file('image'));
                //将图片目录和文件名称写入数据
                $data['image_dir'] = $arr['dir'];
                $data['image'] = $arr['name'];
            }

            //插入记录并获取id
            $id = Menu::insertGetId($data);
            if(!$id){
                //返回并将最后一次插入记录的id存入session
                return \response() -> json(['status' => 'error','msg' => '菜品发布失败']);
            }
            session(['uid' => $id]);
            return response() -> json(['status' => 'ok','msg'=>'菜品发布成功']);
        }else{
            return view('admin.menu.add');
        }
    }


    //添加副图
    public function addImg(){
        //判断是否添加副图
        if (\request() -> hasFile('file')){
            $arr = upload(\request() -> file('file'));
            //将图片目录和文件名称写入数据
            $data['image_dir'] = $arr['dir'];
            $data['image'] = $arr['name'];
            $data['uid'] = session('uid');
            MenuImage::insert($data);
        }else{
            return response() -> json(['status'=>'error',]);
        }
    }

    //菜品的激活和禁用
    public function active($id,$active)
    {
        $shopActive = Menu::from('menu as m')
            -> rightJoin('shop as s', 'm.sid', '=', 's.id')
            -> where('m.id', $id)
            -> select('s.active')
            -> get()
            -> toarray();
        $a = $active == 1 ? '2' : '1';
        $text = $a == 1 ? '激活' : '停用';
        //判断店铺是否被禁用
        if ($shopActive[0]['active'] == 4) {
            return response()->json(['status' => 'error', 'msg' => $text . '失败,店铺已被禁用,不允许激活']);
        }
        //更改自身状态
        if (Menu::where('id',$id) -> update(['active' => $a])){
            $href = route('admin.menu.active',['id'=>$id ,'active'=>$a]);
            $class = '.radius'.$id;
            return response() -> json(['status'=>'ok','msg'=>$text.'成功','href'=>$href,'text'=>$text,'class'=>$class]);
        }else{
            return response() -> json(['status'=>'error','msg'=>$text.'失败']);
        }

    }

    //删除菜品
    public function delete($id){
       if (\request() -> isMethod('post')){
           $id = \request('chk');
           if ( Menu::destroy($id)){
               return \response() -> json(['status'=>'ok','msg'=>'删除成功']);
           }else{
               return \response() -> json(['status'=>'error','msg'=>'删除失败']);
           }
       }else{
           if ( Menu::destroy($id)){
               return \response() -> json(['status'=>'ok','msg'=>'删除成功']);
           }else{
               return \response() -> json(['status'=>'error','msg'=>'删除失败']);
           }
       }
    }

    //编辑菜品
    public function edit($id){
        if(\request() -> ajax()){
        //接收表单信息
            //表单验证
            $this -> validate(\request(),[
                'menu_name' => 'bail|required',
                'price' => 'numeric|max:10000',
                'or_price' => 'numeric|max:10000'
            ],[
                'menu_name.required' => '菜名不能为空',
                'price.numeric' => '请输入正确的价格',
                'price.max' => '价格不能超过一万',
                'or_price.numeric' => '请输入正确的价格',
                'or_price.max' => '价格不能超过一万'
            ]);

            if (\request('thirdCate') == 999){
                return \response() -> json(['status' => 'error','msg' => '请选择正确的分类']);
            }
            //接受表单数据
            $data = \request() -> only('menu_name','key_words','price','or_price','detail');

            //将cid写入数据
            $data['cid'] = \request('thirdCate');
            $data['update_time'] = time();
            //初始化res值
            $res1 = false;
            $res2 = false;
            $res3 = false;

            //处理图片
            if (\request() -> hasFile('image')) {
                foreach (\request() -> file('image') as $k => $v){
                    //判断是否是主图
                    if ($k === 0){
                        //获取旧图信息
                        $old_img = Menu:: where('id',$id)
                                   -> select('image_dir','image')
                                   -> get()
                                   -> toarray();

                        //更新新图
                        $arr = upload($v);
                        $data['image_dir'] = $arr['dir'];
                        $data['image'] = $arr['name'];
                        $res1 =  Menu:: where('id',$id) -> update(['image_dir' => $arr['dir'],'image' => $arr['name']]);
                        if (!$res1){
                            return \response() -> json(['status' => 'error','msg' => '主图编辑失败']);
                        }

                    }else{
                        //获取旧图信息
                        $old_img = MenuImage:: where('id',$k)
                            -> select('image_dir','image')
                            -> get()
                            -> toarray();

                        //更新新图
                        $arr = upload($v);
                        $res2 = MenuImage:: where('id',$k) -> update(['image_dir' => $arr['dir'],'image' => $arr['name']]);
                        if (!$res2){
                            return \response() -> json(['status' => 'error','msg' => '副图编辑失败']);
                        }
                    }
                    //删除旧图
                    unlink($old_img[0]['image_dir'].$old_img[0]['image']);
                    unlink($old_img[0]['image_dir'].'100_'.$old_img[0]['image']);
                    unlink($old_img[0]['image_dir'].'240_'.$old_img[0]['image']);
                    unlink($old_img[0]['image_dir'].'350_'.$old_img[0]['image']);
                    unlink($old_img[0]['image_dir'].'800_'.$old_img[0]['image']);
                }
            }

            //判断是否上传新的副图
            if (\request() -> hasFile('newimg')){
                //接收新图并处理
                foreach (\request() -> file('newimg') as $v){
                    $arr = upload($v);
                    //将新图插入
                    $res3 = MenuImage::insert(['uid' => $id,'image_dir' => $arr['dir'],'image' => $arr['name']]);
                    if (!$res3){
                        return \response() -> json(['status' => 'error','msg' => '副图添加失败']);
                    }
                }
            }

            //更新主表信息
            $res4 = Menu::where('id',$id) -> update($data);
            if ($res1 || $res2 || $res3 || $res4){
                return \response() -> json(['status' => 'ok','msg' => '编辑成功','jump' => route('admin.menu.list')]);
            }
        }else{
         //查询当前菜品信息
            $menu = Menu::find($id);
            $cates = Category:: where('id',$menu -> cid)
                             -> value('path');
            $cates = explode(',',$cates);
            //副图
            $images = MenuImage:: where('uid',$id)
                              -> get();
            return view('admin/menu/edit',compact('menu','cates','images'));
        }
    }

    //展示订单
    public function salde($id){

            //将表单信息存入闪存
            request() -> flash();
            //接受表单数据
            $orders_num = trim(request("orders_num"));
            $start_time = strtotime(request("start_time"));
            $end_time = strtotime(request("end_time"));
            $active = request("active");

                //查询订单列表
                $data = Orders::from('orders as o')
                            -> leftJoin('orders_menu as om','om.oid','=','o.id')
                            -> orderBy("add_time",'desc')
                            -> where('om.uid',$id)
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
                            ->paginate(8);

                if (!empty($data)){
                    //查询商品种类
                    foreach( $data as $k => $v ){
                        $data[$k]['orders_menu_num'] = Orders::from("orders as o")
                            ->join("orders_menu as om",'o.id','=','om.oid')
                            ->where("o.id",$v->id)
                            ->count("om.id");
                    }
                }
        return view("admin.menu.salde",compact('data','orders_num','start_time', 'end_time','active'));
    }

    //展示商品图片
    public function image(){
        $uid = \request('id');
        //查询主图
        $menu_msg = Menu :: where('id',$uid)
                         -> select('image_dir','image')
                         -> get();
        //查询副图
        $menu_image = MenuImage :: where('uid',$uid)
                                -> get();
        return view("admin.menu.image",compact('menu_image','menu_msg'));
    }


}

