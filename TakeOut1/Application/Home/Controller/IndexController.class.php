<?php
namespace Home\Controller;

use Think\Controller;
use Think\Page;

class IndexController extends Controller
{
    //主页
    public function index()
    {
        //微信已关注用户
       /* if(I('get.code')){
            $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx7b1363f88d80ff3c&secret=4a2bbcc3f98e059cc255aefd0115af49&code='.I('get.code').'&grant_type=authorization_code';
            $rel = $this -> network_request($url);
            $rel = json_decode($rel,true);
            print_r($rel);
            echo $url;
        }*/
       //微信未关注的用户
       /* if(I('get.code')) {
            $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx7b1363f88d80ff3c&secret=4a2bbcc3f98e059cc255aefd0115af49&code=' . I('get.code') . '&grant_type=authorization_code';
            $rel = $this->network_request($url);
            $rel = json_decode($rel, true);

            $url2 = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$rel['access_token'].'&openid='.['$rel->openid'].'&lang=zh_CN';
            $rel2 = $this ->network_request($url2);
            $rel2 = json_decode($rel2,true);
            print_r($rel2);
        }*/
        //主页
        $n = 1;$m=1;
        $this -> assign('n',$n);
        $this -> assign('m',$m);
        if(IS_AJAX){
            session('site',I('get.city'));
            $where['site']=['like','%'.I('get.city').'%'];
            $where['active']=[ 'eq',1];
            //查询相关店铺
            $shop = M('Shop') ->field('id,logo,shop_name')
                -> where($where)
                -> order('grade desc')
                -> limit(0,6)
                -> select();

            foreach ($shop as $k => $v){
                $shop_id[$k] = $v['id'];
            }

            $where1['sid'] = array('in',$shop_id );
            $where1['active']=[ 'eq',1];
            //查询相关菜品
            $menu = M('Menu')
                ->field('id,image_dir,image,menu_name')
                ->where($where1)
                -> order('salde_num desc')
                -> limit(0,6)
                -> select();

            $this -> assign('menu',$menu);
            $this -> assign('shop',$shop);
            $this -> assign('empty_shop','该地区暂时没有店铺哟');
            $this -> assign('empty_menu','暂时没有菜品哟');
            $this -> display('Index/cityMenuPage');
        }else{
            $menu = M('Menu') ->field('id,image_dir,image,menu_name')->where('active=1') -> order('salde_num desc') -> limit(0,6) -> select();
            $shop = M('Shop') ->field('id,logo,shop_name') ->where('active=1') -> order('grade desc') -> limit(0,6) -> select();
            $this -> assign('menu',$menu);
            $this -> assign('shop',$shop);
            $this -> display('Index/index');
        }

    }

    //菜品列表页面
    public function menu_list(){
        //辅助分行
        $n = 1;
        $this -> assign('n',$n);
        $this -> assign('empty_menu','暂时没有菜品哟');
        if(IS_POST){
            //有搜索（判断条件）
            if(I('post.search')){
               session('search',I('post.search')) ;
            }
            //搜索的条数
            if(!I('post.pageNum')){
                $pageNum = 0;
            }else{
                $pageNum = I('post.pageNum');
            }
            $where3['_logic'] = 'or';
            $where3['menu_name'] = ['like','%'.session('search').'%'];
            $where3['key_words'] = ['like','%'.session('search').'%'];
            $map['_logic'] = 'and';
            $map['_complex'] = $where3;
            //城市搜索
            if(session('?site')){
                //已存在城市搜索
                $map['u.active'] =  array('eq',1);
                $map['site']=['like','%'.session('site').'%'];
                $menu = M('Menu')->alias('u')
                    -> join('one_shop as s on u.sid=s.id')
                    -> field('u.*')
                    -> where($map)
                    -> order('salde_num desc')
                    -> limit($pageNum,24)
                    -> select();
            }else{
                //不存在城市搜索
                $map['active'] = ['eq',1];
                $menu = M('Menu')->where($where3)
                    -> order('salde_num desc')
                    -> limit($pageNum,24)
                    -> select();
            }
            $this -> assign( 'menu' , $menu );        //查询出菜品信息
            if(IS_AJAX){
                $this -> display('Search/menuSearchPage'); //显示分页视图
            }else{
                $this -> assign( 'haveSearch' , 'yes' );      //辅助搜索
                $this -> assign( 'pageNum' , $pageNum );  // 已查询的条数
                $this -> display( 'Search/menuSearch' );     //显示视图
            }

        }else{
            //未搜索(辅助搜索)
            //搜索的条数
            if(!I('get.pageNum')){
                $pageNum = 0;
            }else{
                $pageNum = I('get.pageNum');
            }

            //是否存在城市搜索
            if(session('?site')){
                //已存在城市搜索
                $where2['u.active'] = ['eq',1];
                $where2['site']=['like','%'.session('site').'%'];
                $menu = M('Menu')->alias('u')
                    -> join('one_shop as s on u.sid=s.id')
                    -> where($where2)
                    -> field('u.*')
                    -> order('salde_num desc')
                    -> limit($pageNum,24)
                    -> select();
            }else{
                //不存在城市搜索
                $menu = M('Menu')
                    -> order('id desc')
                    ->where('active=1')
                    -> limit($pageNum,24)
                    -> select();
            }
            $this -> assign('menu',$menu);  //查询出菜品信息
            if(IS_AJAX){
                $this -> display('Search/menuSearchPage'); //显示分页视图
            }else{
                //清理session
                session('search',null);
                $this -> assign('haveSearch','');//辅助搜索
                $this -> assign('pageNum',$pageNum);  // 已查询的条数
                $this -> display('Search/menuSearch');     //显示视图
            }
        }
    }

    //商店列表页面
    public function shop_list(){
        $n = 1;
        $this -> assign('n',$n);
        $this -> assign('empty_shop','暂时没有店铺哟');
        if(IS_POST){
            //有搜索（判断条件）
            if(I('post.search')){
                session('shop_search',I('post.search')) ;
            }
            //搜索的条数
            if(!I('post.pageNum')){
                $pageNum = 0;
            }else{
                $pageNum = I('post.pageNum');
            }
            $where4['shop_name'] = ['like','%'.session('shop_search').'%'];
            $where4['active'] = ['eq',1];
            //城市搜索
            if(session('?site')){
                //已存在城市搜索;
                $where4['site']=['like','%'.session('site').'%'];
                $shop = M('Shop') -> where($where4)
                    -> order('grade desc')
                    -> limit($pageNum,10)
                    -> select();
            }else{
                //不存在城市搜索
                $shop = M('Shop')->where($where4)
                    -> order('grade desc')
                    -> limit($pageNum,10)
                    -> select();
            }
            foreach($shop as $k=> $v){
                $shop[$k]['gradebi'] = ($v['grade']/5)*100 ;
            }
            $this -> assign( 'shop' , $shop );        //查询出商店信息
            if(IS_AJAX){
                $this -> display('Search/shopSearchPage'); //显示分页视图
            }else{
                $this -> assign( 'haveSearch' , 'yes' );      //辅助搜索
                $this -> assign( 'pageNum' , $pageNum );  // 已查询的条数
                $this -> display( 'Search/shopSearch' );     //显示视图
            }

        }else{
            //未搜索(辅助搜索)
            //搜索的条数
            if(!I('get.pageNum')){
                $pageNum = 0;
            }else{
                $pageNum = I('get.pageNum');
            }
            $where5['active'] = ['eq',1];
            //是否存在城市搜索
            if(session('?site')){
                //已存在城市搜索;
                $where5['site']=['like','%'.session('site').'%'];
                $shop = M('Shop') -> where($where5)
                    -> order('grade desc')
                    -> limit($pageNum,10)
                    -> select();
            }else{
                //不存在城市搜索
                $shop = M('Shop')
                    ->where($where5)
                    -> order('grade desc')
                    -> limit($pageNum,10)
                    -> select();
            }
            foreach($shop as $k=> $v){
                $shop[$k]['gradebi'] = ($v['grade']/5)*100 ;
            }
            $this -> assign( 'shop' , $shop );        //查询出店铺信息
            if(IS_AJAX){
                $this -> display('Search/shopSearchPage'); //显示分页视图
            }else{
                session('shop_search',null);   //清除session
                $this -> assign('haveSearch','');//辅助搜索
                $this -> assign('pageNum',$pageNum);  // 已查询的条数
                $this -> display('Search/shopSearch');     //显示视图
            }
        }
    }


    //菜品详细
    public function menuDetail($uid){
        //菜品详细信息
        $menu = M("Menu") -> where( "id=$uid" )-> find();
        //店铺信息
        $shop = M('Shop') -> where("id={$menu['sid']}") -> find();

        //菜品评价
        $evaluate = M('Menu_comment') ->alias('mc')
            ->join('one_member as m on mc.mid = m.id')
            ->field('mc.*,username')
            -> where("mc.uid=$uid")
            ->select();
        foreach($evaluate as $k=> $v){
            $evaluate[$k]['fenshubi'] = ($v['fenshu']/5)*100 ;
            $evaluate[$k]['reply'] = M('Menu_comment_reply') -> where("id={$v['id']}") ->find();
            $evaluate[$k]['add_time'] = date('Y-m-d H:i:s' ,$v['add_time']);
        }
        $this ->assign('menu',$menu);
        $this ->assign('shop',$shop);
        $this ->assign('evaluate',$evaluate);
//        dump($evaluate);
        $this -> display('Index/menuDetail');
    }

    //万能的模拟请求
    public function network_request($url,$type='get',$data=''){
        //1.初始化curl
        $curl = curl_init();
        //2.配置curl
        //配置要访问的url地址
        curl_setopt($curl,CURLOPT_URL,$url);
        //配置将请求结果以文档流的方式返回，而不是在页面上直接显示
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

        //判断是否为post请求
        if($type == 'post'){
            //设置请求访问为post
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        }

        //关闭SSL验证
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);


        //3.发送请求,获取请求结果
        $res = curl_exec($curl);

        //4.关闭curl
        curl_close($curl);

        return $res;
    }



}