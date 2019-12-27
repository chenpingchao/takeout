<?php

namespace App\Http\Controllers\admin;

use App\Category;
use foo\bar;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //顶级分类列表
    public function list(){
        //判断是否是搜索
        if (\request() -> has('active')){
            //搜索
            //接收搜索条件
            $cate_name = trim(\request('cate_name'));
            $active = request('active');
            //闪存搜索条件
            \request() -> flashOnly('cate_name','active');
            $category = Category::from('category as c1')
                                -> leftJoin('category as c2','c1.pid','=','c2.id')
                                -> select('c1.*','c2.cate_name as parent_name')
                                -> where(function ($query)use ($cate_name){
                                    if (!empty($cate_name)){
                                        $query -> where('c1.cate_name','like',$cate_name);
                                    }
                                })
                                -> where(function ($query)use ($active){
                                    if ($active == 1 || $active == 2){
                                        $query -> where('c1.active',$active);
                                    }
                                })
                                -> paginate(10);
        }else{
            //点击菜单进入
            //顶级分类列表
            $category = Category::where('pid',0) -> paginate(10);
            $cate_name = null;
            $active = null;
        }

        //获取分类的子分类数量
        foreach ($category as $k => $v){
            $category[$k]['child_num'] = Category::where('pid',$v->id) -> count('id');
        }
        return view('admin.category.list',compact('cate_name','active','category'));
    }

    //子分类列表
    public function childList($pid){
        //对应子分类列表 并获取上级分类名称
        $category = Category::where('pid',$pid) -> get();
        //获取分类的子分类数量
        foreach ($category as $k => $v){
            $category[$k]['child_num'] = Category::where('pid',$v->id) -> count('id');
            $category[$k]['parent_name'] = Category::where('id',$v->pid) -> value('cate_name');
            //处理子分类缩进
            $category[$k]['cate_name'] = str_repeat('&emsp;&emsp;',count(explode(',',$v['path'])) - 1).$category[$k]['cate_name'] ;
        }
        return view('admin.category.childList',compact('category'));
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
            //添加分类时要确保分类必须有path 所以使用事务处理
            DB::beginTransaction();
            if ($id = Category::insertGetId(['cate_name'=>$cate_name,'pid'=>$pid])){
                //添加成功后 将路径写入
                //拼接路径
                $parentPath = Category::where('id',$pid) -> value('path');
                $path = empty($parentPath) ? $id : $parentPath.','.$id;
               if (Category::where('id',$id) -> update(['path' => $path])){
                   //成功手动提交
                   DB::commit();
                   return Response() -> json(['status' => 'ok','msg' => '添加成功','url' => route('admin.category.list')]);
               }else{
                   //失败回滚
                   DB::rollBack();
                   return \response() -> json(['status' => 'error','msg' => '路径异常']);
               }
            }else{
             //添加失败
                return \response() -> json(['status' => 'error','msg' => '添加失败']);
            }
        }else{
            //查询上级分类名称
            $parentName = Category::where('id',$pid) -> value('cate_name');
            //展示视图
            return view('admin.category.add',compact('parentName'));
        }
    }

    //修改状态
    public function active($path,$active){
        $a = $active == 1 ? '2' : '1';
        $text = $a == 1 ? '激活' : '停用';

        $arr = explode(',',$path);
        //判断是否是子分类
        if (count($arr) > 1 ){
            $parentActive = Category::where('id',$arr[count($arr) - 2]) -> value('active');
            if ($parentActive == 2){
                return response() -> json(['status'=>'error','msg'=>$text.'失败,上级分类被禁止,不允许激活']);
            }
        }

        if(Category::where('path',$path) -> orWhere('path','like',$path.',%') -> update(['active' => $a])){
            $url = route('admin.category.active',['path' => $path,'active' => $a]);
            return response() -> json(['status'=>'ok','msg'=>$text.'成功','url'=>$url,'text'=>$text,'active'=>$a,'path'=>$path]);
        }else{
            return response() -> json(['status'=>'error','msg'=>$text.'失败']);
        }
    }

    //修改分类信息
    public function edit($id){
        if (request() -> ajax()){
            //验证表单信息
            $this -> validate(\request(),[
                'cate_name' => 'unique:category'
            ],[
                'cate_name.unique' => '该分类已存在',
            ]);
            //修改信息
            //获取数据
            $cate_name = trim(request('cate_name'));
            $pid = \request('pid');
            //开启事务处理
            DB::beginTransaction();
            //修改数据
            if (Category::where('id',$id)
                          -> where(function ($query)use($cate_name){
                              if (!empty($cate_name)){
                                 $query -> update(['cate_name' => $cate_name]);
                              }
                          })
                          -> update(['pid' => $pid])
            ){
                //拼接路径
                $parentPath = Category::where('id',$pid) -> value('path');
                $path = $parentPath.','.$id;
                //更新路径数据
                if (Category::where('id',$id) -> update(['path' => $path])){
                    //手动提交
                    DB::commit();
                    return response() -> json(['status' => 'ok','msg' => '编辑成功']);
                }else{
                    //回滚
                    DB::rollBack();
                    return response() -> json(['status' => 'error','msg' => '编辑路径失败']);
                }
            }else{
                return response() -> json(['status' => 'error','msg' => '编辑失败']);
            }
        }else{
            //查询信息并展示视图
            //查询当前选中分类信息
            $category = Category::find($id);
            //查询所有分类信息
            $categorys = Category::orderBy('path') -> get();
            //根据分类级别进行缩进
            foreach ($categorys as $k => $v){
                 $categorys[$k]['cate_name'] = str_repeat('&emsp;&emsp;',count(explode(',',$v['path']))).$categorys[$k]['cate_name'] ;
            }
            return view('admin.category.edit',compact('category','categorys','parentPath'));
        }
    }

    //获取多级分类下级分类选项
    public function nextList(){
        //接受条件
        $pid = \request('pid');
        $cid = \request('cid');

        $nextCate = Category:: where('pid',$pid)
                            -> get();
        return view('admin.category.nextList',compact('nextCate','cid'));
    }
}
