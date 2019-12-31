<?php

namespace App\Http\Controllers\merchant;

use App\ShopMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class loginController extends Controller
{
//登录模块

    //后台登录的页面
    public function login(){
        if( request() -> ajax() ){
            $this ->validate(request(),[
                'name' => 'bail|required',
                'password' => 'bail|required|between:[6,16]'
            ],[
                'name.required' => '名称不能为空',
                'password.required' => '密码不能为空',
                'password.between' => '密码在6到16位之间',
            ]);
            //接受值
            $name = trim(\request('name'));
            $password = md5(trim(\request('password')));
            $geetestChallenge = \request('geetest_challenge');
            $geetestValidate = \request('geetest_validate');
            $geetestSeccode = \request('geetest_seccode');
            if($this->checkGt($geetestChallenge,$geetestValidate,$geetestSeccode)){
                $rel = ShopMember::whereRaw("(shop_member_name = ? or mobile = ?) and password=?",[$name,$name,$password])
                    -> first();
                if($rel){
//                    dd($rel);
                    session() -> put(['smid' => $rel['id'] , 'smname'=>$rel['shop_member_name'] ]);
                    return response() -> json(['stats'=>'ok','msg'=>'登录成功！' , 'url'=>route('merchant.index') ]);
                }else{
                    return response() -> json(['stats'=>'error','msg'=>'登录失败！' ]);
                }
            }else{
                return response() -> json(['stats'=>'error','msg'=>'图片验证没有通过哦！'/*,'url'=>route('')*/ ]);
            }

        }else{
            return view('merchant.login.login');
        }
    }

    //行为验证码的生成
    public function geetest($id){
        //实例化并传入极验id与key值
        $GtSdk = new \GeetestLib(config('app.GEE_ID'), config('app.GEE_KEY'));
        $user_id = "web";
        $status = $GtSdk->pre_process($user_id);
        $data = array(
            'gtserver'=>$status,
            'user_id'=>$user_id
        );
        session(['geetest'=>$data]);
        echo $GtSdk->get_response_str();
    }

    //行为验证码的校验
    public function checkGt($geetestChallenge,$geetestValidate,$geetestSeccode){
        $GtSdk = new \GeetestLib(config('app.GEE_ID'), config('app.GEE_KEY'));
        $geetest = session("geetest");

        if ($geetest['gtserver'] == 1) {
            $result = $GtSdk->success_validate($geetestChallenge, $geetestValidate, $geetestSeccode, $geetest['user_id']);
            if($result) {
                return true;
            }else{
                return false;
            }
        }else{
            if ($GtSdk->fail_validate($geetestChallenge, $geetestValidate, $geetestSeccode)) {
                return true;
            }else{
                return false;
            }
        }
    }


//注册模块

    //注册
    public function register(){
        if( request() -> ajax() ){
            //表单验证
            $this -> validate(request(),[
                'shop_member_name' => 'bail|required|unique:shop_member|between:4,20',
                'password' => 'bail|required|between:6,16',
                'repwd' => 'bail|required|between:6,16|same:password',
                'mobile' => 'bail|required|regex:/^1[345789][0-9]{9}$/|unique:shop_member|numeric',
                'Auth_code' => 'bail|required|regex:/^[0-9]{4}/',
            ],[
                'shop_member_name.required' => '用户名不能为空',
                'shop_member_name.unique' => '用户名已被占用',
                'shop_member_name.between' => '用户名由4到20个汉字，数字，字母组成',
                'password.required' => '密码不能为空',
                'password.between' => '密码由6到16个数字，字母组成',
                'repwd.required' => '确认密码不能为空',
                'repwd.between' => '确认密码由6到16个数字，字母组成',
                'repwd.same' => '两次密码不一致',
                'mobile.required' => '手机号码不能为空',
                'mobile.unique' => '手机号码已被占用',
                'mobile.numeric' => '手机号码必须是数字',
                'mobile.regex' => '手机号码格式不对',
                'Auth_code.required' => '验证码不能为空',
                'Auth_code.regex' => '验证码必须是4位数字',
            ]);
            $data['shop_member_name'] = trim( request('shop_member_name') );
            $data['password'] = md5( trim( request('password') ) );
            $repwd = md5( trim( request('repwd') ) );
            $data['mobile'] = trim( request('mobile') );
            $data['add_time'] = time();
            $Auth_code = request('Auth_code');
            if($repwd ==  $data['password']){
                if($Auth_code == session('mobile_code')){
                    if($id = ShopMember::insertGetId($data)){
                        //将登录信息写入session
                        session() -> put([ 'smid'=>$id , "smname"=>$data['shop_member_name'] ]);
                        session() -> forget('mobile_code');
                        return response() -> json(['stats' => 'ok','url' =>route('merchant.index') ,'msg' => '注册成功']);
                    }else{
                        return response() -> json(['stats' => 'error', 'msg' => '注册失败']);
                    }
                }else{
                     return response() -> json(['stats' => 'error', 'msg' => '手机验证码不正确']);
                }
            }else{
                return response() -> json(['stats' => 'error', 'msg' => '两次密码不一致']);
            }

        }else{
            return view('merchant.login.register');
        }
    }

    //生成短信验证码
    public function mobile(){
//        return 'a';
        $sms = new \ihuyi_sms(config('app.msg.appid'),config('app.msg.appkey'),config('app.msg.url'));
        $sms -> send_sms($_POST['mobile']);
    }

    //用户名远程验证
    public function remoteShopMemberName(){
        $username = request('username');
        if(ShopMember::where('shop_member_name',$username) -> get()){
            echo 'true';
        }else{
            echo 'false';
        }
    }

    //手机远程验证
    public function remoteMobile(){
        $mobile = \request('mobile');
        if(ShopMember::where('mobile',$mobile) -> get() ){
            echo 'true';
        }else{
            echo 'false';
        }
    }

    //短信验证码远程验证
    public function remoteMobileCode(){
        if(session('mobile_code') == \request('Auth_code') ){
            echo 'true';
        }else{
            echo 'false';
        }
    }

    //退出
    public function logout(){
        session() -> forget('smid');
        session() -> forget('smname');
        return response() -> json(['stats' => 'ok','msg'=>'退出成功' , 'url'=> route('merchant.login') ]);
    }

    //忘记密码
    public function misspwd(){
        if(request() -> ajax()){
            $this -> validate(request(),[
                'password' => 'bail|required|between:6,16',
                'repwd' => 'bail|required|between:6,16|same:password',
                'mobile' => 'bail|required|regex:/^1[345789][0-9]{9}$/|numeric',
                'Auth_code' => 'bail|required|regex:/^[0-9]{4}/',
            ],[
                'password.required' => '密码不能为空',
                'password.between' => '密码由6到16个数字，字母组成',
                'repwd.required' => '确认密码不能为空',
                'repwd.between' => '确认密码由6到16个数字，字母组成',
                'repwd.same' => '两次密码不一致',
                'mobile.required' => '手机号码不能为空',
                'mobile.numeric' => '手机号码必须是数字',
                'mobile.regex' => '手机号码格式不对',
                'Auth_code.required' => '验证码不能为空',
                'Auth_code.regex' => '验证码必须是4位数字',
            ]);
            $data['password'] = md5( trim( request('password') ) );
            $repwd = md5( trim( request('repwd') ) );
            $mobile = trim( request('mobile') );
            $Auth_code = request('Auth_code');
            if($repwd ==  $data['password']){
                if($Auth_code == session('mobile_code')) {
                    if(ShopMember::where('mobile',$mobile) -> update($data)){
                        session() -> forget('mobile_code');
                        return response() -> json(['stats' => 'ok','url' =>route('merchant.login') ,'msg' => '密码更新成功']);
                    }else{
                        return response() -> json(['stats' => 'error', 'msg' => '密码更新失败']);
                    }
                }else{
                    return response() -> json(['stats' => 'error', 'msg' => '手机验证码不正确']);
                }
            }else{
                return response() -> json(['stats' => 'error', 'msg' => '两次密码不一致']);
            }
        }else{
            return view('merchant.login.reset');
        }
    }

}
