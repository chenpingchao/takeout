<?php
//商家后台

Route::namespace('merchant') -> group(function(){
    Route::prefix('merchant') -> group(function(){


        Route::any('login','loginController@login') -> name('merchant.login'); //登录
        Route::any('logout','loginController@logout') -> name('merchant.logout'); //登出
        Route::get('geetest/{id?}','loginController@geetest') -> name('merchant.geetest'); //行为验证码的生成


        Route::any('register','loginController@register') -> name('merchant.register'); //注册
        Route::any('mobile','loginController@mobile') -> name('merchant.mobile'); //生成短信验证码
        Route::any('remoteShopMemberName','loginController@remoteShopMemberName') -> name('merchant.remoteShopMemberName'); //用户名远程验证
        Route::any('remoteMobile','loginController@remoteMobile') -> name('merchant.remoteMobile'); //手机号远程验证
        Route::any('remoteMobileCode','loginController@remoteMobileCode') -> name('merchant.remoteMobileCode'); //短信验证码远程验证


        Route::any('misspwd','loginController@misspwd') -> name('merchant.misspwd');  //忘记密码
        //商家后台主页(登录限制)
        Route::middleware('Merchant') -> group(function(){
            Route::get('index','indexController@index') -> name('merchant.index');//商家店铺页面

            //店铺处理
            Route::prefix('shop') -> group(function() {
                Route::any('add', 'shopController@add')->name('merchant.shop.add');//创建店铺
                Route::any('Id_number', 'shopController@Id_number')->name('merchant.shop.Id_number');//身份证号远程验证
                Route::post('shopMobile', 'shopController@shopMobile')->name('merchant.shop.shopMobile');//远程手机号验证1
                Route::post('auditMobile', 'shopController@auditMobile')->name('merchant.shop.auditMobile');//远程手机号验证2

                Route::get('detail/{sid}', 'shopController@detail')->name('merchant.shop.detail');//店铺详情
                Route::post('shopchange', 'shopController@shopchange')->name('merchant.shop.shopchange');//店铺信息修改
                Route::post('detailchange', 'shopController@detailchange')->name('merchant.shop.detailchange');//店铺信息详情
                Route::post('auditchange', 'shopController@auditchange')->name('merchant.shop.auditchange');//店铺负责人修改
                Route::get('menuActive/{uid}/{active}', 'shopController@menuActive')->name('merchant.shop.menuActive');//菜品上下架
                Route::get('shopActive/{sid}/{active}', 'shopController@shopActive')->name('merchant.shop.shopActive');//菜品上下架

                Route::any('menuAdd/{sid}', 'shopController@menuAdd')->name('merchant.shop.menuAdd');//店铺菜品添加
                Route::any('nextList', 'shopController@nextList')->name('merchant.shop.nextList');//三级联动

                Route::get('menuDetail/{uid}', 'shopController@menuDetail')->name('merchant.shop.menuDetail');//店铺菜品详情
                Route::any('menuChange/{uid}', 'shopController@menuChange')->name('merchant.shop.menuChange');//更改菜品信息
                Route::any('guestBook/{gid}','shopController@guestBook') -> name('merchant.orders.guestBook');//用户留言

                Route::any('addMenuCate/{s_id}','shopController@addMenuCate') -> name('merchant.shop.addMenuCate');//添加菜品分类
                Route::any('menuCate/{mc_id}','shopController@menuCate') -> name('merchant.shop.menuCate');//显示及更改菜品分类
                Route::any('deleteMenuCate/{mc_id}','shopController@deleteMenuCate') -> name('merchant.shop.deleteMenuCate');//显示及更改菜品分类
                Route::any('menuCateActive/{mc_id}/{active}','shopController@menuCateActive') -> name('merchant.shop.menuCateActive');//显示及更改菜品分类

                Route::any('addTuan/{sid}','shopController@addTuan') -> name('merchant.shop.addTuan');//添加团购
                Route::any('tuan/{tg_id}','shopController@tuan') -> name('merchant.shop.tuan');//显示及更改团购
                Route::any('tuanDelete/{tg_id}','shopController@tuanDelete') -> name('merchant.shop.tuanDelete');//删除团购
                Route::any('tuanActive/{tg_id}/{active}','shopController@tuanAction') -> name('merchant.shop.tuanActive');//激活团购

            });

            //订单处理
            Route::prefix('orders') -> group(function(){
                Route::get('index/{sid}/{active?}','ordersController@index') -> name('merchant.orders.index');//商家订单页面
                Route::get('shipments/{oid}','ordersController@shipments') -> name('merchant.orders.shipments');//发货
                Route::get('returns/{oid}','ordersController@returns') -> name('merchant.orders.returns');//发货
                Route::get('detail/{oid}','ordersController@detail') -> name('merchant.orders.detail');//商家订单详情
                Route::any('reply/{oid?}/{sid?}','ordersController@reply') -> name('merchant.orders.reply');//商家订单回复
            });
        });

    });
});