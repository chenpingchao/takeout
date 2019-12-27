<?php
//孙旭阳 前台路由
//命名空间分组
Route::namespace("Home") -> group(function(){
    //前台主页
    Route::get('/',"indexController@index") -> name('/');
    //前台页面
    Route::prefix("home") ->group(function(){
        Route::prefix("article") ->group (function(){
        });
    });
});