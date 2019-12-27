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
 <script type="text/javascript" src="/home/js/public.js"></script>
 <script type="text/javascript" src="/home/js/jquery.js"></script>
 <script type="text/javascript" src="/home/js/jqpublic.js"></script>
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
  <!--user Favorites-->
  <section class="ShopFav Overflow">
   <span class="ShopFavtitle Block Font14 FontW Lineheight35">我的收藏</span>
   @forelse($Collection as $k=>$v)

   <ul>
    <a href="{{route('home.shopDetail',['sid' => $v->id])}}" target="_blank" title="{{$v->shop_name}}">
    <li>
     <img src="{{$v->logo}}">
     <p>{{$v->shop_name}}</p>
    </li>
    </a>
   </ul>
   @empty
    <h2>暂无收藏的店铺</h2>
   @endforelse
  </section>
 </article>
</section>
<!--End content-->
@endsection
<!--另起炉灶 js-->
@section('script')

@endsection