<?php
//陈平超的路由后台路由

Route::namespace("Admin") -> group(function(){
   Route::prefix("bg") -> group(function(){
       //后台登录限制
       Route::middleware('BgLogin') -> group(function() //--中间件 aid存在 session
       {
            //交易中心控制器
           Route::prefix("orders") -> group(function(){

               Route::get("index","OrdersController@index") -> name("bg.orders.index");//交易信息

               Route::any("order","OrdersController@order") -> name("bg.orders.order"); //订单管理
               Route::get("shipments/{id}","OrdersController@shipments") -> name("bg.orders.shipments"); //订单快递
               Route::get("delete/{id}","OrdersController@delete") -> name("bg.orders.delete"); //订单删除
               Route::get("detail/{id}","OrdersController@detail") -> name("bg.orders.detail"); //订单详情

               Route::get("price/{time?}","OrdersController@price") -> name("bg.orders.price"); //交易金额

               Route::any("returns/{active?}","OrdersController@returns") -> name("bg.orders.returns"); //退货订单查询
               Route::get("return_operation/{id}","OrdersController@return_operation") -> name("bg.orders.return_operation"); //确认退货
               Route::get("return_detail/{id}","OrdersController@return_detail") -> name("bg.orders.return_detail"); //退货详情
               Route::post("return_deletes","OrdersController@return_deletes") -> name("bg.orders.return_deletes"); //退货批量删除
           });
       });

   });
});