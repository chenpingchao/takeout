<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\AdminRoles;
use App\Admin_logs;

class AdminController extends Controller{
    //管理员列表
    public function ad_list(){
        //将表单信息存入闪存 // get 传值页可接收
        request() -> flash();
        //接受表单数据
        $Grade=trim(request('grade'));
        $username = trim(request("username"));
        $add_time = strtotime(request("add_time"));
        $active = request("active");

        $admins=Admin::orderBy("add_time",'desc')
            //管理员姓名 模糊查询
            ->where(function ($query) use($username){
                if( $username ){
                    $query -> where('username', 'like', "%$username%" );
                }
            })
            //根据grade 查询
            ->where(function ($query) use($Grade){
                if( $Grade ){
                    $query -> where('grade', $Grade );
                }
            })
            //添加时间
            ->where(function ($query) use($add_time){
                if( $add_time ){
                    $query -> where('add_time', '>=', $add_time );
                }
            })
            //状态查询  激活状态 1已激活 2未激活
            ->where(function ($query) use($active){
                if( $active==1 || $active==2){
                    $query -> where("active" , $active);
                }
            })
            ->paginate(3);//排序
//        dd(\request()->all());
        $Admins_num = Admin::count("id");
        $Grade1= Admin::where('grade',1)->count();
        $Grade2= Admin::where('grade',2)->count();
        $Grade3= Admin::where('grade',3)->count();
        $Grade4= Admin::where('grade',4)->count();
        //print_r($admins);
        return view('admin.admin.admin_list',compact('admins','username','add_time','active','Admins_num','Grade','Grade1','Grade2','Grade3','Grade4'));//compact 压缩
    }
    //添加管理员
    public function ad_add(){
        if (request()->isMethod('post')){
            //闪存数据
            request()->flash();
            //print_r(request('email'));
            //exit();
            //表单验证
            $this->validate(request(), [
                //'字段名' => '规则'
                'username' => 'bail|required|unique:admin|regex:/^[a-zA-Z0-9_-]{2,20}$/',//姓名
                'password' => 'bail|required|between:4,21',//密码
                'pwd' => 'bail|required|same:password',//确认密码
                'moble' => 'bail|required|regex:/^1[3456789]\d{9}$/',//手机
                'email' => 'bail|required|email',//邮箱
                'detail' => 'bail|between:0,100'
            ], [
                //'字段名'.'规则' => '提示信息'
                'username.required' => '用户名不能为空',
                'username.unique' => '用户名已被占用',
                'username.regex' => '用户名格式不正确',
                'password.required' => '密码不能为空',
                'password.between' => '密码长度要求5-20个字符',
                'pwd.required' => '确认密码不能为空',
                'pwd.same' => '两次密码输一致',
                'moble.required' => '手机号不能为空',
                'moble.regex' => '手机号格式不正确',
                'email.required' => '邮箱不能为空',
                'email.email' => '邮箱格式不正确',
                'detail.between' => '长度要求0-100个字符'
            ]);
            //业务逻辑处理
            $data['username'] = trim(request('username'));
            $data['password'] = md5(trim(request('password')));
            $data['add_time'] = time();
            $data['sex'] = trim(request('sex'));
            $data['moble'] = trim(request('moble'));
            $data['email'] = trim(request('email'));
            $data['grade'] = trim(request('grade'));
            $data['detail'] = trim(request('detail'));

            if (Admin::insert($data)){
                //返回表单页，with中的数据会闪存在session
                return back()->with(['status' => 'ok', 'msg' => '添加成功', 'url' => route('bg.admin.list')]);
            } else{
                return back() -> with( ['status'=>'error','msg'=>'添加失败']);
            }
        }else{
            return view('admin.admin.admin_list');
        }
    }
    //激活管理员
    public function actives($id,$active){
//        echo $id.'<br>';
//        echo $active;
        $a = $active == 1 ? 2 : 1;
        $text = $active == 1 ? '禁用' : '激活';
        //更新状态
        if(Admin::where('id',$id) -> update( ['active'=>$a] )){
            return response() -> json( ['status'=>'ok','msg'=>$text.'成功','href'=>route('bg.admin.active',['id'=>$id,'active'=>$a]),'text'=>$text]);
        }else{
            return response() -> json( ['status'=>'error','msg'=>$text.'失败']);
        }
    }
    //id删除管理员
    public function delete($id){
        if (Admin::destroy($id)){
            return response()->json(['status'=>'ok','msg'=>'删除成功','url'=>route('bg.admin.list')]);
        }else{
            return response()-> json(['status'=>'error','msg'=>'删除失败']);
        }
    }
    //批量删除管理员
    public function deletes(){
        if(Admin::destroy( request('chk') ) ){
            return response() -> json( ['status'=>'ok','msg'=>'删除成功','url'=>route('bg.admin.list')]);
        }else{
            return response() -> json( ['status'=>'error','msg'=>'删除失败']);
        }
    }


    //个人信息
    public function ad_info($id=1){
        if ($id==session('aid')){
           $uid=session('aid');
        }else{
           $uid=$id;
        }
        if ($uid>0){
            //echo '<pre>';
            $admin=Admin::find($uid);
            $admin_logs=Admin_logs::orderBy("login_time",'desc')
                ->where('aid',$uid)
                ->paginate(3);;
            //print_r($admin);
        }else{
            return back() -> with( ['status'=>'error','msg'=>'∑(っ°Д°;)っ卧槽，不见了']);
        }
        return view('admin.admin.admin_info',compact('admin','admin_logs'));
    }
    //修改密码
    public function ad_up_pwd($id){
        if (request()->ajax()){
            $this -> validate(request(),[
                'password' => 'bail|required|between:4,21',
                'repwd' => 'bail|required|same:password',//确认密码
            ],[
                'password.required' => '密码不能为空',
                'password.between' => '密码长度要求5-20个字符',
                'repwd.required' => '确认密码不能为空',
                'repwd.same' => '两次密码输一致',
            ]);
            $data['password'] = md5(trim(request('password')));
            $admin=Admin::find($id);
            if ( $admin['password']==md5(trim(request('oldpwd'))) ){
                if(Admin::where('id',$id)->update(['password'=>md5(trim(request('password')))])){
                    return response() -> json( ['status'=>'ok','msg'=>'修改成功','url'=>'bg.admin.info']);
                }else{
                    return response() -> json( ['status'=>'error','msg'=>'修改失败']);
                }
            }else{
                return response() -> json( ['status'=>'error','msg'=>'原密码错误']);
            }
        }
    }
    //修改用户信息
    public function ad_update($id){
        if (request()->post()){
            //dd(request()->post());
            $data['username'] = trim(request('username'));
            $data['sex'] = trim(request('sex'));
            $data['moble'] = trim(request('moble'));
            $data['email'] = trim(request('email'));
            if(Admin::updateOrInsert(
                ['id' => $id],
                ['username'=>$data['username'],'sex'=>$data['sex'],'moble'=>$data['moble'],'email'=>$data['email']]
            )){
                return response()->json(['status'=>'ok','msg'=>'信息修改成功','url'=>'bg.admin.info']);
            }else{
                return response()->json(['status'=>'error','msg'=>'信息修改失败']);
            }

        }
    }

    //权限管理
    public function ad_Power(){
        return view('admin.admin.admin_Power');
    }
    public function ad_Power_add(){
        return view('admin.admin.Competence');
    }
    public function ad_Role(){
        if (request()->post()){
            $data['role_name']=trim(request('role_name'));
            $data['detail']=trim(request('detail'));
            if (AdminRoles::insert($data)){
                return response()->json(['status'=>'ok','msg'=>'角色提交成功']);
            }else{
                return response()->json(['status'=>'error','msg'=>'角色提交失败']);
            }
        }else{
            return view('admin.admin.admin_role');
        }
    }
}

