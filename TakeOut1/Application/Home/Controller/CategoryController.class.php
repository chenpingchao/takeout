<?php
namespace Home\Controller;

use Think\Controller;


class CategoryController extends Controller
{
    //显示分类列表
    public function index(){
     /*   $cate = M('Category') ->alias('c')
            ->join('menu as u on c.id=u.cid')
            ->where('count("cid")')
            ->order('')*/
        $this -> display('category');

    }
}