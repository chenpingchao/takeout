<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Admin_logs;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class loginController extends Controller
{
    //登录页
    public function login(){
        if(request() -> ajax()){
            //print_r($_POST);
            //print_r(request()->all());
            //return view("admin.login.login");
            //处理提交的信息
            if( trim(request('captcha')) == session('phrase') ){
                //判断用户名密码是否正确
                $admin = Admin::where( 'username' , trim( request('username') ) )
                    ->where( 'password' , md5( trim( request('password') ) ) )
                    ->first();

                if($admin){
                    //添加登录日志
                    Admin_logs::insert([ 'login_ip'=>$_SERVER['REMOTE_ADDR'] , 'login_time'=>time() , 'active'=>$admin->active ,'aid'=>$admin->id , 'ad_name'=>$admin->username]);
                    //是否被禁用
                    if($admin['active']==1){
                        //更新登录次数 登录ip 登录时间
                        Admin::where('id',$admin->id)
                            ->increment('login_num',1,[ 'login_ip'=>$_SERVER['REMOTE_ADDR'] , 'login_time'=>time() ]);
                        //设置session
                        session( ['aid'=>$admin->id , 'aname'=>$admin->username ] );
                        //清除验证码
                        session() -> forget( 'phrase' );
                        //提示成功---json 无法输出SQL  App/Providers/AppServiceProvider.php  boot--SQL调试数据库监听 需要注释取消
                        return response() -> json( ['status'=>'ok' , 'msg'=>'恭喜,登录成功' , 'url'=>route('bg.index') ] );
                    }else{
                        return response() -> json( ['status'=>'error' , 'msg'=>'该用户已被禁用' ] );
                    }
                }else{
                    return response() -> json( ['status'=>'error' , 'msg'=>'用户名或密码不正确' ] );
                }
            }else{
                return response() -> json( ['status'=>'error' , 'msg'=>'验证码不正确' ] );
            }
        }else{
            //返回登录页面
            return view("admin.login.login");
        }
    }
    //验证码
    public function captcha(){
        $phraseBuilder = new PhraseBuilder(4,'0123456789');   //自定义验证码长度及字符集
        $builder = new CaptchaBuilder(null,$phraseBuilder);   //生成验证码对象
        $builder -> build(80,38);                             //指定宽高
        session() -> put("phrase",$builder -> getPhrase());  //将验证码写入session中
        header("Content-Type:image/png");                     //设置图片格式
        $builder -> output();                                 //输出验证码
    }
    //退出登录
    public function Logout(){
        session()->forget('aid');
        session()->forget('aname');
        return response() -> json( ['status'=>'ok' , 'msg'=>'成功退出' , 'url'=>route('bg') ] );
    }

}
