<?php
//刘伟前台路由
//命名空间分组
Route::namespace("Home") -> group(function(){
    //前台主页
    Route::get('/',"indexController@index") -> name('/');
    //前台页面搜索
    Route::any('hunt_list',"indexController@hunt_list")->name('hunt_list');
    Route::any('H_list_shop/{shop_name}',"indexController@H_list_shop")->name('H_list_shop');//店铺搜索展示页面
    Route::any('H_list_menu/{menu_name}',"indexController@H_list_menu")->name('H_list_menu');//商品搜索展示页面
    //前台页面
    Route::prefix("home") ->group(function(){
        //注册
        Route::any('register','loginController@register')->name('home.register');
        //登录
        Route::any('login','loginController@login')->name('home.login');
        Route::any('loginT','loginController@loginT')->name('home.loginT');//弹窗登录
        //QQ登录
        //邮箱找回密码
        Route::any('findPassword','loginController@findPassword')->name('home.findPassword');

        //退出
        Route::any('logout','loginController@logout')->name('home.logout');
        //用户名验证
        Route::any('ChkUser','loginController@ChkUser')->name('home.ChkUser');

        //短信验证码发送
        Route::any('sendMsg','loginController@sendMsg')->name('home.sendMsg');
        //检验短信验证码
        Route::any('chkMsg','loginController@chkMsg')->name('home.chkMsg');

        //邮箱验证码发送
        Route::any('sendMail','loginController@sendMail')->name('home.sendMail');
        //检验邮箱验证码
        Route::any('chkMail','loginCOntroller@chkMail')->name('home.chkMail');

        //生成极验验证码
        Route::any('geetest','loginController@geetest')->name('home.geetest');
        //检验极验验证码
        Route::any('checkGt','loginController@checkGt')->name('home.checkGt');

        //发现---闪购
        Route::any('flash','F_SalesController@flash')->name('flash.sales');

        //中间件mid不存在则跳转登录页面
        Route::middleware('MemLogin')->group(function()
        {
            //用户中心
            Route::prefix('member')->group(function ()
            {
                //用户中心
                Route::any('UserCenter', 'UserController@UserCenter')->name('hm.mem.UserCenter');
                //我的订单
                Route::any('UserOrder', 'UserController@UserOrder')->name('hm.mem.UserOrder');
                //我的订单状态操作
                Route::any('UserOrder_Act/{id}/{act}', 'UserController@UserOrder_Act')->name('hm.mem.UserOrder_Act');
                //根据订单id查询更改留言内容
                Route::any('UserOrder_Det/{id?}','UserController@UserOrder_Det')->name('hm.mem.UserOrder_Det');
                //订单评论------添加
                Route::any('UserOrder_Add/{id?}','UserController@UserOrder_Add')->name('hm.mem.UserOrder_Add');
                //订单评论------更改
                Route::any('UserOrder_Upd','UserController@UserOrder_Upd')->name('hm.mem.UserOrder_Upd');
                //我的收藏
                Route::any('UserFavorites', 'UserController@UserFavorites')->name('hm.mem.UserFavorites');
                //收货地址
                Route::any('UserAddress', 'UserController@UserAddress')->name('hm.mem.UserAddress');
                //设置默认收货地址
                Route::any('UserAddress_default/{id}/{active}','UserController@UserAddress_default')->name('hm.mem.UserAddress_default');
                //添加收货地址
                Route::post('UserAddress_add','UserController@UserAddress_add')->name('hm.mem.UserAddress_add');
                //更新收货地址
                Route::post('UserAddress_update','UserController@UserAddress_update')->name('hm.mem.UserAddress_update');
                //删除收货地址
                Route::any('UserAddress_del/{id}','UserController@UserAddress_del')->name('hm.mem.UserAddress_del');
                //批量删除收货地址
                Route::any('UserAddress_delS','UserController@UserAddress_delS')->name('hm.mem.UserAddress_delS');
                //我的留言
                Route::any('UserMessage', 'UserController@UserMessage')->name('hm.mem.UserMessage');
                //删除留言
                Route::any('UserMessage_del/{id}', 'UserController@UserMessage_del')->name('hm.mem.UserMessage_del');
                //删除菜品评论
                Route::any('UserMessage_delMC/{id}','UserController@UserMessage_delMC')->name('hm.mem.UserMessage_delMC');
                //我的优惠券
                Route::any('UserCoupon', 'UserController@UserCoupon')->name('hm.mem.UserCoupon');
                //账户管理
                Route::any('UserAccount', 'UserController@UserAccount')->name('hm.mem.UserAccount');
                //账户管理--修改邮箱
                Route::any('UserAccount_email','UserController@UserAccount_email')->name('hm.mem.UserAccount_email');
                //账户管理--修改手机号
                Route::any('UserAccount_mobile','UserController@UserAccount_mobile')->name('hm.mem.UserAccount_mobile');
                //账户管理--修改密码
                Route::any('UserAccount_pass','UserController@UserAccount_pass')->name('hm.mem.UserAccount_pass');
            });
        });
    });
});