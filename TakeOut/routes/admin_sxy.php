<?php
//孙旭阳的路由后台路由
Route::namespace("Admin") -> group(function(){
   Route::prefix("bg") -> group(function(){
       //后台登录限制
       Route::middleware('BgLogin') -> group(function() //--中间件 aid存在 session
       {
           //广告管理
           Route::any('advertis/index','AdvertisController@index') -> name('bg.advertis.index');//广告位列表
           Route::any('advertis/add','AdvertisController@add') ->name ('bg.advertis.add');//广告位添加
           Route::any('advertis/details/{id}','AdvertisController@details') ->name ('bg.advertis.details');//广告位详情
           Route::any('advertis/edit/{id}','AdvertisController@edit') ->name ('bg.advertis.edit');//广告位编辑
           Route::get('advertis/active/{id}/{active}','AdvertisController@active') ->name ('bg.advertis.active');//广告位状态
           Route::get('advertis/active1/{id}/{active}','AdvertisController@active1') ->name ('bg.advertis.active1');//广告状态
           Route::get('advertis/delete/{id}','AdvertisController@delete') ->name ('bg.advertis.delete');//广告位删除
           Route::get('advertis/delete1/{id}','AdvertisController@delete1') ->name ('bg.advertis.delete1');//广告删除
           Route::any('advertis/deletes','AdvertisController@deletes') ->name ('bg.advertis.deletes');//批量删除
           Route::any('advertis/addad/{id}','AdvertisController@addad') ->name ('bg.advertis.addad');//广告添加
           Route::any('advertis/editad/{id}','AdvertisController@editad') ->name ('bg.advertis.editad');//广告编辑
           //店铺管理
           Route::get('shop/list','ShopController@lists') ->name ('bg.shop.list');//店铺列表
           Route::any('shop/delete/{id}','ShopController@delete') ->name ('bg.shop.delete');//店铺删除.拒绝
           Route::post('shop/deletes','ShopController@deletes') ->name ('bg.shop.deletes');//批量删除
           Route::any('shop/stop/{id}/{active}','ShopController@stop') ->name ('bg.shop.stop');//店铺禁止
           Route::any('shop/member/active2/{id}/{active}','ShopController@active2') ->name ('bg.shop.member.active2');//店铺持有人状态状态
           Route::any('shop/active1/{id}/{active}','ShopController@active1') ->name ('bg.shop.active1');//店铺状态状态
           Route::any('shop/audit','ShopController@audit') ->name ('bg.shop.audit');//店铺申请
           Route::any('shop/detail/{id}','ShopController@detail') ->name ('bg.shop.detail');//店铺详情
           Route::get('shop/sactive/{id}/{active}','ShopController@active') ->name ('bg.shop.active');//店铺审核
           Route::get('shop/member','ShopController@member') ->name ('bg.shop.member');//店铺持有人
           Route::post('shop/turn_down/{sid}','ShopController@turn_down') ->name ('bg.shop.turn_down');//拒绝店铺审核
           //文章管理
           Route::prefix("article") ->group (function(){
               Route::get('list','ArticleController@lists') ->name ('bg.article.list');//文章列表
               Route::any('add','ArticleController@add') ->name ('bg.article.add');//添加文章
               Route::any('update','ArticleController@update') ->name ('bg.article.update');//文章编辑
               Route::any('detail','ArticleController@detail') ->name ('bg.article.detail');//文章详情
               Route::get('delete/{id}','ArticleController@delete') ->name ('bg.article.delete');//文章删除
               Route::get('delete1/{id}','ArticleController@delete1') ->name ('bg.article.delete1');//分类删除
               Route::post('deletes','ArticleController@deletes') ->name ('bg.article.deletes');//批量删除
               Route::post('deletes1','ArticleController@deletes1') ->name ('bg.article.deletes1');//分类批量删除
               Route::any('sort','ArticleController@sort') ->name ('bg.article.sort');//文章分类
           });
       });
   });
});
