<?php $__env->startSection('header'); ?>
<head>
<meta charset="utf-8" />
<title>DeathGhost-用户中心</title>
<meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
<meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
<meta name="author" content="DeathGhost"/>
 <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="/home/js/public.js"></script>
 <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
 <script type="text/javascript" src="/home/js/jqpublic.js"></script>
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
  <!--user Coupon-->
  <section class="M-coupon Overflow">
   <span class="coupontitle Block Font14 FontW Lineheight35">我的积分:<span style="color: #1E9FFF"><?php echo e($score); ?></span>&emsp; <span><button id="convert" style="color: #f1a02f">兑换优惠券</button></span>&emsp;我的优惠券</span>
   <ul>
    <?php $__empty_1 = true; $__currentLoopData = $redpacket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <a href="/" class="Fontfff" target="_self" title="去首页使用">
    <li <?php echo e($v -> active == 1 ? '' : 'style=background-color:#ccc'); ?>>
     <p class="U-price FontW"><i>￥</i><?php echo e($v -> value); ?><span class="Font14 FontW">全站通用</span></p>
     <?php if($v -> type == 1): ?>
      <p>红包类型：无门楷红包</p>
     <?php else: ?>
     <p>使用条件：满<?php echo e($v -> value * 3); ?>元即可使用</p>
     <?php endif; ?>
     <?php if($v -> active == 1): ?>
     <p>有效期<?php echo e(date('Y-m-d',$v->add_time)); ?>至<?php echo e(date('Y-m-d',$v->end_time)); ?></p>
      <?php else: ?>
      <p><?php echo e($v -> active == 2 ? '已使用' :'已过期'); ?></p>
      <?php endif; ?>
    </li>
    </a>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <li><p>暂时没有优惠券 请兑换</p></li>
     <?php endif; ?>
   </ul>
  </section>
 </article>
</section>
<!--End content-->
<?php $__env->stopSection(); ?>
<!--另起炉灶 js-->
<?php $__env->startSection('script'); ?>
 <script src="/home/js/layer/layer.js"></script>
 <script>
  $('#convert').click(function () {
   layer.open({
    type: 2,
    title: '积分兑换',
    area: ['500px', '350px'],
    content: ['<?php echo e(route('home.score.convert')); ?>']
   });
  });
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.public.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>