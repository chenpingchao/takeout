<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Role;
use App\RoleUser;
use App\PermissionRole;
use App\Admin_logs;
use App\Permission;

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

    //权限管理---角色列表
    public function ad_Power(){
        //接收请求数据
        $display_name=trim(request('display_name'));
        //保持数据
        request()->flash();
        //查询数据
        $roles=Role::where(function($query) use($display_name){
            if($display_name){
                $query->where('display_name','like',"%{$display_name}%");
            }
        })
            ->paginate(10);
        foreach ($roles as $k=>$v){
            //查询成员
            $admins= RoleUser::from('role_user as r')
                ->leftjoin('admin as a','r.user_id','=','a.id')
                ->where('role_id',$v['id'])
                ->select('username')
                ->get();
            $roles[$k]->members = $admins;//角色成员
            //查询权限
            $permissions= PermissionRole::from('permission_role as r')
                ->leftjoin('permissions as p','r.permission_id','=','p.id')
                ->where('role_id',$v['id'])
                ->select('display_name')
                ->get();
            $roles[$k]->permissions = $permissions;//角色权限
        }
        return view('admin.admin.admin_Power',compact('roles'));
    }
    //添加权限
    public function ad_Power_add(){
        //搜索条件
        $display_name=trim(\request('display_name'));
        //保持数据
        \request()->flush();
        //查询数据  根据pid查询id-----顶级分类
        $permissions=Permission::from('permissions as p1')
            ->leftjoin('permissions as p2','p1.pid','=','p2.id')
            ->select('p1.*','p2.display_name as parent_name')
            ->where(function($query) use($display_name){
                if ($display_name){
                    $query->where('p1.display_name','like',"{$display_name}");
                }else{
                    $query->where('p1.pid',0);
                }
            })
            ->orderBy('p1.path','asc')
            ->paginate(10);
        if ($permissions){//根据id查询pid-----统计子级分类(总数)
            foreach($permissions as $k=>$v){//根据下标
                $permissions[$k]->child_num=Permission::where('pid',$v->id)->count();
            }
        }
        return view('admin.admin.Competence',compact('permissions'));
    }
    //权限分配 角色id---权利id
    public function ad_Permission_allot($roleId){
        if (\request()->isMethod('post')){
            //删除旧权限
            PermissionRole::where('role_id',$roleId)->delete();;
            //分配新权限
            if(request('chk') ){
                foreach(request('chk') as $permission_id){
                    PermissionRole::insert(['role_id'=>$roleId,'permission_id'=>$permission_id]);
                };
            }
            return response()->json(['status'=>'ok','msg'=>'权限分配成功']);
        }else{
            //查询数据
            $permissions=Permission::from('permissions as p1')
                ->leftjoin('permissions as p2','p1.pid','=','p2.id')
                ->select('p1.*', 'p2.display_name as parent_name')
                ->where('p1.pid',0)//顶级权限为 父名
                ->orderBy('p1.path', 'asc')
                ->get(0);//获取集合的第一个元素
            if ($permissions) {
                foreach ($permissions as $k => $v) {
                    //查询子权限
                    $child = Permission::where('pid', $v->id)->get();
                    foreach($child as $k1=>$v1){
                        //判断是否是已分配权限
                        if(PermissionRole::where('role_id',$roleId)->where('permission_id',$v1->id)->first()){
                            $child [$k1]->is_permission='checked';
                        }
                    }
                    //子权限--添加
                    $permissions[$k]->child = $child;
                    //判断是否是已分配权限
                    if(PermissionRole::where('role_id',$roleId)->where('permission_id',$v->id)->first()){
                        $permissions[$k]->is_permission='checked';
                    }
                }
            }
            //print_r($permissions[0]);
            return view('admin.admin.admin_permission_allot',compact('permissions','roleId'));
        }
    }
    //角色删除
    public function ad_Role_del($roleId){
        //删除角色权限关系
        PermissionRole::where('role_id',$roleId)->delete();
        //删除角色用户关系
        RoleUser::where('role_id',$roleId)->delete();
        //删除角色
        $Roles=Role::where('id',$roleId)->delete();
        if (!empty($Roles)){
            return response()->json(['status'=>'ok','msg'=>'删除成功']);
        }
    }
    //角色添加
    public function ad_Role(){
        if (request()->post()){
            $data['role_name']=trim(request('role_name'));
            $data['detail']=trim(request('detail'));
            if (Role::insert($data)){
                return response()->json(['status'=>'ok','msg'=>'角色提交成功']);
            }else{
                return response()->json(['status'=>'error','msg'=>'角色提交失败']);
            }
        }else{
            return view('admin.admin.admin_role');
        }
    }
    //角色分配
    public function ad_Role_allot($roleId){
        if (request()->isMethod('post')){
            //删除旧成员
            RoleUser::where('role_id',$roleId)->delete();
            //分配新成员
            if(\request('chk')){
                foreach (\request('chk') as $admin_id){
                    RoleUser::insert(['role_id'=>$roleId,'user_id'=>$admin_id]);
                }
            }
            return response()->json(['status'=>'ok','msg'=>'成员分配成功']);
        }else{
            //获取所有管理员
            $admins=Admin::get();
            //判断是否是已分配成员
            foreach ($admins as $k=>$v){
                if(RoleUser::where('role_id',$roleId)->where('user_id',$v->id)->first()){
                    $admins[$k]['is_member']='checked';
                }
            }
            //dd($admins);
            return view('admin.admin.admin_role_allot',compact('admins','roleId'));
        }

    }
    //添加顶级或次级权限
    public function ad_Permission_add($id=0){
        if (\request()->isMethod('post')){
            //闪存数据
            \request()->flash();
            //表单验证
            $this->validate(request(),[
                'display_name'=>'bail|required|unique:permissions',
                'name'=>'bail|required|unique:permissions'
            ],[
                'display_name.required'=>'权限名不能为空',
                'name.required'=>'路由名不能为空',
                'display_name.unique'=>'权限名已被占用',
                'name.unique'=>'路由名已被占用'
            ]);
            //逻辑处理
            $data['pid']=trim(\request('pid'));
            $data['display_name']=trim(\request('display_name'));
            $data['name']=trim(\request('name'));
            //更新path
            //如果添加的权限为顶级权限path的值为bid
            //如果添加的权限不是顶级权限path的值为上级权限的path拼上,再拼上自己的id
            if ($bid=Permission::insertGetId($data)){//自动id
                if ($id==0){
                    Permission::where('id',$bid)->update(['path'=>$bid]);
                }else{
                    //获取上级权限的path
                    $parentPath=Permission::where('id',$id)->pluck('path'); //返回一维索引数组
                    $path=$parentPath[0].','.$bid;
                    Permission::where('id',$bid)->update(['path'=>$path]);
                }
                return back()->with('status','ok');
            }else{
                return back()->with('status','error');
            }

        }else{
            $permission=Permission::find($id);
            return view('admin.admin.admin_permission_add',compact('permission'));
        }
    }
    //根据pid查找子权限->pid=id
    public function ad_Permission_son($pid){
        $permissions=Permission::from('permissions as p1')
            ->leftjoin('permissions as p2','p1.pid','=','p2.id')
            ->select('p1.*','p2.display_name as parent_name')
            ->where('p1.pid',$pid)
            ->orderBy('p1.path','asc')
            ->get();
        if ($permissions){//根据id查询pid-----统计子级分类(总数)
            foreach($permissions as $k=>$v){//根据下标
                $permissions[$k]->child_num=Permission::where('pid',$v->id)->count();
            }
        }
        return view('admin.admin.subCompetence',compact('permissions'));
    }
    //根据id查找path 进行删除 (删除权利id--权利关系表)待定
    public function ad_Permission_del($id){
        if (Permission::where('id',$id)->orwhere('pid',$id)->delete()){
            return response()->json(['status'=>'ok','msg'=>'删除成功','url'=>route('bg.admin.Power_add')]);
        }else{
            return response()-> json(['status'=>'error','msg'=>'删除失败']);
        }
    }
    //根据id 进行编辑
    public function ad_Permission_edit($id){
        if (\request()->isMethod('post')){
            //闪存数据
            \request()->flash();
            //表单验证
            $this->validate(request(),[
                'display_name'=>'bail|required',
                'name'=>'bail|required'
            ],[
                'display_name.required'=>'权限名不能为空',
                'name.required'=>'路由名不能为空',
                'display_name.unique'=>'权限名已被占用',
                'name.unique'=>'路由名已被占用'
            ]);
            //$data['id']=trim(\request('id'));
            $data['display_name']=trim(\request('display_name'));
            $data['name']=trim(\request('name'));
            if (Permission::where('id',$id)->update($data)){
                return back()->with('status','ok');
            }else{
                return back()->with('status','error');
            }
        }else{
            $permission=Permission::find($id);
            return view('admin.admin.admin_permission_edit',compact('permission'));
        }
    }
}

