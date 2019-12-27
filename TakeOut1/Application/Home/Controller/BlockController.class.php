<?php
namespace Home\Controller;


use think\db\Where;

class BlockController extends LoginBlockController
{
    //添加购物车
    public function addCart($uid){
        $mid = session('mid');


        //查询表中是否有该商品信息
        $where['mid'] = array('eq',$mid);
        $where['uid'] = array('eq',$uid);

        $menu = M("Cart") -> order('add_time','desc')
            ->where($where)
            ->find();
        //判断购物车中是否有该商品的信息
        if($menu){
            //购物车中有该商品
            $result = M('Cart')->where($where)
                ->setInc('buynum' , 1 );
        }else{
            //购物车中没有该商品
            $result = M("Cart")->add([ 'mid'=>$mid, 'uid'=>$uid, 'buynum'=>1, 'add_time'=>time() ]);
        }

        if($result){
            $this ->ajaxReturn(['status' => 'ok' , 'msg' => '购物车已添加' ]);
        }else{
            $this ->ajaxReturn(['status' => 'error' , 'msg' => '购物车添加失败' ]);
        }
    }

    //直接下单
    public function buy(){
        $uid = I('get.uid');
        if(IS_POST){

        }else{
            $this -> display('');
        }
    }
    //菜品添加进购物车 uid sid buynum
    public function GoodsAdd(){
        if (IS_POST){
            $a = I('post.');            //二维数组
            $mid = session('mid');
            $data =[];
            $where['mid'] = array('eq', $mid);
            foreach($a as $k =>$v){     //遍历成三维数组
                if($k == 0){continue;}  //跳出本次循环
                if($v != 0){            //如果$v 即buynum 不为零则 进行操作
                    $where['uid'] = array('eq', $k);
                    $menu = M("Cart")-> where($where) ->find(); //是否为空
                    if(empty($menu)){   //为空则添加
                        $data['buynum'] = $v;
                        $data['uid'] = $k;
                        $data['mid'] = $mid;
                        $data['add_time'] =time();
                        $result = M("Cart") -> add($data);
                    }else{//存在则更新buynum
                        $result = M('Cart')->where($where)
                            ->setInc('buynum', $v);
                    }
                }
            }
            if ($result){
                $this ->ajaxReturn(['status' => 'ok' , 'msg' => '购物车已添加' ]);
            }else{
                $this ->ajaxReturn(['status' => 'error' , 'msg' => '购物车添加失败' ]);
            }
        }
    }
    //购物车页面
    public function ShoPP(){
        //查询数据库中购物车信息--联查商品信息
        //购物车 图片 菜名 价格 内容
        $mid = session('mid');
        $cart= M("cart")->alias('c')->where("mid=$mid")
            ->join('one_menu as u on c.uid = u.id')
            ->field('c.id,uid,buynum,c.add_time,c.active,menu_name,key_words,sid,image_dir,image,or_price,price')
            ->order('add_time desc')
            ->select();
//        dd($cart);
        $this -> assign('cart',$cart);
        $this -> display('Shop/shopping');
    }
    //购物车商品全选或取消
    public function menuCartAll(){
        $active=I("get.active");
        $msg = $active ==1 ? '全选': '取消';
        $mid = session('mid');
        $where['mid'] = array('eq',$mid);
        $cart=M("cart")->where($where)->save(['active'=>$active]);
        if($cart){
            $this ->ajaxReturn(['stats' => 'ok' , 'msg' => $msg.'成功' ]);
        }else{
            $this ->ajaxReturn(['stats' => 'error' , 'msg' => $msg.'失败' ]);
        }
    }
    //购物车商品状态修改 单选
    public function menuCartActive($uid,$active){
        $active = $active ==1 ? 2 : 1 ;
        $msg = $active ==1 ? '选中':'取消';
        $mid = session('mid');
        $where['mid'] = array('eq',$mid);
        $where['uid'] = array('eq',$uid);
        $cart=M("cart")->where($where)->save(['active'=> $active]);
        if($cart){                                             //{:U('Home/Block/menuCartActive',array('uid'=>$v[uid],'active'=>$v[active]))}
            $this ->ajaxReturn(['stats' => 'ok' ,'url' => U('Home/Block/menuCartActive',array('uid'=>$uid,'active'=>$active)), 'msg' => $msg.'成功' ]);
        }else{
            $this ->ajaxReturn(['stats' => 'error' , 'msg' => $msg.'失败' ]);
        }
    }

    //购物车商品增加
    public function menuCartAdd($uid){
        $mid = session('mid');
        $where['mid']=array('eq',$mid);
        $where['uid']=array('eq',$uid);
        $cart=M("cart")->where($where)->setInc('buynum',1);
        if($cart){
            $this ->ajaxReturn(['stats' => 'ok' , 'msg' => '增加成功' ]);
        }else{
            $this ->ajaxReturn(['stats' => 'error' , 'msg' => '增加失败' ]);
        }
    }
    //购物车商品减少
    public function menuCartMin($uid){
        $mid = session('mid');
        $where['mid']=array('eq',$mid);
        $where['uid']=array('eq',$uid);
        $cart=M("cart")->where($where)->field('buynum')->find();
//        var_dump($cart); find 查询语句查一条     field 查询字段名
//        exit();
        if( $cart['buynum'] > 1){
            if(M("cart")->where($where)->setDec('buynum',1)){
                $this ->ajaxReturn(['stats' => 'ok' , 'msg' => '减少成功' ]);
            }else{
                $this ->ajaxReturn(['stats' => 'error' , 'msg' => '减少失败' ]);
            }
        }else{
            $this ->ajaxReturn(['stats' => 'error' , 'msg' => '减少失败' ]);
        }
    }
    //购物车商品指定数量
    public function menuCartAssign($uid,$num=0){
        //判断$num是否大于0
        if(! $num > 0 || is_int($num) ){
            $this ->ajaxReturn(['stats'=> 'error' ,'msg'=> "请输入大于0的整数"] );
        }
        //用户已登录
        $mid = session('mid');
        $where['mid']=array('eq',$mid);
        $where['uid']=array('eq',$uid);
        $data['buynum']=$num;
        if(M("cart")->where($where)->save($data)){
            $this ->ajaxReturn(['stats' => 'ok' , 'msg' => '修改成功' ]);
        }else{
            $this ->ajaxReturn(['stats' => 'error' , 'msg' => '修改失败' ]);
        }
    }
    //购物车商品删除
    public function deleteCart($uid){
        $mid = session('mid');
        $where['mid']=array('eq',$mid);
        $where['uid']=array('eq',$uid);
        if(M('cart')->where($where)->delete()){
            $this ->ajaxReturn(['stats' => 'ok' , 'msg' => '删除成功' ]);
        }else{
            $this ->ajaxReturn(['stats' => 'error' , 'msg' => '删除失败' ]);
//            return response()-> json(['stats' => 'error' , 'msg' => '删除失败' ]);
        }
    }


    //结算模块


}