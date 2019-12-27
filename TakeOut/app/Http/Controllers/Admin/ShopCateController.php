<?php

namespace App\Http\Controllers\admin;

use App\ShopCate;
use foo\bar;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShopCateController extends Controller
{
    //顶级分类列表
    public function list(){
        //判断是否是搜索
        if (\request() -> has('active')){
            //搜索
            //接收搜索条件
            $cate_name = trim(\request('sc_name'));
            $active = request('active');
            //闪存搜索条件
            \request() -> flashOnly('sc_name','active');
            $category = ShopCate::where(function ($query)use ($cate_name){
                                    if (!empty($cate_name)){
                                        $query -> where('sc_name','like',"%$cate_name%");
                                    }
                                })
                                -> where(function ($query)use ($active){
                                    if ($active == 1 || $active == 2){
                                        $query -> where('active',$active);
                                    }
                                })
                                -> paginate(10);
        }else{
            //点击菜单进入
            //顶级分类列表
            $category = ShopCate::paginate(10);
            $cate_name = null;
            $active = null;
        }

        return view('admin.shopcate.list',compact('cate_name','active','category'));
    }


    //添加分类
    public function add($pid = 0){
        if(request() -> ajax()){
            //检验表单数据
            $this -> validate(\request(),[
                'cate_name' => 'bail|required|unique:category'
            ],[
                'cate_name.required' => '请填写分类',
                'cate_name.unique' => '该分类已存在',
            ]);
            //添加分类
            //获取数据
            $cate_name = \request('cate_name');

            if ($id = ShopCate::insert(['sc_name'=>$cate_name])){
                //添加成功
                return Response() -> json(['status' => 'ok','msg' => '添加成功','url' => route('admin.shopcate.list')]);
            }else{
             //添加失败
                return \response() -> json(['status' => 'error','msg' => '添加失败']);
            }
        }else{
            //展示视图
            return view('admin.shopcate.add',compact('parentName'));
        }
    }

    //修改状态
    public function active($id,$active){
        $a = $active == 1 ? 2 : 1;
        $text = $a == 1 ? '激活' : '停用';
        if(ShopCate::where('id',$id) -> update(['active' => $a])){
            $url = route('admin.shopcate.active',['id'=>$id,'active' => $a]);
            return response() -> json(['status'=>'ok','msg'=>$text.'成功','url'=>$url,'text'=>$text,'active'=>$a]);
        }else{
            return response() -> json(['status'=>'error','msg'=>$text.'失败']);
        }
    }

    //修改分类信息
    public function edit(){
        //验证表单信息
        $this -> validate(\request(),[
            'cate_name' => 'unique:sc_name'
        ],[
            'cate_name.unique' => '该分类已存在',
        ]);
        //修改信息
        //获取数据
        $cate_name = trim(request('sc_name'));
        $id = \request('id');
        //修改数据
        if (ShopCate::where('id',$id)-> update(['sc_name'=>$cate_name])
        ){
            return response() -> json(['status' => 'ok','msg' => '编辑成功']);
        }else{
            return response() -> json(['status' => 'error','msg' => '编辑失败']);
        }
    }


}
