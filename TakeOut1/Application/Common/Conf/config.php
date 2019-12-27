<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'                => 'mysql', // 数据库类型
    'DB_HOST'                => '10.50.0.158', // 服务器地址
    'DB_NAME'                => 'one', // 数据库名
    'DB_USER'                => 'one', // 用户名
    'DB_PWD'                 => 'one', // 密码
    'DB_PORT'                => '3306', // 端口
    'DB_PREFIX'              => 'one_', // 数据库表前缀
    'URL_MODEL'              => 2,  //url重写
    'SHOW_PAGE_TRACE'        => true, //调试工具

    'TMPL_PARSE_STRING'  =>array(

     '__PC__' => 'http://www.liuweiliming.cn/', // 图片
     '__SHOP__' => 'http://www.liuweiliming.cn', // 更改默认的/Public 替换规则

     '__PUBLIC__' => '/Public/', // 网站样式和js和img

        //短信验证码


)



);