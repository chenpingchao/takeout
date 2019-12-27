@extends('home.public.public')
{{--截取头部--}}
@section('header')
<head>
<meta charset="utf-8" />
<title>DeathGhost-用户中心</title>
<meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
<meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
<meta name="author" content="DeathGhost"/>
 <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
 <link href="/home/preview/preview.css" type="text/javascript" rel="stylesheet">
 <link href="/admin/css/validate.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="/home/js/public.js"></script>
 <script type="text/javascript" src="/home/js/jQuery.1.8.2.min.js"></script>
 <script type="text/javascript" src="/home/preview/preview_LW.js"></script>
 <script type="text/javascript" src="/home/js/jqpublic.js"></script>
 <script type="text/javascript" src="/js/jquery.form.js"></script>
 <script type="text/javascript" src="/js/layer/layer.js"></script>
 <link rel="stylesheet" href="/js/webuploader/webuploader.css" />
 <script src="/js/webuploader/webuploader.js"></script>
{{-- <script src="/js/webuploader/upload.js"></script>--}}
<!--
Author: DeathGhost
Author URI: http://www.deathghost.cn
-->
</head>
@endsection
{{--截取主体--}}
@section('main')
<!--Start content-->
<section class="Psection MT20">
<nav class="U-nav Font14 FontW">
  <ul>
   <li><i></i><a href="{{route('hm.mem.UserCenter')}}">用户中心首页</a></li>
   <li><i></i><a href="{{route('hm.mem.UserOrder')}}">我的订单</a></li>
   <li><i></i><a href="{{route('hm.mem.UserAddress')}}">收货地址</a></li>
   <li><i></i><a href="{{route('hm.mem.UserMessage')}}">我的留言</a></li>
   <li><i></i><a href="{{route('hm.mem.UserCoupon')}}">我的优惠券</a></li>
   <li><i></i><a href="{{route('hm.mem.UserFavorites')}}">我的收藏</a></li>
   <li><i></i><a href="{{route('hm.mem.UserAccount')}}">账户管理</a></li>
   <li><i></i><a href="{{route('home.logout')}}">安全退出</a></li>
  </ul>
 </nav>
 <article class="U-article Overflow">
  <!--user Account-->
  <section class="AccManage Overflow">
   <span class="AMTitle Block Font14 FontW Lineheight35">账户管理</span>
   <p>登陆邮箱：{{$member->email}} ( <a href="#" id="email" target="_blank">更换邮箱</a> )</p>
   <p>手机号码：{{$member->mobile}} ( <a href="#" id="mobile" target="_blank">更换手机号码</a> )</p>
   <p>上次登陆：{{date('Y年m月d日 H时i分s秒',$member->old_login)}}( *如非本人登陆，请立即<a href="#" id="pass" target="_blank">修改您的密码</a>！ )</p>

   <form action="" method="post" enctype="multipart/form-data" id="member-form">
    {{csrf_field()}}
    <table>
    <tr>
    <td width="20%" align="right"><label for="pic" class="preview-label">*修改头像：</label></td>
    <td>
     <div class="preview-div1" style="position:relative">
      <input type="file" id="avatar" name="avatar" class="preview-input"  onchange="preview(this,200,150)">
      <img  src="/{{$member->avatar_dir}}{{$member->avatar}}"  alt="" width="200px" height="150px" style="position:absolute;left:500px;top:0;border-radius:50%;">
     </div>
    </td>
    </tr>

    <tr>
    <td width="20%" align="right">*昵称：</td>
    <td>
     <input type="text" name="username" value="{{$member->username}}"><div class="validate-error username"></div>
    </td>
    </tr>

    <tr>
    <td></td>
    <td><input name="" type="button" class="btn" value="保 存"></td>
    </tr>
    </table>
   </form>
  </section>
 </article>
</section>
<!--End content-->
@endsection
<!--另起炉灶 js-->
@section('script')
<script type="text/javascript">
 //异步提交表单
 $('.btn').click(function(){
  $('#member-form').ajaxSubmit({
   success:function(data){
    if(data.status === 'ok'){
     parent.layer.msg(data.msg,{icon:6,shade:[0.6],time:1500},function(){
      location = '{{route("hm.mem.UserAccount")}}';
     })
    }else{
     parent.layer.msg(data.msg,{icon:6,shade:[0.6],time:1500})
    }
   },
   error:function(xhr){
    //验证的处理
    //console.log(xhr.responseText);
    var errors=JSON.parse(xhr.responseText);
    $('.validate-error').html('');
    if(errors){
     for(var i in errors){
      $('.'+i).text(errors[i][0])
     }
    }
   }
  });
  return false;
 });
</script>
 <script>
  //三个修改弹窗
  // --邮箱
  $('#email').click(function(){
   layer.open({
    type: 2,
    title:'更换邮箱',
    skin: 'layui-layer-rim',
    area: ['500px', '420px'],
    content:['{{route('hm.mem.UserAccount_email')}}','no'] //no表示不出现滚动条
   });
   return false;
  });
  //--手机
 $('#mobile').click(function () {
  layer.open({
   type:2,
   title:'更换手机号码',
   skin:'layui-layer-rim',
   area:['500px', '420px'],
   content:['{{route('hm.mem.UserAccount_mobile')}}','no']
  });
  return false;
 });
 //--密码修改
  $('#pass').click(function () {
   layer.open({
    type:2,
    title:'更换手机号码',
    skin:'layui-layer-rim',
    area:['500px', '340px'],
    content:['{{route('hm.mem.UserAccount_pass')}}','no']
   });
   return false
  });
 </script>
@endsection
