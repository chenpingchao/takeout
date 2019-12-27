<?php $__env->startSection('header'); ?>
    <head>
        <meta charset="utf-8" />
        <title>确认订单-DeathGhost</title>
        <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
        <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
        <meta name="author" content="DeathGhost"/>
        <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
        <link rel="Shortcut Icon" href="/image/title.ico">
        <script type="text/javascript" src="/home/js/public.js"></script>
        <script type="text/javascript" src="/home/js/jquery.js"></script>
        <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
        <script type="text/javascript" src="/home/js/jqpublic.js"></script>
        <!--
        Author: DeathGhost
        Author URI: http://www.deathghost.cn
        -->
    </head>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

    <?php if($stats === 'ok'): ?>
    <section class="Psection MT20 Textcenter"  id="Aflow">
        <!-- 订单提交成功后则显示如下 -->
        <p class="Font14 Lineheight35 FontW">恭喜你！订单提交成功！</p>
        <p class="Font14 Lineheight35 FontW">您的订单编号为：<span class="CorRed"><?php echo e($data['orders_num']); ?></span></p>
        <p class="Font14 Lineheight35 FontW">共计金额：<span class="CorRed">￥<?php echo e($data['orders_price']); ?></span></p>
        <p>
            <button type="button" class="Lineheight35"><a href="#" target="_blank">支付宝立即支付</a></button>
            <button type="button" class="Lineheight35"><a href="<?php echo e(route('hm.mem.UserOrder')); ?>">进入用户中心</a></button>
        </p>
    </section>
    <?php else: ?>
        <section class="Psection MT20 Textcenter" id="Aflow">
            <!-- 订单提交成功后则显示如下 -->
            <p class="Font14 Lineheight35 FontW">订单提交失败！</p>
            <p>
                <button type="button" class="Lineheight35">
                    <a href="<?php echo e(route('hm.mem.UserOrder')); ?>">进入用户中心</a>
                </button>
            </p>
        </section>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.public.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>