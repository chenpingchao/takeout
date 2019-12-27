<?php

namespace App\Providers;

use App\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //数据库访问监听
   /*     DB::listen(function($query){
            //返回sql
            echo $query ->sql.'<br>';
            //返回参数
            echo '<pre>';
            print_r($query->bindings);
            echo '</pre>';
         });*/

//        $cart_s=Cart::where('mid',Session::get('mid'))
//            ->sum('buynum');
//
//        //模板公共变量赋值 --分享
//        view()->share(['cart_s'=>$cart_s]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
