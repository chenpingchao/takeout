<?php

function dd($var){
    echo "<pre>";
    if(is_numeric($var) || is_string($var)){
        echo $var;
    }elseif(is_array($var)){
        print_r($var);
    }else{
        var_dump($var);
    }
    echo "</pre>";
};

//获取积分对应的会员等级
function getGrade($score){
    $grades = M('Grade') -> order('score desc')
                         -> select();
    foreach ($grades as $v){
        if ($score >= $v['score']){
            return $v['grade_name'];
        }
    }
}


function rand_num($num,$end,$start=0){
    $rand_num = [];
    for($i=0;$i<$num;$i++){
        $rand_num = mt_rand($start,$end);
    }
    return $rand_num;
}

//将中文转换为字节码
function UnicodeEncode($str)
{
    //split word
    preg_match_all('/./u', $str, $matches);

    $unicodeStr = "";
    foreach ($matches[0] as $m) {
        //拼接
        $unicodeStr .= "&#" . base_convert(bin2hex(iconv('UTF-8', "UCS-4", $m)), 16, 10);
    }
    return $unicodeStr;
}

