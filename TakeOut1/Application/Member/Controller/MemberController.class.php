<?php
namespace Member\Controller;

use Home\Controller\LoginBlockController;
use Think\Controller;
use think\db\Where;

class MemberController extends LoginBlockController
{
    //用户中心首页
    public function index()
    {
        $this -> display();
    }

    //我的订单
    public function myorder(){
        $mid = session('mid');
        $orders = M('Orders') -> where("mid=$mid")
                              -> select();
        foreach ($orders as $k => $v){
            $image = M('Menu') -> alias('m')
                               -> join('__ORDERS_MENU__ as om on m.id=om.uid')
                               -> where('om.oid='.$v['id'])
                               -> field('m.image_dir,m.image,m.id')
                               -> find();

            $shop = M("Shop") -> alias('s')
                              -> join('__MENU__ as m on m.sid=s.id')
                              -> field('s.shop_name')
                              -> where("m.id=".$image['id'])
                              -> find();

            $orders[$k]['image_dir'] = $image['image_dir'];
            $orders[$k]['image'] = $image['image'];
            $orders[$k]['shop'] = $shop['shop_name'];
        }
        $this -> assign('orders',$orders);
        $empty = '<h1>暂时没有订单</h1>';
        $this -> assign('empty',$empty);
        $active = [1=>'未付款',2=>'已付款',3=>'已发货',4=>'已签收',5=>'已评论',6=>'已取消',7=>'已退款'];
        $this -> assign('active',$active);
        $this -> display();
    }

    //订单详情
    public function orderMenu($id){
        $menu = M('Menu') -> alias('m')
                          -> join('__ORDERS_MENU__ as om on om.uid=m.id')
                          -> join('__SHOP__ as s on s.id=m.sid')
                          -> where("om.oid=$id")
                          -> field('m.*,s.shop_name,om.num')
                          -> select();
        $this -> assign('menu',$menu);
        $order = M('Orders') -> where("id=$id")
                             -> find();
        $this -> assign('order',$order);
        $redpacket = explode(',',$order['orders_red']);
        $price = $order['orders_price'] + $redpacket[1];
        $this -> assign('price',$price);
        $this -> assign('redpacket',$redpacket);
        $this -> display();
    }

    //我的积分
    public function myscore(){
        $mid = session('mid');
        $member = M('Member') -> where("id=$mid") -> field('score') -> find();
        $score = $member['score'];
        $this -> assign('score',$score);
        $this -> display();
    }

    //我的红包
    public function myred(){
        $mid = session('mid');
        $member = M('Member') -> where("id=$mid") -> field('score') -> find();
        $score = $member['score'];
        $this -> assign('score',$score);
        $redpacket = M('Redpacket') -> where("mid=$mid") -> order('active') -> select();
        $this -> assign('redpacket',$redpacket);
        $empty = '暂时没有红包';
        $this -> assign('empty',$empty);
        $this -> display();
    }

    //红包兑换
    public function convert(){
        if(IS_AJAX){
            $data['type'] = I('post.type');
            $data['value'] = I('post.value');
            $num= I('post.num');
            $data['mid'] = session('mid');
            $data['add_time'] = time();
            $data['end_time'] = strtotime('+7 days');
            $score = I('post.type') == 1? 1.5*I('post.value') : I('post.value');
            $mid = session('mid');
            //验证剩余积分是否够支付
            $myscore = M('Member') -> where("id=$mid") -> field('score') -> find();
            if ($num*$score > $myscore['score']){
                $this->error('当前可用积分不足');
            }
            M('Member') -> startTrans();
            for ($i = 0;$i<$num;$i++) {
                if (M('Redpacket')->add($data)) {
                    $res = true;
                    M('Member') -> where("id=$mid")
                        -> setDec('score',$score);
                } else {
                    M('Member')->rollBack();
                    $this->error('兑换失败');
                }
            }
            if ($res) {
                M('Member') -> commit();
                $this->success('兑换成功');
            }

        }else{
            $mid = session('mid');
            $member = M('Member') -> where("id=$mid") -> field('score') -> find();
            $score = $member['score'];
            $this -> assign('score',$score);
            $this -> display();
        }
    }

    //我的会员
    public function mygrade(){
        $me = getGrade(session('grade'));
        $grade = M('Grade') -> where("grade_name like '%$me%'") -> field('detail') -> find();

        $this -> assign('grade',$grade);
        $this -> display();
    }

    //查看会员详情
    public function getGrades(){
        $grades = M('Grade') -> order('score desc') -> select();
        $this -> assign('grades',$grades);
        $this -> display();
    }

    //退出
    public function logout(){
        session('mid',null);
        session('grade',null);
        session('avatar',null);
        session('username',null);
        redirect(U('/'));
    }

    //我的信息
    public function myinfo(){
        $mid = session('mid');
        if (IS_AJAX){
            $act = I('act');
            if ($act=='active'){
                $id=I('active');
                $data['active'] = 2;
                $data['update_time'] = time();
                M('Member_msg') -> startTrans();
                if(M('Member_msg') -> where("mid=$mid") -> data($data) -> save() ){
                    if (M('Member_msg') -> where("id=$id") -> data(['active'=>'1']) -> save() ){
                        M('Member_msg') -> commit();
                        $this->success('更新默认地址成功');
                    }else{
                        M('Member_msg')->rollBack();
                        $this->error('更新默认地址失败');
                    }
                }else{
                    M('Member_msg')->rollBack();
                    $this->error('更改默认地址失败');
                };
            }elseif($act='msg'){
                $data['username'] = I('get.username');
                if (M('Member') -> where("id=$mid") -> data($data) -> save()){
                    session('mname',I('get.username'));
                    $this->success('更该用户名成功');
                }else{
                    $this->error('更改用户名失败');
                }
            }
        }else{
            $msg = M('Member_msg') -> where("mid=$mid") -> order('active esc') -> select();
            $info = M('Member') -> where("id=$mid") -> find();
            $this -> assign('msg',$msg);
            $this -> assign('info',$info);
            if (empty($msg)){
                $href = U('Member/Member/addmsg');
                $empty = "<a href=$href><button style='font-size: 16px;clear: both' type='button' class='add_msg' >添加收货地址</button></a>";
                $this -> assign('empty',$empty);
            }elseif(count($msg)<5){
                $href = U('Member/Member/addmsg');
                $add_msg = "<a href=$href><button style='font-size: 16px;clear: both' type='button' class='add_msg' >添加收货地址</button></a>";
                $this -> assign('add_msg',$add_msg);
            }
            $this -> display();
        }
    }

    //添加收货地址
    public function addmsg(){
        if (IS_AJAX){
            $msg = D('MemberMsg');
            if (!$msg->create()){
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $errors = $msg->getError();
                $errors = json_encode($errors);
                echo $errors;
            }else{
               $mid = session('mid');
               $data['location'] = I('post.province').'-'.I('post.city').'-'.I('post.town');
               $data['name'] = I('name');
               $data['mobile'] = I('mobile');
               $data['site'] = I('site');
               $data['mid'] = $mid;
                if ($id = M('Member_msg') -> add($data)){
                    M('Member_msg') -> startTrans();
                    if(M('Member_msg') -> where("mid=$mid") -> where("active=1") -> data(['active'=>'2']) -> save()>=0){
                        if (M('Member_msg') -> where("id=$id") -> data(['active'=>'1']) -> save() ){
                            M('Member_msg') -> commit();
                            $this->success('添加地址成功');
                        }else{
                            M('Member_msg')->rollBack();
                            $this->error('更新默认地址失败');
                        }
                    }else{
                        M('Member_msg')->rollBack();
                        $this->error('更改默认地址失败');
                    }
                }else{
                    $this->error('添加地址失败');
                };
           }
        }else{
            $this -> display();
        }
    }

    //收货地址详情
    public function msginfo($id){
        $data = M('Member_msg') -> where("id=$id") -> find();
        $location = explode('-',$data['location']);
        $data['province'] = $location[0];
        $data['city'] = $location[1];
        $data['town'] = $location[2];
        $this -> assign('data',$data);
        $this -> display();
    }

    //修改收货地址
    public function msgedit(){
        $msg = D('MemberMsg');
        if (!$msg->create()){
            // 如果创建失败 表示验证没有通过 输出错误提示信息
            $errors = $msg->getError();
            $this->assign( 'data',I('post.'));
            $this->assign( 'errors',$errors );
            $this->display('msginfo');
        }else{
            $data['location'] = I('post.province').'-'.I('post.city').'-'.I('post.town');
            $data['name'] = I('name');
            $data['mobile'] = I('mobile');
            $data['site'] = I('site');
            $data['mid'] = session('mid');
            $data['update_time'] = time();
            $id = I('post.id');
            if (M('Member_msg') -> where("id=$id") -> data($data) ->save()){
                $status = ['status'=>'ok','msg'=>'保存成功'];
            }else{
                $status = ['status'=>'error','msg'=>'保存失败'];
            }
            $this -> assign('status',$status);
            $data = M('Member_msg') -> where("id=$id") -> find();
            $location = explode('-',$data['location']);
            $data['province'] = $location[0];
            $data['city'] = $location[1];
            $data['town'] = $location[2];
            $this -> assign('data',$data);
            $this -> display('msginfo');
        }
    }

    //删除收货地址
    public function msgdel($id){
        if(M('Member_msg') -> delete($id)){
            $this -> success('删除成功');
        }else{
            $this -> error('删除失败');
        }
    }

    //修改绑定手机
    public function changemobile(){

        $this -> display();
    }

    //手机远程验证
    public function remoteMobile(){
        $mobile = I('post.mobile');
//        dd($mobile);
        if( !$s = M('Member')->where("mobile=$mobile") -> find() ){
            $this -> ajaxReturn('true');
        }else{
            $this -> ajaxReturn('手机号已存在');
        }
    }

    //生成短信验证码
    public function mobile(){
        Vendor('sms.sms','','.class.php');
        $sms = new \ihuyi_sms(C('appid'),C('appkey'),C('url'));
        dd($sms -> send_sms(I('post.mobile')));
        $sms -> send_sms(I('post.mobile'));
    }

    //验证码远程验证
    public function remoteMobileCode(){
        if(session('mobile_code') == I('post.mobile_code') ){
            $this -> ajaxReturn('true');
        }else{
            $this -> ajaxReturn('验码不正确');
        }
    }

    //我的评价
    public function mycomment(){
        $mid = session('mid');
        $comments = M('Orders') -> alias('o')
                -> join('__MENU_COMMENT__ as c on c.oid=o.id')
                -> where("c.mid=$mid")
                -> field('o.id as oid,c.add_time as comment_time,c.detail,c.fenshu,c.id')
                -> order('comment_time desc')
                -> select();
        foreach ($comments as $k => $v){
            $image = M('Menu') -> alias('m')
                -> join('__ORDERS_MENU__ as om on m.id=om.uid')
                -> where('om.oid='.$v['oid'])
                -> field('m.image_dir,m.image,m.id')
                -> find();
            $shop = M("Shop") -> alias('s')
                -> join('__MENU__ as m on m.sid=s.id')
                -> field('s.shop_name')
                -> where("m.id=".$image['id'])
                -> find();
            $id = $v['id'];
            $reply = M('Menu_comment_reply')
                     -> where("mc_id=$id")
                     -> field('reply')
                     -> find();
            $fenshu = $v['fenshu']/5*100;
            $comments[$k]['image_dir'] = $image['image_dir'];
            $comments[$k]['image'] = $image['image'];
            $comments[$k]['shop'] = $shop['shop_name'];
            $comments[$k]['fenshu'] = $fenshu;
            $comments[$k]['reply'] = $reply['reply'];
        }
        $this -> assign('comments',$comments);
        $this -> display();
    }
}