<?php

namespace App\Http\Middleware;

use Closure;

class MemLogin
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
        //登录验证
        if (!session()->has('mid')){
            //重定向至登录页面
            return redirect() -> route('home.login');
        }
        return $next($request);
    }
}
