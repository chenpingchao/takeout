<?php $__env->startSection('header'); ?>

    <link href="/merchant/style/css/style.css" type="text/css" rel="stylesheet">
    <link href="/merchant/style/css/external.min.css" type="text/css" rel="stylesheet">
    <link href="/merchant/style/css/popup.css" type="text/css" rel="stylesheet">
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/admin/css/style.css"/>
    <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
    <![endif]-->
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script type="text/javascript" src="/admin/js/H-ui.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/assets/js/jquery.easy-pie-chart.min.js"></script>
    <script src="/admin/js/lrtk.js" type="text/javascript" ></script>
    <title>订单详细</title>
    <style>
        div.product_info a{
            color:#CC40C4;
            font-size: 19px;
            text-decoration:none;
        }
        div.width{
            width:1024px;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('orders'); ?>
    <li ><a href="<?php echo e(route('merchant.orders.index',['sid'=> session('sid') ] )); ?>" rel="nofollow">订单</a></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('main'); ?><div id="container">

<div class="Order_Details_style">
<div class="Numbering">订单编号:<b><?php echo e($orders_msg[0] -> orders_num); ?></b></div></div>
 <div class="detailed_style">
 <!--收件人信息-->
    <span class="Receiver_style">
     <div class="title_name">收件人信息</div>
     <span class="Info_style clearfix">
        <span style="float:left;margin:10px;">
         <label class="label_name" for="form-field-2"> 收件人姓名： </label>
         <span class="o_content"><?php echo e($orders_msg[0] -> name); ?></span>
        </span>
        <span style="float:left;margin:10px;">
         <label class="label_name" for="form-field-2"> 收件人电话： </label>
         <span class="o_content"><?php echo e($orders_msg[0] -> moble); ?></span>
        </span>
         <span style="float:left;margin:10px;">
         <label class="label_name" for="form-field-2"> 收件地址： </label>
         <span class="o_content"><?php echo e($orders_msg[0] -> site); ?><?php echo e($orders_msg[0] -> location); ?></span>
        </span>
    </span>
    </span>
    <!--订单信息-->
    <div class="product_style">
        <div class="title_name">产品信息</div>
         <div class="Info_style clearfix">
                <?php $__empty_1 = true; $__currentLoopData = $menu_msg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="product_info clearfix">
                        <a href="<?php echo e($v -> id); ?>" class="img_link"><img src="/<?php echo e($v -> image_dir.$v->image); ?>" /></a>
                        <span>
                            <a href="<?php echo e($v -> id); ?>" class="name_link"><?php echo e($v -> menu_name); ?></a><br>
                            <p>数量：<?php echo e($v -> num); ?></p>
                            <p>价格：<b class="price"><i>￥</i><?php echo e($v -> price); ?></b></p>

                        </span>
              </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <h1>该订单商品被删除</h1>
                <?php endif; ?>
            </div>
        </div>
    <!--总价-->
    <div class="Total_style">
        <div class="Info_style clearfix">
            <div class="col-xs-3"  style="float:left;margin:10px;width:300px;"  >
                <label class="label_name"  for="form-field-2"> 支付方式： </label>
                <div class="o_content">在线支付</div>
            </div>
            <div class="col-xs-3"   style="float:left;margin:10px;width:300px;">
                <label class="label_name" for="form-field-2" > 支付状态： </label>
                <div class="o_content">
                    <?php switch($menu_msg[0] -> active ):
                        case (1): ?>
                            <span class="label label-success radius">未付款</span>
                            <?php break; ?>
                        <?php case (2): ?>
                            <span class="label label-success radius">已付款</span>
                            <?php break; ?>
                        <?php case (3): ?>
                            <span class="label label-success radius">已发货</span>
                            <?php break; ?>
                        <?php case (4): ?>
                            <span class="label label-success radius">已签收</span>
                            <?php break; ?>
                        <?php case (5): ?>
                            <span class="label label-success radius">已评论</span>
                            <?php break; ?>
                        <?php case (6): ?>
                            <span class="label label-success radius">退货</span>
                            <?php break; ?>
                    <?php endswitch; ?>
                </div>
            </div>
            <div class="col-xs-3"  style=" float:left;margin:10px;width:300px;">
                <label class="label_name" for="form-field-2" > 订单生成日期： </label>
                <div class="o_content" style="width:300px;"><?php echo e(date("Y-m-d H:i:s",$menu_msg[0] -> add_time )); ?></div>
            </div>
        </div>
        <div class="Total_m_style">
            <span class="Total" style="margin-left:45px;">总数：<b>10</b></span>
            <span class="Total_price">总价：<b><?php echo e($menu_msg[0] -> orders_price); ?></b>元</span>
        </div>
    </div>



<div class="Button_operation">
    <button  class="back_page btn btn-primary radius" id="back"><i class="icon-save "></i>返回上一步</button>
    <button onclick="layer_close();" class=" btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
</div>
 </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    //后退一步操作
    $('#back').click(function(){
        history.back();
    })
    //返会订单页面
    function layer_close(){
        location = "<?php echo e(route('merchant.orders.index',['sid'=>session('sid')])); ?>";
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('merchant.public.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>