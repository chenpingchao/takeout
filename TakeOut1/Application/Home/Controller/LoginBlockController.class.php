<?php
namespace Home\Controller;

use Think\Controller;

class LoginBlockController extends Controller
{
    //登录限制
    public function __construct(){
        parent::__construct();
        if(!session('?mid')){
            redirect(U('Home/Login/index'));
        }
    }
}
