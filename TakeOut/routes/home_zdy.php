<?php
//张东阳 前台路由
//命名空间分组
Route::namespace("Home") -> group(function(){
    //前台主页
    Route::get('/',"indexController@index") -> name('/');

    //前台页面
    Route::prefix("home") ->group(function(){
        //菜谱详情详情
        Route::prefix("menuDetail") -> group(function (){
            //展示菜品评论详情
            Route::get('show/{id}','indexController@show') -> name('home.menuDetail.showMsg');
        });

        //积分兑换
        Route::prefix("score") -> group(function (){
           //积分优惠兑换
            Route::any('convert','ScoreController@convert') -> name('home.score.convert');
        });
    });
});