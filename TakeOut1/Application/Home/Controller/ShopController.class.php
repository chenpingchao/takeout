<?php
namespace Home\Controller;

use Think\Controller;

class ShopController extends Controller
{
    //店铺详情
    public function takeout(){
            $sid=I('get.id');
            //根据$sid--查询店铺详情----------------------------
            $ShopOne= M("shop")->where("id=$sid")
                ->find();
            foreach($ShopOne as $k=> $v){
                $ShopOne['add_time'] = date('Y年m月d日 H:i:s' ,$v['add_time']);
                $ShopOne['time'] = floor((time()-$v['add_time'])/(24*60*60*365));
            }
            //查询店铺菜品表------------------------------------
            $Menu= M("menu")->where("sid=$sid")
                ->field('id,sid,menu_name,image_dir,image,or_price,price,salde_num,detail')
                ->order('salde_num desc')
                ->select();
            //查询的店铺菜品评论--------------------------------
            //根据菜品表id---uid关联菜品评论
            $Menu_id = '';
            foreach ($Menu as $k => $v){
                $Menu_id[$k] = $v['id'];
            }
            $where['uid'] = array('in',$Menu_id );
            //菜品评价 菜名 评价人姓名
//        dd($where['uid']);
            $MenuComment = M('menu_comment') ->alias('mc')
                ->join('one_member as m on mc.mid = m.id')
                ->join('one_menu as u on mc.uid = u.id')
                ->join('one_shop as s on u.sid = s.id')
                ->field('mc.*,username,menu_name,shop_name')
                ->where($where)
                ->order('add_time desc')
                ->limit(3)
                ->select();
            //菜品回复--评价时间戳转为日期
            foreach($MenuComment as $k=> $v){
                $reply = M('Menu_comment_reply') -> where("mc_id={$v['id']}") ->field('id,mid,reply')->find();
                $MenuComment[$k]['reply'] = $reply['reply']?$reply['reply']:'';
                $MenuComment[$k]['rid'] = $reply['id']?$reply['id']:'';
                $MenuComment[$k]['add_time'] = date('Y-m-d H:i:s' ,$v['add_time']);
            }
//        dd($MenuComment);
            //遍历出菜品图片地址------------------------------
            $image_dir = '';
            $image = '';
            foreach ($Menu as $k => $v){
                $image_dir[$k] = $v['image_dir'];
                $image[$k] = $v['image'];
                $filepath=$image_dir[$k].'_100'.$image[$k];
                $filepath='http://www.chpch.top/'.$filepath;
                if(file_exists($filepath)==true)
                {
                    $filepath1=$filepath;
                    $Menu[$k]['filepath1'] = $filepath1;
                }
            }
//        dd($filepath);

            //店铺留言--------------------------------------
            $Guestbook = M('guestbook') ->alias('g')
                ->join('one_guestbook_reply as gr on g.id = gr.Gid')
                ->join('one_member as m on g.mid = m.id')
                ->join('one_shop as s on g.sid = s.id')
                ->where("sid=$sid")
                ->field('g.*,reply,username,shop_name')
                ->order('add_time desc')
                ->limit(3)
                ->select();
            //店铺-评价时间戳转为日期
            foreach($Guestbook as $k=> $v){
                $Guestbook[$k]['add_time'] = date('Y-m-d H:i:s' ,$v['add_time']);
            }
//            dd($Guestbook);
            //收藏总数
            $num=M('collection')->where("sid=$sid")->count('id');
            //---------------------传值----------------------
            $filepath2='/Public/img/cp.jpg';
            $this -> assign('filepath2',$filepath2);//图片选择
            $this -> assign('ShopOne',$ShopOne);//店铺详情
            $this -> assign('Menu',$Menu);//店铺菜品表
            $this -> assign('MenuComment',$MenuComment);//菜品表评论表
            $this -> assign('num',$num);//菜品表评论表
            $this -> assign('Guestbook',$Guestbook);//店铺留言
            $this -> display('Shop/take-out');
    }
    //店铺收藏
    public function Num_T(){
        if (!empty(session('mid'))){
            $sid=I('get.id');
            $where['mid'] = array('in',session('mid'));
            $where['sid'] = array('in',$sid);
            $Scoll=M('collection')->where($where)->select();
            if (empty($Scoll)){
                //创建--根据用户id 店铺id判断
                $data['mid']=session('mid');
                $data['sid']=$sid;
                M('collection')->add($data);
                //同时更改店铺表收藏总数
                $num=M('collection')->where("sid=$sid")->count('id');
                $this->ajaxReturn(['stats' => 'add' , 'msg'=> '收藏成功','num'=>$num]);
            }else{
                //删除
                M('collection')->where($where)->delete();
                //同时更改店铺表收藏总数
                $num=M('collection')->where("sid=$sid")->count('id');
                $this->ajaxReturn(['stats' => 'error' , 'msg'=> '取消收藏','num'=>$num]);
            }
            $this -> display('Shop/take-out');
        }
    }

//店铺留言--表单validate 提交验证------中间件
    public function guestbook($sid){
        if (!empty(session('mid'))){
            if (I('post.content')){
                $content = I('post.content');
                $data['content'] = trim($content);
                $data['mid'] = trim(session('mid'));
                $data['sid'] = trim($sid);
                $data['add_time'] = time();
                if (D("Guestbook")->add($data)){
                    $this->ajaxReturn(['stats' => 'ok']);
                } else{
                    $this->ajaxReturn(['stats' => 'error']);
                }
            }
        }
    }

}