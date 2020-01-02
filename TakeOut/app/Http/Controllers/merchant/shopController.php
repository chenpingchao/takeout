<?php

namespace App\Http\Controllers\merchant;

use App\Category;
use App\Guestbook;
use App\GuestbookReply;
use App\Menu;
use App\MenuComment;
use App\Shop;
use App\MenuCate;
use App\ShopCate;
use App\Tg;
use App\TgMenu;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class shopController extends Controller
{
    //添加店铺
    public function add(){
        if( \request() -> isMethod('post')){
           /* dd(\request() -> all());*/
            $this -> validate(request(),[
                "shop_name" => 'bail|required|between:4,20',
                "website" => 'required',
                "shop_mobile" => 'bail|required|numeric|regex:/^1[35789][0-9]{9}$/|unique:shop',
                "audit_name" => 'required',
                "audit_mobile" => 'bail|required|numeric|regex:/^1[35789][0-9]{9}$/|unique:shop',
                "e_mail" => 'email',
                "Id_number" => 'bail|required|numeric|regex:/^[0-9]{18}$/',
//                "detail" => "bail|regex://",
            ],[
                'shop_name.required' => '必须有店铺名',
                'shop_name.between' => '店铺名在4-20字之间',
                'website.required' => '店铺地址必须填写',
                'shop_mobile.required' => '店铺电话不能为空',
                'shop_mobile.numeric' => '手机号必需为数字',
                'shop_mobile.regex' => '请正确填写手机号码',
                'shop_mobile.unique' => '手机号已存在',
                'audit_name.required' => '店铺负责人姓名不能为空',
                'audit_mobile.required' => '店铺负责人电话不能为空',
                'audit_mobile.numeric' => '手机号必需为数字',
                'audit_mobile.regex' => '请正确填写手机号码',
                'audit_mobile.unique' => '手机号已存在',
                'e_mail.email' => '邮箱格式不正确',
                'Id_number.required' => '身份证号不能为空',
                'Id_number.numeric' => '手机号必需为数字',
                'Id_number.regex' => '请正确填写身份证号',
//                'detail.regex' => '请不要输入特殊符号',
            ]);

            $data['sm_id'] = session('smid');
            $data['shop_name'] = trim(\request('shop_name'));
            $data['sc_id'] = trim(\request('sc_id'));
            $data['location'] = request('province').request('city').request('town');
            $data['site'] = trim(\request('website'));
            $data['shop_mobile'] = trim( request('shop_mobile') );
            $data['audit_name'] = trim( request('audit_name') );
            $data['audit_mobile'] = trim( \request('audit_mobile') );
            $data['e_mail'] = trim( \request('e_mail') );
            $data['Id_number'] = trim( \request('Id_number') );

            $data['detail'] = htmlentities( trim( \request('detail') ) );
            $data['add_time'] = time();

            if( request() -> has('logo') ){
                $file = upload( request() -> file('logo') );
                $data['logo'] = '/'.$file['dir'].'190_'.$file['name'];
            }
            if( request() -> has('image') ){
                $file = upload( request() -> file('image') );
                $data['image'] = '/'.$file['dir'].'350_'.$file['name'];
            }

            //将数据插入数据库中
            if( $sid = Shop::insertGetId($data) ){
                return response() -> json(['stats' => 'ok' , 'url' => route('merchant.shop.detail',['sid' => $sid]) , 'msg' => '店铺添加成功' ]);
            }else{
                return response() -> json(['stats' => 'error' , 'msg' => '店铺添加失败' ]);
            }
        }else{
            $shop_cate = ShopCate::select('id','sc_name') -> get();
            return view('merchant.shop.shopAdd',compact('shop_cate'));
        }
    }
    //添加店铺远程手机号验证1
    public function shopMobile(){
        $mobile = \request('shop_mobile');
        if( !Shop::where('shop_mobile' , $mobile) ->first() ){
            return 'true';
        }else{
            return 'false';
        }
    }
    //添加店铺远程手机号验证2
    public function auditMobile(){
        $mobile = \request('audit_mobile');
        if(!Shop::where( 'audit_mobile' , $mobile ) -> first() ){
            echo 'true';
        }else{
            echo 'false';
        }
    }
    //添加店铺远程身份证号验证
    public function Id_number(){
        $Id_number = \request('Id_number');
        $shop_num = Shop::where( 'Id_number' ,$Id_number ) -> count('id');
        if($shop_num <= 10){
            echo 'true';
        }else{
            echo 'false';
        }
    }

    //店铺详细信息
    public function detail($sid){
        //查询店铺的详细信息
        $detail = Shop::
            find( $sid  );
        $detail->gradebi = ( $detail -> grade /5)*100 ;
        //查询店铺的菜品'信息
        session() -> put(['sid' => $sid]);
        $menu = Menu::where('sid',$sid) -> get();

        //店铺的团购
        $tg =  Tg::where('sid',$sid) -> get();
        //菜品的分类
        $menu_cate = MenuCate::where('sid',$sid) -> get();

        //查询店铺留言
        $guestBook = Guestbook::where( 'sid',$sid ) ->get();
        return view('merchant.shop.shopDetail',compact('detail','menu','sid','guestBook','menu_cate','tg') );
    }

    //店铺修改信息
    public function shopchange(){

        $sid = request('sid');
        $data['shop_name'] = request('shop_name');
        $data['shop_mobile'] = request('shop_mobile');
        $data['site'] = request('site');
        if(Shop::where('id',$sid) -> update($data) ){
            return response() -> json(['stats' => 'ok' , 'msg'=> '更新成功']);
        }else{
            return response() -> json(['stats' => 'error' , 'msg'=> '更新失败']);
        };
    }
    //店铺修改详情
    public function detailchange(){
        $sid = \request('sid');
        $data['detail'] = \request('detail');
        if(Shop::where('id',$sid) -> update($data) ){
            return response() -> json(['stats' => 'ok' , 'msg'=> '更新成功']);
        }else{
            return response() -> json(['stats' => 'error' , 'msg'=> '更新失败']);
        };
    }

    //店铺修改信息
    public function auditchange(){
        $sid = \request('sid');
        $data['audit_name'] = \request('audit_name');
        $data['audit_mobile'] = \request('mobile');
        $data['e_mail'] = \request('e_mail');
        $data['Id_number'] = \request('Id_number');
        if(Shop::where('id',$sid) -> update($data) ){
            return response() -> json(['stats' => 'ok' , 'msg'=> '更新成功']);
        }else{
            return response() -> json(['stats' => 'error' , 'msg'=> '更新失败']);
        };
    }

    //店铺工作休息
    public function shopActive($sid,$active)
    {
        $active = $active == 1 ? 2 : 1;
        $act = $active == 1 ? '工作中' : '打烊了';
        DB::beginTransaction();  //开启事物处理
        $rel1 = Shop::where('id', $sid)->update(['active' => $active]);

        if(Menu:: where('sid',$sid) ->first() ){
            $rel2 = Menu:: where('sid', $sid)->update(['active' => $active]);
        }else{
            $rel2 = 1;
        }
        if ($rel2 && $rel1) {
            DB::commit();
            return response()->json(['stats' => 'ok', 'msg' => $act . '成功', 'act' => $act, 'url' => route('merchant.shop.shopActive', ['sid' => $sid, 'active' => $active])]);
        } else {
            DB::rollback();
            return response()->json(['stats' => 'error', 'msg' => $act . '失败']);
        }
    }

    //上架
    public function menuActive($uid,$active){
        $active = $active==1?2:1;
        $act = $active ==1?'上架':'下架';
        if( Menu::where('id',$uid) -> update(['active'=>$active]) ){
            return response() -> json(['stats' => 'ok' , 'msg'=> $act.'成功','act'=>$act,'url'=>route('merchant.shop.menuActive',['uid'=>$uid,'active'=> $active ])]);
        }else{
            return response() -> json(['stats' => 'error' , 'msg'=> $act.'失败']);
        }
    }

    //添加菜品
    public function menuAdd($sid){
        if(request() -> isMethod('post')){
//            dd(\request() -> all());
            $this -> validate(request(),[
                "menu_name" => 'bail|required|between:2,20',
                "key_words" => 'required',
                "mc_id" => 'required',
                "or_price" => 'bail|required|numeric|min:0',
                "price" => 'bail|required|numeric|min:0',
//                "detail" => "bail|regex://",
            ],[
                'menu_name.required' => '必须有菜品名',
                'menu_name.between' => '菜品名在2-20字之间',
                'key_words.required' => '菜品关键字必须填写',
                'mc_id.required' => '菜品分类不能为空',
                'or_price.required' => '菜品原价不能为空',
                'or_price.numeric' => '菜品原价为数字',
                'or_price.min' => '菜品原价必须大于0',
                'price.required' => '菜品原价不能为空',
                'price.numeric' => '菜品原价为数字',
                'price.min' => '菜品原价必须大于0',
            ]);

            $data['sid'] = \request('sid');
            $data['menu_name'] = trim(\request('menu_name'));
            $data['mc_id'] = trim( \request('mc_id') );
            $data['key_words'] = trim( \request('key_words') );
            $data['or_price'] = trim( \request('or_price') );
            $data['price'] =  trim( \request('price') );
            $data['detail'] = htmlentities( trim( \request('detail') ) );
            $data['add_time'] = time();

            if( request() -> has('image') ){
                $file = upload( request() -> file('image') );
                $data['image_dir'] = $file['dir'];
                $data['image'] = $file['name'];
            }
            DB::beginTransaction();  //开启事物处理
            //统计该店铺所有菜品单价的总和
            $total_price = Menu::where('sid',$data['sid']) -> sum('price');
            //统计菜品数量
            $total_menu = Menu::where('sid',$data['sid']) -> count('id');
            $total_price += $data['price'];
            $total_menu ++;
            //计算店铺平均消费
            $avg_price = floor($total_price/$total_menu);
            //将店铺的平均消费写入数据库中
            $rel1 = Shop::where('id',$data['sid']) ->update(['avg_price'=>$avg_price]);
            $uid = Menu::insertGetId( $data );

            //将数据插入数据库中
            if( $rel1 && $uid ){
                DB::commit();
                return response() -> json(['stats' => 'ok' , 'url' => route('merchant.shop.menuDetail',['uid' => $uid]) , 'msg' => '菜品添加成功' ]);
            }else{
                DB::rollback();
                return response() -> json(['stats' => 'error' , 'msg' => '菜品添加失败' ]);
            }
        }else{
            $menu_cate = MenuCate::where('sid',$sid)->get();
            return view('merchant.shop.menuAdd',compact('sid','menu_cate'));
        }
    }

    //获取多级分类下级分类选项
    public function nextList(){
        //接受条件
        $pid = \request('pid');
        $cid = \request('cid');

        $nextCate = Category:: where('pid',$pid)
            -> get();
        return view('admin.category.nextList',compact('nextCate','cid'));
    }


    //菜品详情
    public function menuDetail($uid){

        $detail = Menu::from('menu as u')
                    ->join('menu_cate as mc','u.mc_id','=','mc.id')
                    ->select('u.*','mc_name')
                    ->where('u.id',$uid)
                    ->first();
        $comment = MenuComment::from('menu_comment as uc')
            ->join('member as m','uc.mid','=','m.id')
            ->select('uc.*','avatar','username')
            ->where('uid',$uid) -> get();


        return view('merchant.shop.menuDetail',compact('detail','comment'));
    }

    //菜品更改
    public function menuChange($uid){
        if(\request() -> isMethod('post')){
            $this -> validate(request(),[
                "menu_name" => 'bail|required|between:2,20',
                "key_words" => 'required',
                "mc_id" => 'required',
                "or_price" => 'bail|required|numeric|min:0',
                "price" => 'bail|required|numeric|min:0',
//                "detail" => "bail|regex://",
            ],[
                'menu_name.required' => '必须有菜品名',
                'menu_name.between' => '菜品名在2-20字之间',
                'key_words.required' => '菜品关键字必须填写',
                'mc_id.required' => '菜品分类不能为空',
                'or_price.required' => '菜品原价不能为空',
                'or_price.numeric' => '菜品原价为数字',
                'or_price.min' => '菜品原价必须大于0',
                'price.required' => '菜品原价不能为空',
                'price.numeric' => '菜品原价为数字',
                'price.min' => '菜品原价必须大于0',
            ]);
            $data['sid'] = \request('sid');
            $data['menu_name'] = trim(\request('menu_name'));
            $data['mc_id'] = trim( \request('mc_id') );
            $data['key_words'] = trim( \request('key_words') );
            $data['or_price'] = trim( \request('or_price') );
            $data['price'] =  trim( \request('price') );
            $data['detail'] = htmlentities( trim( \request('detail') ) );
            $data['add_time'] = time();

            if( request() -> has('image') ){
                $file = upload( request() -> file('image') );
                $data['image_dir'] = $file['dir'];
                $data['image'] = $file['name'];
            }

            DB::beginTransaction();  //开启事物处理
            //统计该店铺所有菜品单价的总和
            $total_price = Menu::where('sid',$data['sid']) -> sum('price');
            //统计菜品数量
            $total_menu = Menu::where('sid',$data['sid']) -> count('id');
            //取出菜品的原价
            $old_price = Menu::where('id',$uid) ->value('price');
            //计算店铺平均消费
            $total_price = $total_price + $data['price']-$old_price;
            $avg_price = floor($total_price/$total_menu);
            //将店铺的平均消费写入数据库中
            $rel1 = Shop::where('id',$data['sid']) ->update(['avg_price'=>$avg_price]);
            $rel2 = Menu::where('id',$uid)->update($data);

            //将数据插入数据库中

            if( $rel2  ){
                DB::commit();
                return response() -> json(['stats' => 'ok' , 'url' => route('merchant.shop.menuDetail',['uid' => $uid]) , 'msg' => '菜品更新成功' ]);
            }else{
                DB::rollback();
                return response() -> json(['stats' => 'error' , 'msg' => '菜品更新失败' ]);
            }
        }else{
            $detail = Menu::where('id',$uid) -> first();
            $menu_cate = MenuCate::where('sid',$detail['sid']) -> get() ;

            return view('merchant.shop.menuChange',compact('detail','menu_cate'));
        }

    }

    //用户留言
    public function guestBook($gid){
        if(\request() -> isMethod('post')){
            $data['gid'] = $gid;
            $data['reply'] = \request('reply');
            if(GuestbookReply::insert($data)){
                return response() -> json(['stats' => 'ok' , 'msg' => '回复成功' ]);
            }else{
                return response() -> json(['stats' => 'error' , 'msg' => '回复失败' ]);
            }
        }else{
            $content = Guestbook::from('guestbook as g')
                ->join('member as m','g.mid','=','m.id')
                ->where('g.id',$gid)
                ->select('g.*','username')
                ->get()
                ->toArray();
            foreach($content as $k=>$v){
                $reply = GuestbookReply::where('Gid',$v['id'])
                    ->get() ->toArray();

                if(!empty($reply)){
                    $content['reply'] = $reply[0]['reply'];
                }else{
                    $content['reply'] = '';
                }
            }


            return view('merchant.shop.guestbook',compact('content'));
        }
    }


//添加菜品分类
    public function addMenuCate($sid){
        if(\request() -> isMethod('post')){
//            dd('aa');
            $data['sid'] = $sid;
            $data['mc_name'] = request('cate');
            if(MenuCate::insert($data)){
                return response()->json(['status'=> 'ok', 'msg'=> '添加成功']);
            }else{
                return response()-> json(['status'=>'error','msg'=> '添加失败']);
            }
        }else{
            return view('merchant.shop.addMenuCate',compact('s_id'));
        }
    }
//显示及更改菜品分类
    public function menuCate($mc_id){
        if(\request() -> isMethod('post')){
//            dd('aa');
            $mc_name = request('cate_name');
            if(MenuCate::where('id',$mc_id)->update(['mc_name'=>$mc_name])){
                return response()->json(['status'=> 'ok', 'msg'=> '修改成功']);
            }else{
                return response()-> json(['status'=>'error','msg'=> '修改失败']);
            }
        }else{
            $menu_cate = MenuCate::find($mc_id);
            return view('merchant.shop.menuCate',compact('menu_cate'));
        }
    }

    //删除菜品分类
    public function deleteMenuCate($mc_id){
        if( MenuCate::destroy( $mc_id ) ){
            return response()->json(['status'=> 'ok', 'msg'=> '删除成功']);
        }else{
            return response()-> json(['status'=>'error','msg'=> '删除失败']);
        }
    }

    //修改分类状态
    public function menuCateActive($mc_id,$active){
        $active = $active == 1 ? 2 : 1;
        $msg = $active ==1 ? '激活' : '禁用';
        DB::beginTransaction();  //开启事物处理
        $rel1 = MenuCate::where('id',$mc_id) -> update(['active'=>$active]);
        if(Menu::where('mc_id',$mc_id) ->first() ){
            $rel2 = Menu:: where('mc_id',$mc_id) -> update(['active'=>$active]);
        }else{
            $rel2 = 1;
        }
        if( $rel2 && $rel1 ){
            DB::commit();
            return response() -> json(['stats' => 'ok' ,'active'=>$active , 'url' => route('merchant.shop.menuCateActive',['mc_id' => $mc_id,'active'=> $active]) , 'msg' => '菜品'.$msg.'成功' ]);
        }else{
            DB::rollback();
            return response() -> json(['stats' => 'error' , 'msg' => '菜品'.$msg.'失败' ]);
        }
    }

    //添加团购
    public function addTuan($sid){
        if(\request() -> isMethod('post')){
            //表单验证
            $this -> validate(request(),[
                "name" => 'bail|required|between:2,18',
                "num" => 'bail|required|numeric|between:2,100',
                "ring" => 'bail|required|numeric|min:2',
                "price" => 'bail|required|numeric|min:0',
                "start_time" => 'bail|required',
                "end_time" => 'bail|required',
//                "detail" => "bail|regex://",
            ],[
                'name.required' => '必须有团购名',
                'name.between' => '名字在2-18字之间',
                'num.required' => '必须有成员数量',
                'num.numeric' => '必须为数字',
                'num.between' => '值在2到100之间',
                'ring.required' => '必须有礼包数量',
                'ring.numeric' => '必须为数字',
                'ring.min' => '最小值为2',
                'price.required' => '必须有价格',
                'price.numeric' => '必须为数字',
                'price.min' => '最小值为0',
                'start_time.required' => '必须有开始时间',
                'end_time.required' => '必须有借宿时间',

            ]);
//            return \response() -> json(\request()->all());
            $data['sid'] = \request('sid');
            $data['name'] = trim( request('name') );
            $data['num'] = trim( request('num') );
            $data['ring'] = trim( request('ring') );
            $data['price'] = trim( request('price') );
            $data['start_time'] = strtotime( request('start_time') );
            $data['end_time'] = strtotime(  \request('end_time') );
            $data['detail'] = trim( request('tg_detail') ) =='请填写团购简介' ? "这个团购的简介不见了":trim( request('tg_detail') );
            $menu_id = \request('chk');
            //获取商品原价
            $data['or_price']= Menu::whereIn('id',$menu_id) -> sum('price');
            DB::beginTransaction();
            if($id = Tg::insertGetId($data)){
                $m = count($menu_id);
                $n = 0;
                foreach($menu_id as $v){
                    $data1['uid'] = $v;
                    $data1['tg_id'] = $id;
                    if( TgMenu::insert($data1)){
                        $n++;
                    }
                }
                if($n == $m){
                    DB::commit();
                    return \response() -> json(['status'=> 'ok' , 'msg' => '团购添加成功']);
                }else{
                    DB::rollBack();
                    return \response() -> json(['status'=> 'error' , 'msg' => '团购添加失败']);
                }
            }else{
                DB::rollBack();
                return \response() -> json(['status'=> 'error' , 'msg' => '团购添加失败']);
            }

        }else{
            $menu = Menu::where('sid',$sid )->get();
            return view('merchant.tuan.addTuan',compact('sid','menu') );
        }
    }

    //显示加修改团购页面
    public function tuan($tg_id){
        if( \request() -> isMethod('post') ){
            //修改团购信息  表单验证
            $this -> validate(request(),[
                "name" => 'bail|required|between:2,18',
                "num" => 'bail|required|numeric|between:2,100',
                "ring" => 'bail|required|numeric|min:2',
                "price" => 'bail|required|numeric|min:0',
                "start_time" => 'bail|required',
                "end_time" => 'bail|required',
//                "detail" => "bail|regex://",
            ],[
                'name.required' => '必须有团购名',
                'name.between' => '名字在2-18字之间',
                'num.required' => '必须有成员数量',
                'num.numeric' => '必须为数字',
                'num.between' => '值在2到100之间',
                'ring.required' => '必须有礼包数量',
                'ring.numeric' => '必须为数字',
                'ring.min' => '最小值为2',
                'price.required' => '必须有价格',
                'price.numeric' => '必须为数字',
                'price.min' => '最小值为0',
                'start_time.required' => '必须有开始时间',
                'end_time.required' => '必须有借宿时间',

            ]);

            $tg_id =  request('tg_id');
            $data['name'] = trim( request('name') );
            $data['num'] = trim( request('num') );
            $data['ring'] = trim( request('ring') );
            $data['price'] = trim( request('price') );
            $data['start_time'] = strtotime( request('start_time') );
            $data['end_time'] = strtotime(  \request('end_time') );
            $data['detail'] = trim( request('tg_detail') ) =='请填写团购简介' ? "这个团购的简介不见了":trim( request('tg_detail') );
            $menu_id = \request('chk');
            //获取商品原价
            $data['or_price']= Menu::whereIn('id',$menu_id) -> sum('price');
            DB::beginTransaction();
            //修改团购信息
            if( Tg::where('id',$tg_id) -> update($data) ){
                $m = count($menu_id);
                $n = 0;
                //删除团购商品
                if(TgMenu::where('tg_id',$tg_id) -> delete() ){
                    //添加团购商品
                    foreach($menu_id as $v){
                        $data1['uid'] = $v;
                        $data1['tg_id'] = $tg_id;
                        if( TgMenu::insert($data1)){
                            $n++;
                        }
                    }
                }else{
                    DB::rollBack();
                    return \response() -> json(['status'=> 'error' , 'msg' => '团购添加失败']);
                }

                if($n == $m){
                    DB::commit();
                    return \response() -> json(['status'=> 'ok' , 'msg' => '团购添加成功']);
                }else{
                    DB::rollBack();
                    return \response() -> json(['status'=> 'error' , 'msg' => '团购添加失败']);
                }
            }else{
                DB::rollBack();
                return \response() -> json(['status'=> 'error' , 'msg' => '团购添加失败']);
            }
        }else{
            //显示团购页面
            $tuan = Tg::find($tg_id);
            $tg_menu_id = TgMenu::where('tg_id',$tuan->id) ->get();
            foreach ($tg_menu_id as $k=> $v){
                $menu_id[$k] =  $v->uid;
            }
//        dd($menu_id);
            $menu = Menu::where('sid',session('sid')) ->get();
            $tg_menu = Menu::find($menu_id);
            return view('merchant.tuan.tuan',compact('tuan','tg_menu','menu','menu_id'));
        }

    }
    //删除团购
    public function tuanDelete(){

    }

    //激活团购
    public function tuanAction(){

    }

}
