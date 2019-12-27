<?php
//张东阳的路由后台路由

Route::namespace("Admin") -> group(function(){
   Route::prefix("bg") -> group(function(){
       //后台登录限制
       Route::middleware('BgLogin') -> group(function() //--中间件 aid存在 session
       {
           //会员管理路由
           Route::prefix('member') -> group(function (){
               //列表
               Route::get('list','MemberController@list') -> name('admin.member.list');
               //展示会员信息
               Route::get('show/{id}','MemberController@show') -> name('admin.member.show');
               //激活/禁用会员
               Route::get('active/{id}/{active}','MemberController@active') -> name('admin.member.active');
               //会员等级管理
               Route::get('grade','MemberController@grade') -> name('admin.member.grade');
               //添加会员等级
               Route::any('add','MemberController@add') -> name('admin.member.add');
               //修改会员等级规则
               Route::any('edit/{id}','MemberController@edit') -> name('admin.member.edit');
               //删除会员等级
               Route::get('delete/{id}','MemberController@delete') -> name('admin.member.delete');
               //会员等级管理
               Route::get('memberGrade','MemberController@memberGrade') -> name('admin.member.memberGrade');
               //会员等级图表
               Route::get('getChart','MemberController@getChart') -> name('admin.member.getChart');
               Route::get('excel','MemberController@excel') -> name('admin.member.excel');
           });

           //店铺分类路由
           Route::prefix('shopcate') -> group(function (){
                //列表
               Route::get('list','ShopCateController@list') -> name('admin.shopcate.list');
               //展开子分类列表
               Route::get('childList/{pid}','ShopCateController@childList') -> name('admin.shopcate.childList');
               //修改状态
               Route::get('active/{id}/{active}','ShopCateController@active') -> name('admin.shopcate.active');
               //添加分类
               Route::any('manage','ShopCateController@add') -> name('admin.shopcate.add');
               //编辑分类
               Route::any('edit','ShopCateController@edit') -> name('admin.shopcate.edit');
               //多级分类子分类列表
               Route::get('nextList','ShopCateController@nextList') -> name('admin.shopcate.nextList');
           });

           //菜单管理路由
           Route::prefix('menu') -> group(function (){
               //添加菜品辅图
               Route::any('addImg','MenuController@addImg') -> name('admin.menu.addImg');
               //菜品列表
               Route::get('list','MenuController@list') -> name('admin.menu.list');
               //添加菜品
               Route::any('add','MenuController@add') -> name('admin.menu.add');
               //菜品的上架和下架
               Route::get("active/{id}/{active}",'MenuController@active') -> name("admin.menu.active");
               //菜品删除
               Route::any("delete/{id}",'MenuController@delete') -> name("admin.menu.delete");
               //菜品编辑
               Route::any("edit/{id}",'MenuController@edit') -> name("admin.menu.edit");
               //菜品订单
               Route::get("salde/{id}",'MenuController@salde') -> name("admin.menu.salde");
               //菜品图片展示
               Route::get("image",'MenuController@image') -> name("admin.menu.image");
           });
       });
   });
});