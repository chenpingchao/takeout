<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

//RBAC中间件
class RbacMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //获取当前管理员对象
        $admin = Admin::find(session('aid'));
        //view()->share(['login_admin'=>$admin]);
        $routeName = Route::currentRouteName(); //获取路由别名


        //判断用户是否有路由对应的权限
        if(!$admin->can($routeName) ){

            if($request->ajax()){
                return response()->json(['status'=>'error','msg'=>'没有访问权限']);
            }else{
                abort(403, '你没有权限');
            }

        }
        return $next($request);
    }

}
