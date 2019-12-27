<?php
namespace Home\Controller;


use Think\Controller;

class FindController extends Controller {

    //发现
    public function index(){
        if(IS_AJAX){
            //地区搜索
            session('site',I('get.city'));
        }
        if(session('?site')){
            //将菜品写入队列中
            $this->put_menu(session('site'));
            //取出菜品
            $menu = $this -> get_menu(session('site'));
        }else{
            //将菜品写入队列中
            $this->put_menu();
            //取出菜品
            $menu = $this -> get_menu();
        }

       //辅助分行
        $this -> assign('n',1);
        $this -> assign('empty','这个地方没有菜啦');
        $this -> assign('menu',$menu);
        if(IS_AJAX){
            $this -> display('cityfind');
        }else{
            $this -> display('find');
        }

    }

    //生成redis对象
    function redis(){
        $redis = new \Redis();
        $redis -> connect('127.0.0.1',6379);
        return $redis;
    }

    //将菜品的ID存到redis中listd上
    public function put_menu($site='index'){
        $redis = $this -> redis();
        //判断地区搜索是否存在
        if( $site == 'index' ){
            $where = '' ;
        }else{
            $where['site']=['like','%'.$site.'%'];
            //将地址转换为字节码当成键名
            $site = UnicodeEncode($site);
        }
        //判断redis中的string中是否有数据
        if(!$redis -> exists($site.'str')){
            //查询数据库得到id组成的数组
            $menu_id = M('Menu')->alias('u')
                -> join('one_shop as s on u.sid = s.id')
                -> where($where)
                -> field('u.id')
                -> select();
            $menu_id = json_encode($menu_id);
            //将数组存入redis中的str中
            $redis -> setex($site.'str',86400,$menu_id);
        }else{
            //取出string中的数据
            $menu_id = $redis -> get($site.'str');
            $menu_id = json_decode($menu_id,true);
        }
        //打乱数组
        shuffle($menu_id);

        //将list中的数据清除
        $redis->delete($site);
        //将id数组存入list中
        foreach($menu_id as $k => $v){
            //将所有的菜品ID写入redis中
            $redis -> rPush($site, $v['id']);
        }
        return true;
    }

    //将菜品从redis中list取出并查表
    public function get_menu($site='index'){
        $redis = $this ->redis();
        //判断地区搜索是否存在
        if( $site == 'index' ){
        }else{
            //将地址转换为字节码当成键名
            $site = UnicodeEncode($site);
        }

        //取出24个菜品
        $num = $redis -> lSize($site);
        if($num > 23){
            $num = 24;
        }
        for($i=0 ; $i<$num;$i++){
            $menu_id[] = $redis->rPop($site);
        }
        if(!empty($menu_id)){
            $where1['id'] = ['in',$menu_id];
            //查询菜品
            $menu = M('Menu')-> field('id','menu_name','image_dir','image') ->where($where1) ->select();
            shuffle($menu);
        }
        return $menu;

    }

    //异步请求续页
    public function ajax_page(){
        if(session('?site')){
            //取出菜品
            $menu = $this -> get_menu(session('site'));
        }else{
            //取出菜品
            $menu = $this -> get_menu();
        }

        $this -> assign('n',1);
        $this -> assign('menu',$menu);
        $this -> display('findpage');
    }
}