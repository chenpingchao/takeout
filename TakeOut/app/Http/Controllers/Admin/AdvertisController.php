<?php

namespace App\Http\Controllers\admin;

use App\Advertis;
use App\Advertis_list;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertisController extends Controller
{
    //广告位首页
    public function index(){
        //搜素
        //接受搜索条件
        $advertisP_name = trim(\request('advertisP_name'));
        $avtive = request('active');
        //闪存搜索条件
        \request() -> flashOnly('advertisP_name','active');
        $advertis_index = Advertis::paginate(5);
        $advertis_index_num = Advertis::count('id');
        return view('admin.advertis.advertis', compact('advertis_index','advertis_index_num'));
    }
    //添加广告位
    public function add(){
        if (request()->isMethod('post')){
            //闪存数据
            request()->flash();
            //表单验证
            $this->validate(request(), [
                //'字段名' => '规则'
                'advertisP_name' => 'bail|required|unique:advertis',
            ], [
                //'字段名'.'规则' => '提示信息'
                'advertisP_name.required' => '广告位名称不能为空',
                'advertisP_name.unique' => '广告位名称已被占用',
            ]);
            //业务逻辑处理
//            $data = request()->except('_token');
            $data['advertisP_name'] = trim(\request('advertisP_name'));
            $data['width'] = trim(\request('width'));
            $data['height'] = trim(\request('height'));
            $data['advertis_num'] = trim(\request('advertis_num'));
            $data['add_time'] = time();
            $data['description'] = trim(\request('description'));
            if( Advertis::insert($data) ){
                return back()->with('status','ok');
            }else{
                return back()->with('status','error');
            }
        }else{
            return view('admin.advertis.advertis_add');
        }
    }
    //编辑广告位
    public function edit($id){
        if(request()->isMethod('post')){
            //闪存数据
            request()->flash();
            //表单验证
            $this->validate(request(),[
                'advertisP_name' => 'bail|required'
            ],[
                'advertisP_name.required' => '广告位名称不能为空',
            ]);
            //业务逻辑处理
            $data['advertisP_name'] = trim(\request('advertisP_name'));
            $data['advertis_num'] = trim(\request('advertis_num'));
            $data['width'] = trim(\request('width'));
            $data['height'] = trim(\request('height'));
            $data['add_time'] = time();
            $data['description'] = trim(\request('description'));
            if(Advertis::where('id',$id)->update($data)){
                return back()->with('status','ok');
            }else{
                return back()->with('status','error');
            }
        }else{
            $advertis_edit = Advertis::find($id);
            return view('admin.advertis.advertis_edit',compact('advertis_edit'));
        }
    }
    //广告列表
    public function details($id){
        $advertis_list = Advertis_list::where('ap_id',$id)->paginate(5);
        $advertis_num = Advertis::count('advertis_num');
        $ap_id = $id;
        return view('admin.advertis.advertis_list',compact('advertis_list','advertis_num','ap_id'));
    }
    //给指定的广告位添加广告
    public  function addad($ap_id){
        if(request()->isMethod('post')){
            //闪存数据
            request()->flash();
            //表单验证
            $this->validate(request(),[
                'advertis_name'=>'bail|required'
            ],[
                'advertis_name.required'=>'广告标题不能为空'
            ]);

            //上传图片
            if(request()->hasFile('image')){
                $width  = \request('width');
                $height  = \request('height');
                //上传处理
                $arr = ad_upload(request()->file('image'),$width,$height);
                //写入数据库
                //$data = request()->except(['_token','image']);
                $data['advertis_name'] = \request('advertis_name');
                $data['ap_id'] = $ap_id;
                $data['img_dir'] = $arr['dir'];
                $data['image'] = $arr['name'];
                $data['start_time'] = strtotime( request('start_time') );
                $data['end_time'] = strtotime( request('end_time') );
                if(Advertis_list::insert($data)){
                    return back()->with('status','ok');
                }else{
                    return back()->with('status','error');
                }
            }
        }else{
            //根据id查询广告位的相关信息
            $advertis_index = Advertis::find($ap_id);
            return view('admin.advertis.addadvertis',compact('advertis_index','ap_id'));
        }
    }

    //编辑广告
    public function editad($id){
        if(request()->isMethod('post')){
            //闪存数据
            request()->flash();
            //表单验证
            $this->validate(request(),[
                'advertis_name'=>'required'
            ],[
                'advertis_name.required'=>'广告标题不能为空'
            ]);
            //业务处理
            $data=request()->except(['_token','image']);
            $data['start_time'] = strtotime(request('start_time'));
            $data['end_time'] = strtotime(request('end_time'));
            if(request() -> hasFile('image')){
                $arr = upload(request()->file('image'));
                $data['img_dir'] = $arr['dir'];
                $data['image'] = $arr['name'];
                //查询旧图信息并删除旧图
                $ad = Advertis_list::select('img_dir','image') -> find($id);
                if(file_exists($ad -> img_dir.$ad -> image)){
                    unlink($ad -> img_dir . $ad -> image);
                }
            }
            //更新
            if(Advertis_list::where('id',$id)->update($data)){
                return back()->with('status','ok');
            }else{
                return back()->with('status','error');
            }

        }else{
            $advertis_list = Advertis_list::join('Advertis as ad','advertis_list.ap_id','=','ad.id')
                ->select('advertis_list.*','width','height')
                ->find($id);
            return view('admin.advertis.editadvertis',compact('advertis_list'));
        }
    }

    //广告位激活与禁用
    public function active($id,$active){
        $a = $active == 1 ? 2 : 1;
        $text = $active == 1 ? '不显示' : '显示';

        if(Advertis::where('id',$id) -> update(['active' => $a])){
            return response() -> json (['status'=>'ok','msg'=>$text.'成功','href'=>route('bg.advertis.active',['id'=>$id,'active'=>$a]),'text'=>$text]);
        }else{
            return response() -> json (['status'=>'error','msg'=>$text.'失败']);
        }
    }
    //广告激活与禁用
    public function active1($id,$active){
        $a1 = $active == 1 ? 2 : 1;
        $text1 = $active == 1 ? '不显示' : '显示';
//        dd($a1);
        if(Advertis_list::where('id',$id) -> update(['active' => $a1])){
            return response() -> json (['status'=>'ok','msg'=>$text1.'成功','href'=>route('bg.advertis.active1',['id'=>$id,'active'=>$a1]),'text'=>$text1]);
        }else{
            return response() -> json (['status'=>'error','msg'=>$text1.'失败']);
        }
    }
    //删除
    public function delete($id){
        if(Advertis::destroy($id)){
            return response() -> json( ['status'=>'ok','msg'=>'删除成功'] );
        }else{
            return response() -> json( ['status'=>'error','msg'=>'删除失败'] );
        }
    }
    public function delete1($id){
        if(Advertis_list::destroy($id)){
            return response() -> json( ['status'=>'ok','msg'=>'删除成功'] );
        }else{
            return response() -> json( ['status'=>'error','msg'=>'删除失败'] );
        }
    }
    //批量删除
    public function deletes(){
        if(Advertis::destroy( request('chk') ) ){
            return response() -> json( ['status'=>'ok','msg'=>'删除成功']);
        }else{
            return response() -> json( ['status'=>'error','msg'=>'删除失败']);
        }
    }
}