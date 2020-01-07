<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function dd($var)
{
    echo "<pre>";
    if (is_numeric($var) || is_string($var)) {
        echo $var;
    } elseif (is_array($var)) {
        print_r($var);
    } else {
        var_dump($var);
    }
    echo "</pre>";
}


//api返会
function ret_json($code, $msg = '', $http_code = 200, $data = [])
{
    $json['code'] = $code;
    if (!empty($msg)) {
        $json['message'] = $msg;
    }
    if (!empty($data)) {
        $json['data'] = $data;
    }

    return json($json, $http_code);
}


function toJson($code,$message='',$httpCode=200,$data=[]){
    $jsonData['code'] = $code;
    if($message){
        $jsonData['message'] = $message;
    }

    if($data){
        $jsonData['data'] = $data;
    }

    return json($jsonData,$httpCode);


}