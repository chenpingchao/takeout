<?php

namespace App\Http\Middleware;

use Closure;

class MerchantLogin
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
        //商家后台登录验证
        if (!session()->has('smid')){
            //重定向至登录页面
            return redirect() -> route('merchant.login');
        }
        return $next($request);
    }
}
