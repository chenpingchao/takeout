<?php
//刘伟的路由后台路由

Route::namespace("Admin") -> group(function(){
   Route::prefix("bg") -> group(function(){
     //登录功能
       Route::any("/","loginController@login") -> name("bg");    //登录页面
       Route::get("captcha","loginController@captcha") -> name("bg.captcha"); //验证码

       //后台登录限制
       Route::middleware('BgLogin') -> group(/**
        *
        */ function() //--中间件 aid存在 session
       {
           Route::any("Logout", "loginController@Logout")->name("bg.Logout");//退出 Logout
           //后台首页
           Route::any("index", "indexController@index")->name("bg.index");  //后台首页
           Route::any("main", "indexController@main")->name("bg.main");  //后台主页
           Route::get('left', 'indexController@left')->name("bg.left");//后台左部
           Route::get('footer', 'indexController@footer')->name("bg.footer");//后台尾部

//           Route::group(['middleware' => 'rbac'], function () {

           Route::prefix("admin") -> group(function(){ //管理员
               Route::any('ad_list' , 'AdminController@ad_list') -> name('bg.admin.list');//管理员列表
               Route::any('ad_add' , 'AdminController@ad_add') -> name('bg.admin.add');//管理员列表添加

               Route::get('delete/{id}','AdminController@delete') -> name('bg.admin.delete');//管理员列表id删除
               Route::post('deletes','AdminController@deletes') -> name('bg.admin.deletes');//全部删除
               Route::any('actives/{id}/{active}','AdminController@actives') -> name('bg.admin.active');//激活禁用

               Route::any('ad_info/{id?}', 'AdminController@ad_info') -> name('bg.admin.info');//个人信息
               Route::any('ad_update/{id}' , 'AdminController@ad_update')-> name('bg.admin.update');//个人信息修改
               Route::any('ad_up_pwd/{id}' , 'AdminController@ad_up_pwd')-> name('bg.admin.up_pwd');//密码修改

               Route::any('ad_Power' , 'AdminController@ad_Power') -> name('bg.admin.Power');//权限管理
               Route::any('ad_Role','AdminController@ad_Role') ->name('bg.admin.ad_Role');//管理员角色添加
               Route::any('ad_Role_del/{roleId}','AdminController@ad_Role_del') ->name('bg.admin.ad_Role_del');//管理员角色添加
               Route::any('ad_Role_allot/{roleId}','AdminController@ad_Role_allot') ->name('bg.admin.ad_Role_allot');//管理员角色分配
               Route::any('ad_Power_add' , 'AdminController@ad_Power_add') -> name('bg.admin.Power_add');//用户-角色-权限列表 多对多关系
               Route::any('ad_Permission_allot/{roleId}','AdminController@ad_Permission_allot')->name('bg.admin.ad_Permission_allot');//角色权利分配
               Route::any('ad_Permission_add/{id}','AdminController@ad_Permission_add')-> name('bg.admin.ad_Permission_add');//顶级或次级权限添加
               Route::any('ad_Permission_son/{pid}','AdminController@ad_Permission_son')->name('bg.admin.ad_Permission_son');//查找子权限
               Route::any('ad_Permission_del/{id}','AdminController@ad_Permission_del')->name('bg.admin.ad_Permission_del');//根据id查询path删除权限
               Route::any('ad_Permission_edit/{id}','AdminController@ad_Permission_edit')->name('bg.admin.ad_Permission_edit');//编辑权限名称 权限路由
           });

           Route::prefix('Message') -> group(function (){ //留言列表
               Route::get('ad_GDelete/{id}','MessageController@ad_GDelete')->name('bg.mess.GDelete');//留言删除根据id
               Route::post('ad_GDeletes','MessageController@ad_GDeletes')->name('bg.mess.GDeletes');//留言批量删除

               Route::any('ad_Guestbook','MessageController@ad_Guestbook')->name('bg.mess.Guestbook'); //留言板
               Route::any('ad_MemberShow/{id}','MessageController@ad_MemberShow')->name('bg.mess.MemberShow');//用户查看
               Route::any('ad_GuestActive/{id}/{active}','MessageController@ad_GuestActive')->name('bg.mess.GuestActive');//留言状态
               Route::post('ad_GuestReply','MessageController@ad_GuestReply')->name('bg.mess.GuestReply');//单个留言回复

               Route::any('ad_FDelete/{id}','MessageController@ad_FDelete')->name('bg.mess.FDelete');//意见删除 id
               Route::any('ad_FDeletes','MessageController@ad_FDeletes')->name('bg.mess.FDeletes');//意见删除 id

               Route::any('ad_Feedback','MessageController@ad_Feedback')->name('bg.mess.Feedback'); //意见反馈
               Route::any('ad_FeedActive/{id}/{active}','MessageController@ad_FeedActive')->name('bg.mess.FeedActive');//意见状态
           });
           Route::prefix('Flash')->group(function (){//销售
               Route::any('ad_FlashBuy','SalesController@ad_FlashBuy')->name('bg.flash.FlashBuy');//闪购
           });
//           });
       });
   });
});