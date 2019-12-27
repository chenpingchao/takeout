<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\ArticleSort;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //文章列表
    public function lists(){
        $article_list = Article::all();
        $article_list_num = Article::count('id');
        return view('admin.article.article_list',compact('article_list','article_list_num'));
    }
    //文章分类
    public function sort(){
        $article_sort = ArticleSort::all();
        return view('admin.article.article_Sort',compact('article_sort'));
    }
    //文章详情
    public function detail(){
        $article_detail = Article::all();
        return view('admin.article.article_detail',compact('article_detail'));
    }
    //文章添加
    public function add(){
        if(request() -> isMethod('post')){
            //表单验证
            $this -> validate(request(),[
                //'字段名' => '规则'
                'article_name' => 'required|'
            ],[
                //'字段名'.'规则' => '提示信息'
                'article_name.required' => '文章名称不能为空',
            ]);
            //业务逻辑处理
            $data['article_name'] = trim(\request('article'));
            $data[''];
        }else{
            return view('admin.article.article_add');
        }
    }
    //文章修改
    public function update(){

    }
    //文章删除
    public function delete($id){
        if(Article::destroy($id)){
            return response() -> json (['status' => 'ok','msg' => '删除成功']);
        }else{
            return response() -> json (['status' => 'error','msg' => '删除失败']);
        }
    }
    //批量删除
    public function deletes(){
        if(Article::destory( request( 'chk' ))){
            return response() -> json(['status' => 'ok','msg' => '删除成功']);
        }else{
            return response() -> json(['status' => 'error','msg' => '删除失败']);
        }
    }
    //分类删除
    public function delete1($id){
        if(ArticleSort::destroy($id)){
            return response() -> json (['status' => 'ok','msg' => '删除成功']);
        }else{
            return response() -> json (['status' => 'error','msg' => '删除失败']);
        }
    }
    //批量删除
    public function deletes1(){
        if(ArticleSort::destory( request( 'chk' ))){
            return response() -> json(['status' => 'ok','msg' => '删除成功']);
        }else{
            return response() -> json(['status' => 'error','msg' => '删除失败']);
        }
    }
}