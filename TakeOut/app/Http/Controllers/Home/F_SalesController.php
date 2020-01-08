<?php

namespace App\Http\Controllers\Home;

use App\Menu;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    //发现
    public function flash(){
        //地区搜索 session--site
        if (request()->isMethod('get')){
            //闪存数据
            request()->flash();
            if (!request('site')){
                session('site',request('city'));
            }else{
                session('site',request('site'));
            }
        }
        if (!empty(session('site'))){
            //将菜品写入队列中

            //取出菜品
        }else{
            //将菜品写入队列中

            //取出菜品
        }
        return view('');
    }

    //生成redis对象
    public function redis(){
        $redis=new \Redis();
        $redis->connect('127.0.0.1',6379);
        return $redis;
    }
    //将菜品id存入redis中的list上
    public function put_menu($site='flash'){
        $redis=$this->redis();
        //判断地区搜索是否存在
        if ($site=='flash'){//不存在地区搜索--无$where
            if (!$redis->exists($site.'str')){//缓存string-不存在数据
                //查询数据库得到id组成的数组
                $menu_id=Menu::alias('u')
                    ->join('shop as s on u.sid=s.id')
                    ->field('u.id')
                    ->select();
                $menu_id=json_encode($menu_id);
                //将数据存入redis中的str中
                $redis->setex($site.'str',86400,$menu_id);
            }else{
                //取出string中的数据
                $menu_id=$redis->get($site.'str');
                $menu_id=json_decode($menu_id,true);
            }
        }else{//存在地区搜索--存$where
            if (!$redis->exists($site.'str')){
                //查询数据库得到id组成的数组
                $menu_id=menu::alias('u')
                    ->join('shop as s on u.sid = s.id')
                    ->where('site','like','%'.$site.'%')
                    ->field('u.id')
                    ->select();
                $menu_id=json_decode($menu_id);
                //数据存入redis中的str
                $redis->setex($site.'str',86400,$menu_id);
            }else{
                //取出string中的数据
                $menu_id=$redis->get($site.'str');
                $menu_id=json_decode($menu_id,true);
            }
        }
        //打乱数组
        shuffle($menu_id);
        //将list中的数据清除
        $redis->delete($site);
        //将id数组存入list中--遍历
        foreach ($menu_id as $k=>$v){
            //将所有菜品id写入redis中--从尾部压入
            $redis->rPush($site,$v['id']);
        }
        return true;
    }

    //将菜品从redis中list取出并查表
    public function get_menu($site='flash'){
        $redis=$this->redis();
        //判断地区搜索是否存在
        if($site=='flash'){
        }else{
            //将地址转换为字节码当成键名
            $site = UnicodeEncode($site);
        }
        //取出8个菜品
        $num=$redis->lSize($site);
        if ($num > 7){
            $num = 8;
        }
        for ($i=0;$i<$num;$i++){
            $menu_id=[];
            $menu_id=$redis->rPop($site);
        }
    }


}
