<?php

use App\Cart;
use Intervention\Image\ImageManagerStatic;
//自定义的系统函数

//第一步：在app下创建Common目录，在Common创建functions.php文件，将自定义函数写入该文件
//第二步：修改composer.json文件，添加files配置选项，将functions.php的路径写入该选项
//第三步：在命令行执行composer dump-autoload

function upload($file,$arr = ['image/jpeg','image/png','image/gif'],  $maxSize = 2048576 ){
    //文件类型
    $type =  $file -> getMimeType();
    //判断文件类型
    if(in_array($type,$arr)){
        //判断文件大小
        $size = $file -> getSize();

        if($size <= $maxSize){

            //文件保存的目录
            $dir = config('filesystems.upload');

            //新的随机唯一文件名
            $name = md5(uniqid(mt_rand(),true)) . '.' . $file->getClientOriginalExtension();

            //上传
            if( $file -> move( $dir , $name)){
                //缩放
                $img1 = ImageManagerStatic::make($dir.$name)->resize(800,800)->save($dir.'800_'.$name);
                $img2 = ImageManagerStatic::make($dir.$name)->resize(350,350)->save($dir.'350_'.$name);
                $img3 = ImageManagerStatic::make($dir.$name)->resize(100,100)->save($dir.'100_'.$name);
                $img3 = ImageManagerStatic::make($dir.$name)->resize(8,8)->save($dir.'8_'.$name);
                $img4 = ImageManagerStatic::make($dir.$name)->resize(190,190)->save($dir.'190_'.$name);
                $img5 = ImageManagerStatic::make($dir.$name)->resize(240,240)->save($dir.'240_'.$name);

                //销毁
                $img1 -> destroy();
                $img2 -> destroy();
                $img3 -> destroy();
                $img4 -> destroy();
                $img5 -> destroy();

                return ['status'=>'ok','dir'=>$dir, 'name'=>$name];
            }else{
                return ['status'=>'error','msg'=>'上传失败'];
            }

        }else{
            return ['status'=>'error','msg'=>'文件大小超过最大允许范围'];
        }

    }else{
        return ['status'=>'error','msg'=>'文件类型不正确'];
    }
}


function ad_upload($file,$width,$height,$arr = ['image/jpeg','image/png','image/gif'],  $maxSize = 2048576 ){
    //文件类型
    $type =  $file -> getMimeType();
    //判断文件类型
    if(in_array($type,$arr)){
        //判断文件大小
        $size = $file -> getSize();

        if($size <= $maxSize){

            //文件保存的目录
            $dir = config('filesystems.upload');

            //新的随机唯一文件名
            $name = md5(uniqid(mt_rand(),true)) . '.' . $file->getClientOriginalExtension();

            //上传
            if( $file -> move( $dir , $name)){
                //缩放
                $img1 = ImageManagerStatic::make($dir.$name)->resize($width,$height)->save($dir.$name);

                //销毁
                $img1 -> destroy();

                return ['status'=>'ok','dir'=>$dir, 'name'=>$name];
            }else{
                return ['status'=>'error','msg'=>'上传失败'];
            }

        }else{
            return ['status'=>'error','msg'=>'文件大小超过最大允许范围'];
        }

    }else{
        return ['status'=>'error','msg'=>'文件类型不正确'];
    }
}
/*//只要一张190的图片
function upload_shop($file,$arr = ['image/jpeg','image/png','image/gif'],  $maxSize = 2048576 ){
    //文件类型
    $type =  $file -> getMimeType();
    //判断文件类型
    if(in_array($type,$arr)){
        //判断文件大小
        $size = $file -> getSize();

        if($size <= $maxSize){

            //文件保存的目录
            $dir = config('filesystems.upload');

            //新的随机唯一文件名
            $name = md5(uniqid(mt_rand(),true)) . '.' . $file->getClientOriginalExtension();

            //上传
            if( $file -> move( $dir , $name)){
                //缩放
                $img = ImageManagerStatic::make($dir.$name)->resize(190,190)->save($dir.'190_'.$name);

                //销毁;
                $img -> destroy();

                return ['status'=>'ok','dir'=>$dir, 'name'=>$name];
            }else{
                return ['status'=>'error','msg'=>'上传失败'];
            }

        }else{
            return ['status'=>'error','msg'=>'文件大小超过最大允许范围'];
        }

    }else{
        return ['status'=>'error','msg'=>'文件类型不正确'];
    }
}*/

//获取积分对应的会员等级
function getGrade($score){
    $grades = \App\Grade:: orderBy('score','desc') -> get();
    foreach ($grades as $v){
        if ($score >= $v -> score){
            return $v -> grade_name;
        }
    }
}

function cart_a(){
    if (session('mid')){
        $cart_ss=Cart::where('mid',Session::get('mid'))
            ->sum('buynum');
    }else{
//        session() -> put([ 'cart' =>[ $uid =>[ 'uid' => $uid , 'buynum' => $num,'active' => 1 ] ] ] );
        if (session('cart')){
            $cart=session('cart');
            $cart_q = 0;
            foreach($cart as $v){
                $cart_q += $v['buynum'];
            }
            //未知数组  根据键名 0 1 2 3 查值
            $cart_ss=$cart_q;
        }else{
            $cart_ss=0;
        }
    }
    echo $cart_ss;
}

//随机字符串
function get_rand_str($type=1,$length=4,$str="我是这一个中国人是世界上最好的语言一二三四五六七"){
    switch($type){
        case 1:
            $str = join('',range(0,9));
            break;
        case 2:
            $str = join('',range('a','z'));
            break;
        case 3:
            $str = join('',range('A','Z'));
            break;
        case 4:
            $str = join('',array_merge( range('a','z'),range('A','Z') ));
            break;
        case 5:
            $str = join('',array_merge( range('a','z'),range('A','Z'),range(0,9) ));
            break;
        case 6:
            $arr = str_split($str,3);
            shuffle($arr);
            return mb_substr(join('',$arr),0,$length,'utf-8');
    }

    return substr(str_shuffle($str),0,$length);
}
