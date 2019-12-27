<?php
namespace App\Http\Controllers\Home;

use App\Cart;
use App\Member;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class loginController extends Controller
{
    //弹层登录
    public function loginT(){
        if(request()-> ajax()){
            //数据验证...
            $this->validate(request(),[
                'username'=>'required',
                'password'=>'required',
            ],[
                'username.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
            ]);

            //判断验证码是否正确
            $geetestChallenge=request('geetest_challenge');
            $geetestValidate=request('geetest_validate');
            $geetestSeccode=request('geetest_seccode');
            if($this->checkGt($geetestChallenge,$geetestValidate,$geetestSeccode)){
                //判断用户名和密码是否正确
                $res=Member::whereRaw('(username=? or mobile=?) and password=?',[ trim(request('username')) , trim(request('username')) , md5( trim( request('password') ) ) ])
                    ->select('id','username','avatar','new_login')
                    ->first();
                if($res){
                    //写入session
                    session()->put('mid',$res->id);
                    session()->put('mname',$res->username);
                    session()->put('mavatar',$res->avatar);
                    //将会员等级写入session
                    session()->put('mGrade',getGrade(0));
                    //修改最新登陆时间 上次登陆时间
                    Member::where('id',$res->id)
                        ->update(['new_login'=>time(),'old_login'=>$res->new_login]);
                    //定期增加
                    //将session中购物车信息写入数据库
                    $this -> transfer_login();

                    //响应异步请求
                    return response()->json(['status'=>'ok','msg'=>'登录成功','url'=>url('/')]);
                }else{
                    return response()->json(['status'=>'error','msg'=>'用户名或密码错误','type'=>'username']);
                }
            }else{
                return response()->json(['status'=>'error','msg'=>'请先完成验证','type'=>'verify']);
            }
        }else{
            return view('home.login.loginT');
        }
    }
    //登录
    public function login(){
        if(request()-> ajax()){
            //数据验证...
            $this->validate(request(),[
                'username'=>'required',
                'password'=>'required',
            ],[
                'username.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
            ]);

            //判断验证码是否正确
            $geetestChallenge=request('geetest_challenge');
            $geetestValidate=request('geetest_validate');
            $geetestSeccode=request('geetest_seccode');
            if($this->checkGt($geetestChallenge,$geetestValidate,$geetestSeccode)){
                //判断用户名和密码是否正确
                $res=Member::whereRaw('(username=? or mobile=?) and password=?',[ trim(request('username')) , trim(request('username')) , md5( trim( request('password') ) ) ])
                    ->select('id','username','avatar','avatar_dir','new_login','score')
                    ->first();
                if($res){
                    //写入session
                    session()->put('mid',$res->id);
                    session()->put('mname',$res->username);
                    session()->put('mavatar',$res->avatar);
                    session()->put('mavatar_dir',$res->avatar_dir);
                    //将会员等级写入session
                    session()->put('mGrade',getGrade($res->score));
                    //修改最新登陆时间 上次登陆时间
                    Member::where('id',$res->id)
                        ->update(['new_login'=>time(),'old_login'=>$res->new_login]);
                        //定期增加
                    //将session中购物车信息写入数据库
                    $this -> transfer_login();

                    //响应异步请求
                    return response()->json(['status'=>'ok','msg'=>'登录成功','url'=>url('/')]);
                }else{
                    return response()->json(['status'=>'error','msg'=>'用户名或密码错误','type'=>'username']);
                }
            }else{
                return response()->json(['status'=>'error','msg'=>'请先完成验证','type'=>'verify']);
            }
        }else{
            return view('home.login.login');
        }
    }
    //注册
    public function register(){
        if (request()->ajax()){
            //数据验证
            $this->validate(request(),[
                //验证规则
                'username'=>'bail|required|unique:member|regex:/^[\u4e00-\u9fff\w]{5,16}$/',
                'password'=>'bail|required|min:2|max:20',
                'repwd'=>'bail|required|same:password',
                'mobile'=>'bail|required|unique:member|regex:/^1[35789]\d{9}$/',

            ],[
                //验证条件
                'username.required'=>'用户名不能为空',
                'username.unique'=>'用户名已被占用',
                'username.regex'=>'用户名格式不正确',
                'password.required'=>'密码不能为空',
                'password.min'=>'密码长度至少3个字符',
                'password.max'=>'密码长度最多20个字符',
                'repwd.required'=>'确认密码不能为空',
                'repwd.same'=>'两次密码输入不一致',
                'mobile.required'=>'手机号不能为空',
                'mobile.unique'=>'手机号已被占用',
                'mobile.regex'=>'手机号格式不正确'
                //手机短信验证码单独另起
            ]);
            //判断短信验证码是否正确
            if (session('mobile_code')==trim( request('msg_code'))){

                $data = request()->only('username', 'mobile');
                $data['password']=md5(trim(request('password')));
                $data['add_time']=time();
                $data['money']=1000;
                if ($id = Member::insertGetId($data)) {
                    //用户名id正确写入session
                    session()->put('mid', $id);
                    session()->put('mname', $data['username']);
                    //等级写入
                    session()->put('mgrade', getGrade(0));
                    //让信息验证码失效
                    session()->forget('mobile_code');

                    //将session中购物车信息写入数据库
                   $this -> transfer_register();

                    //响应成功
                    return response()->json(['status' => 'ok', 'msg' => '恭喜您，注册成功' ,'url' => url('/')]);
                }else{
                    return response()->json(['status' => 'error', 'msg' => '注册失败，请稍后再试']);
                }
            }else{
                return response()->json(['status' => 'error', 'msg' => '短信验证码不正确']);
            }
        }else{
            return view("home.login.register");
        }
    }
    //退出
    public function logout(){
        session()->forget('mid');
        session()->forget('mname');
        session()->forget('mavatar');
        session()->forget('mavatar_dir');
        session()->forget('mGrade');
        return redirect(route('/'));
    }
    //生成极验验证码
    public function geetest(){
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
    //检验极验验证码         //$challenge挑战    $validate验证    $seccode记录
    public function checkGt($geetestChallenge,$geetestValidate,$geetestSeccode)
    {
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
    //用户名远程校检
    public function ChkUser(){
        $username=trim(request('username'));
        if($res = Member::where('username',$username)->first()){
            echo 'false';
        }else{
            echo 'true';
        }
    }

    //发送短信验证码
    public function sendMsg(){
        $sms= new \ihuyi_sms(config('app.msg.appid'),config('app.msg.appkey'),config('app.msg.url'));
        $sms -> send_sms( request('mobile') );
    }
    //短信远程校检
    public function chkMsg(){
        //echo 'true';
        if( session('mobile_code') == trim( request('msg_code') ) ){
            echo 'true';
        }else{
            echo 'false';
        }
    }



    //将购物车信息写session中(登录版)
    public function transfer_login(){
        //获取购物车必要的信息
        $cart = session('cart');
        $mid = session('mid');
        //判断购物车中是否有信息
        if($cart){
            //有信息 遍历添加需要的信息
            foreach($cart as $k => $v){
                //判断数据库中是否有该商品
                $rel = Cart::where( 'uid' , $k )-> where('mid',$mid) ->get()->toArray();
                if( !empty($rel) ){
                    //已有该商品（增加数量）
                    Cart::where( 'uid',$k )-> where( 'mid',$mid ) ->increment( 'buynum',$v['buynum'] );
                }else{
                    $cart[$k]['mid'] = $mid;
                    $cart[$k]['add_time'] = time();
                    //没有该商品（添加商品）
                    Cart::insert($cart[$k]);
                }
            }
            //删除session中购物车的信息
            session() -> forget('cart');
        }
    }

    //将购物车信息写session中(注册版)
    public function transfer_register(){
        //获取购物车必要的信息
        $cart = session('cart');
        $mid = session('mid');
        //判断购物车中是否有信息
        if($cart){
            //有信息 遍历添加需要的信息
            foreach($cart as $k => $v){
                $cart[$k]['mid'] = $mid;
                $cart[$k]['add_time'] = time();
            }
            //批量写入数据库中
             Cart::insert($cart) ;
            //        删除session中购物车的信息
            session() -> forget('cart');
        }
    }


    //忘记密码 邮箱
    public function findPassword(){
        if (request()->isMethod('post')){
            //判断是邮件验证码还是手机验证码
            $session_code = request()->has('email')?session()->get('mail_code'):session()->get('mobile_code');
            //判断验证码是否正确
            if($session_code == trim(request('msg_code'))){
                //更新密码
                $password=md5(trim(request('password')));
                if (Member::where('username',trim(request('username')))->update(['password'=>$password])){
                    //密码设置成功
                    return response()->json(['status'=>'ok','msg'=>'密码设置成功','url'=>'login']);
                }else{
                    //密码设置失败
                    return response()->json(['status'=>'error','msg'=>'密码设置失败']);
                }
            }else{
                return response()->json(['status'=>'error','msg'=>'验证码错误']);
            }
        }else{
            return view('home.login.findPassword');
        }
    }
    //邮箱验证码发送
    public function sendMail(){
        if (request()->isMethod('post')){
            $username=trim(request('username'));
            $email=trim(request('email'));
            if (Member::where('username',$username)->where('email',$email)->select()){
                //生成随机数
                $msg_code=get_rand_str();
                //模板页面 Mail::raw( "你的验证码为：$msg_code" ,---原生
                Mail::send('home.login.Mail',['content'=>$msg_code],function ($msg){
                    $msg ->   to( trim( request('email') ) ) ;//收件人地址
                    $msg ->   subject( '找回密码验证码' ) ;   //邮件标题
                });
                                //失败
                if (count( Mail::failures() ) > 0 ){
                    return response()->json(['status'=>'error','msg'=>'邮件发送失败']);
                }else{
                    //验证码存入session
                    session()->put('mail_code',$msg_code); //将验证码写入Session方便以后验证
                    return response()->json(['status'=>'ok','msg'=>'邮件发送成功']) ;
                }
            }else{
                return response()->json(['status'=>'fail','msg'=>'请填入该用户绑定的邮箱地址']) ;
            }
        }
    }
    //检验邮箱验证码
    public function chkMail(){
        $msg_code = trim(request('msg_code'));
        if (session()->get('mail_code')==$msg_code){
            echo 'ture';
        }else{
            echo 'false';
        }
    }


}