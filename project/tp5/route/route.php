<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');
//医生模块的资源路由
Route::resource('doctor','doctor/Doctor');

//科室模块的列表路由搜索
Route::get('section','section/Section/index');
//科室模块的删除路由
Route::post('delete','section/Section/delete');
//科室增加路由
Route::post('sectionadd','section/Section/add');

Route::resource('register','chen/Register');


return [

];
