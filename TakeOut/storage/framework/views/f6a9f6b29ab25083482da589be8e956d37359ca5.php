<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
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
    <script src="/admin/js/H-ui.js" type="text/javascript"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
<title>退款详细</title>
</head>

<body>
<div class="margin clearfix">
 <div class="Refund_detailed">
    <div class="Numbering">退款单编号:<b><?php echo e($data['msg'][0] -> orders_num); ?></b></div>
    <div class="detailed_style">
     <!--退款信息-->
     <div class="Receiver_style">
     <div class="title_name">退款信息</div>
     <div class="Info_style clearfix">
        <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 退款人姓名： </label>
         <div class="o_content"><?php echo e($data['msg'][0] -> username); ?></div>
        </div>
        <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 退款人电话： </label>
         <div class="o_content"><?php echo e($data['msg'][0] -> moble); ?></div>
        </div>
         <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 退款数量：</label>
         <div class="o_content"><?php echo e($data['orders_menu_num']); ?></div>
        </div>
        <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 退款金额：</label>
         <div class="o_content"><?php echo e($data['msg'][0] -> orders_price); ?>元</div>
        </div>
        <div class="col-xs-3">
         <label class="label_name" for="form-field-2"> 退款日期：</label>
         <div class="o_content"><?php echo e(date('Y-m-d h:i:s',$data['msg'][0] -> add_time )); ?></div>
        </div>
        <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 状态：</label>
         <div class="o_content">
             <?php if( $data['msg'][0] -> active == 6 ): ?>
                 <span>待退货</span>
             <?php else: ?>
                 <span>已退货</span>
             <?php endif; ?>

         </div>
        </div>
     </div>
    </div>
    <div class="Receiver_style">
    <div class="title_name">退款说明</div>
    <div class="reund_content">
      买家收到货,需要退货,如何退货呢--淘宝退款流程交易订单的交易状态是卖家已发货,有可能是因为产品问题或者其他原因需要退...  
    </div>
    </div>
    
    <!--产品信息-->
    <div class="product_style">
    <div class="title_name">产品信息</div>
    <div class="Info_style clearfix">
        <?php $__currentLoopData = $data['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k =>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product_info clearfix">
                <a href="<?php echo e($v -> id); ?>" class="img_link">
                    <img src="/admin/products/p_3.jpg">
                </a>
                <span>
                    <a href="<?php echo e($v -> id); ?>" class="name_link" style="font-size:25px;color:#CC48B2;"><?php echo e($v -> menu_name); ?></a><br>
                    <p>数量：<?php echo e($v -> num); ?>件</p>
                    <p>价格：<b class="price"><i>￥</i><?php echo e($v -> price); ?></b></p>
                    <p class="status">
                        <?php if( $v -> active == 6 ): ?>
                            待退货
                        <?php else: ?>
                            已退货
                        <?php endif; ?>
</p>
                </span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>
    </div>    
 </div>
</div>
</body>
</html>
