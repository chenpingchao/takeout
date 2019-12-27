<?php $__env->startSection('header'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

<!--Start content-->
<section class="Psection MT20">
<nav class="U-nav Font14 FontW">
  <ul>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserCenter')); ?>">用户中心首页</a></li>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserOrder')); ?>">我的订单</a></li>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserAddress')); ?>">收货地址</a></li>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserMessage')); ?>">我的留言</a></li>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserCoupon')); ?>">我的优惠券</a></li>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserFavorites')); ?>">我的收藏</a></li>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserAccount')); ?>">账户管理</a></li>
   <li><i></i><a href="<?php echo e(route('home.logout')); ?>">安全退出</a></li>
  </ul>
 </nav>
 <article class="U-article Overflow">
  <!--user Favorites-->
  <section class="ShopFav Overflow">
   <span class="ShopFavtitle Block Font14 FontW Lineheight35">我的收藏</span>
   <ul>
    <a href="shop.html" target="_blank">
    <li>
     <img src="/home/upload/cc.jpg">
     <p>好味来快餐店 ( 删除 )</p>
    </li>
    </a>
   </ul>
  </section>
 </article>
</section>
<!--End content-->
<?php $__env->stopSection(); ?>
<!--另起炉灶 js-->
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.public.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>