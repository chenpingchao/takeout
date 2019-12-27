<?php $__env->startSection('header'); ?>
<head>
<meta charset="utf-8" />
<title>用户中心</title>
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
  <!--"引用“user_page/user_index.html”"-->
  <section class="usercenter">
   <span class="Weltitle Block Font16 CorRed FontW Lineheight35">Welcome欢迎光临！</span>
   <div class="U-header MT20 Overflow">
    <img style="width: 110px" src="<?php echo e(session('mavatar')?'/'.session('mavatar_dir').session('mavatar'):'/home/images/mao.jpg'); ?>">
    <p class="Font14 FontW"><?php echo e($mem[0]['username']); ?> 欢迎您回到 用户中心！</p>
    <p class="Font12">您的上一次登录时间:<time> <?php echo e($mem[0]['old_login']?date('Y-m-d H:i:s',$mem[0]['old_login']):'开天之物'); ?></time></p>
    <p class="Font12 CorRed FontW">我的优惠券( 0 ) | 我的积分( <?php echo e($mem[0]['score']); ?> )</p>
   </div>
    <ul class="s-States Overflow FontW" id="Lbn">
     <li class="Font14 FontW">幸福业务在线提醒：</li>
     <li><a href="#">待付款( <?php echo e($order1); ?> )</a></li>
     <li><a href="#">待发货( <?php echo e($order2); ?> )</a></li>
     <li><a href="#">待收货( <?php echo e($order3); ?> )</a></li>
     <li><a href="#">待评价( <?php echo e($order4); ?> )</a></li>
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