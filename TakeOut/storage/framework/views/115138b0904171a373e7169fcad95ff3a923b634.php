<?php $__env->startSection('header'); ?>
<head>
<meta charset="utf-8" />
<title>用户中心-我的订单</title>
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
  <!--user order list-->
  <section>
    <table class="Myorder">
        <thead>
            <tr>
                <th class="Font14 FontW">订单编号</th>
                <th class="Font14 FontW">下单时间</th>
                <th class="Font14 FontW">收件人</th>
                <th class="Font14 FontW">订单总金额</th>
                <th class="Font14 FontW">订单状态</th>
                <th class="Font14 FontW">操作</th>
            </tr>
        </thead>
        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tbody>
            <tr>
                <td class="FontW"><a href="#"><?php echo e($v->orders_num); ?></a></td>
                <td><?php echo e(date('Y-m-d H:i:s',$v->add_time)); ?></td>
                <td><?php echo e($v->name); ?></td>
                <td><?php echo e($v->orders_price); ?></td>
                <td><?php
                    switch($orders[$k]['active']){
                        case 1:
                            echo '未付款';
                            break;
                        case 2:
                            echo '已付款,待发货';
                            break;
                        case 3:
                            echo '已发货,待签收';
                            break;
                        case 4:
                            echo '已签收,待评论';
                            break;
                        case 5:
                            echo '已评论';
                            break;
                        case 6:
                            echo '待退款';
                            break;
                        case 7:
                            echo '已退款';
                            break;
                    }?>
                </td>
                <td><a href="#">取消订单</a> | <a href="#">付款</a></td>
            </tr>
        </tbody>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6">
                    <h3>没找到满足条件的数据</h3>
                </td>
            </tr>
        <?php endif; ?>
    </table>
    <div class="TurnPage">
         <a href="#">
          <span class="Prev"><i></i>首页</span>
         </a>
         <a href="#"><span class="PNumber">1</span></a>
         <a href="#"><span class="PNumber">2</span></a>
         <a href="#">
         <span class="Next">最后一页<i></i></span>
        </a>
       </div>
  </section>
 </article>
</section>
<!--End content-->
<?php $__env->stopSection(); ?>
<!--另起炉灶 js-->
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.public.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>