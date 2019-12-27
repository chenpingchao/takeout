<?php
//陈平超 前台路由
//命名空间分组
Route::namespace("Home") -> group(function(){
    //前台主页
    Route::get('/',"indexController@index") -> name('/');

    //前台页面
    Route::prefix("home") ->group(function(){
        Route::any( 'menuDetail/{uid}','indexController@menuDetail' ) -> name('home.menuDetail');//显示商品详情页
        Route::get( 'shopDetail/{sid}','indexController@shopDetail' ) -> name('home.shopDetail');//显示店铺详情页

        Route::any( 'MenuComment/{uid}','indexController@MenuComment' ) -> name('home.MenuComment');//商品留言
        Route::any( 'guestbook/{sid}','indexController@guestbook' ) -> name('home.guestbook');//店铺留言

        Route::get( 'cart','cartController@index' ) -> name('home.cart');//显示购物车详情页面
        Route::post( 'joinCart/{uid}','cartController@joinCart' ) -> name('home.joinCart');//加入购物车
        Route::get( 'menuCartAdd/{uid}','cartController@menuCartAdd' ) -> name('home.menuCartAdd');//购物车商品数量加
        Route::get( 'menuCartMin/{uid}','cartController@menuCartMin' ) -> name('home.menuCartMin');//购物车商品数量减
        Route::get( 'menuCartAssign/{uid}/{num?}','cartController@menuCartAssign' ) -> name('home.menuCartAssign');//购物车商品指定数量
        Route::get( 'menuCartActive/{uid}/{active}','cartController@menuCartActive' ) -> name('home.menuCartActive');//购物车商品状态（单点）
        Route::get( 'menuCartAll/{active?}','cartController@menuCartAll' ) -> name('home.menuCartAll');//购物车商品状态（全选或者取消）
        Route::any( 'menuCartAdverse','cartController@menuCartAdverse' ) -> name('home.menuCartAdverse');//购物车商品状态（反选）
        Route::get( 'deleteCart/{uid}','cartController@deleteCart' ) -> name('home.deleteCart');//删除购物车商品


        //订单登陆限制
        Route::middleware('MemLogin') -> group(function(){
            Route::any( 'shop_Collection/{sid}','indexController@shop_Collection' ) -> name('home.shop_Collection');

            Route::any('ordersPage' ,'OrdersController@ordersPage') -> name('home.orderPage');//订单生成
            Route::any('ordersCreate' ,'OrdersController@ordersCreate') -> name('home.orderCreate');//订单生成

        });

    });
});