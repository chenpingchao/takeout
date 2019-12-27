<?php
namespace Home\Controller;

use Think\Controller;
use Think\Verify;

class LoginController extends Controller
{
    //
    public function index(){
        $this -> display('Login/welcome');
    }

    //登陆模块
    public function login()
    {
        if(IS_POST){
            $username = trim(I('post.username'));
            $password  = trim(I('post.password'));
            if( $password ){
                $password = md5($password);
                $where['_logic'] = 'or';
                $where['username'] = array('eq',$username);
                $where['mobile'] = array('eq',$username);
                $map['_logic'] = 'and';
                $map['_complex'] = $where;
                $map['password'] = $password;
                if($member = M('Member')-> field('id,username,avatar,grade,avatar_dir,active')->where($map) -> find() ){
                    if($member['active'] == 1){
                        session('mid',$member['id']);
                        session('mname',$member['username']);
                        session('avatar',$member['avatar_dir'].'8_'.$member['avatar']);
//                        dump(session('avatar'));
                        session('grade',$member['grade']);
                        $this -> ajaxReturn(['status'=> 'ok' , 'msg'=> '登录成功' ]);
                    }else{
                        $this -> ajaxReturn(['status'=> 'error' , 'msg'=> '该用户已被禁用' ]);
                    }
                }else{
                    $this -> ajaxReturn(['status'=> 'error' , 'msg'=> '账户和密码不正确' ]);
                }
            }else{
                $this -> ajaxReturn(['status'=> 'error' , 'msg'=> '密码不能为空' ]);
            }
        }else{
            $this -> display('Login/login');
        }

    }

//注册模块
    public function register(){
        if(IS_POST){
            $Member = D("Member"); // 实例化User对象
            if (!$Member->create()){    // 如果创建失败 表示验证没有通过 输出错误提示信息    dump($Admin->getError());
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $errors = $Member->getError();
                $this -> ajaxReturn($errors);
            }else{
                // 验证通过 可以进行其他数据操作
                $data['username'] = trim(I('post.username'));
                $data['password'] = md5(trim(I('post.password')));
                $data['repwd'] =  md5(trim(I('post.repwd')));
                $data['mobile'] = trim(I('post.mobile'));
                $data['add_time'] = time();
                $mobile_code = I('post.mobile_code');
                if( session('mobile_code') === $mobile_code ){
                    if( $id = M('Member')-> add($data) ){
                        session('mobile_code',null);
                        //将信息写入session
                        session('mid',$id);
                        session('mname',$data['username']);
                        session('grade',0);
                        $this -> ajaxReturn(['status'=>"ok",'msg'=> '注册成功']);
                    }else{
                        $this -> ajaxReturn(['status'=>"error",'msg'=> '注册失败']);
                    }

                }else{
                    $this -> ajaxReturn(['status'=>"error",'msg'=> '验证码不正确']);
                }
            }
        }else{
            $this -> display('Login/register');
        }
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
//        return 'a';
        $sms = new \ihuyi_sms(C('appid'),C('appkey'),C('url'));
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

    //修改密码
    public function pwdChange(){
        if(IS_POST){
            $Member = D("Member"); // 实例化User对象
            $rule=array(
                array('password','require','密码不能为空！'),
                array('password','3,20','mi长度在3到20个字符之间！',0,'length ',1),
                array('repwd','require','确认密码不能为空！'),
                array('repwd','3,20','r长度在3到20个字符之间！',0,'length ',1),
                array('repwd','password','两次密码输入不一致',0,'confirm'),
                array('mobile','require','手机号码不能为空',0),
                array('mobile','/^1[356789][0-9]{9}$/','手机号码格式不正确',0,'regex')
            );
            if(!$Member->validate($rule)->create(I('post.'))){
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $errors = $Member->getError();
                $this -> ajaxReturn($errors);
            }else{
                // 验证通过 可以进行其他数据操作
                $data['password'] = md5(trim(I('post.password')));
                $mobile = I('post.mobile');
                if(M('Member') -> where("mobile=$mobile") -> data($data)->save()){
                    $this -> ajaxReturn(['status'=>"ok",'msg'=> '密码修改成功']);
                }else{
                    $this -> ajaxReturn(['status'=>"error",'msg'=> '密码修改失败']);
                }
            }
        }else{
            $this -> display('password');
        }
    }

    //退出
    public function logout(){
        session('mid',null);
        session('mname',null);
        session('avatar',null);
        session('grade',null);
        redirect(U('Home/Index/index'));
    }


}