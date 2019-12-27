<?php

namespace App\Http\Middleware;

use App\Cart;
use Closure;

class Cart_s
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
//        $cart_ss=Cart::where('mid',Session::get('mid'))
//            ->sum('buynum');
//        view()->share(['cart_ss'=>$cart_ss]);
        return $next($request);
    }
}
