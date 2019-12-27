<?php
namespace Home\Controller;

use Think\Controller;

class MenuController extends Controller
{
    //菜品详情
    public function Order(){
        $this -> display('Menu/order');
    }

}