
<?php $__env->startSection('header'); ?>

	<link rel="stylesheet" type="text/css" href="/merchant/style/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/merchant/style/css/external.min.css"/>
	<link rel="stylesheet" type="text/css" href="/merchant/style/css/popup.css"/>
	<link rel="stylesheet" type="text/css" href="/css/public.css"/>
	<script src="/merchant/style/js/jquery.1.10.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/merchant/style/js/jquery.lib.min.js"></script>
	<script src="/merchant/style/js/ajaxfileupload.js" type="text/javascript"></script>
	<script type="text/javascript" src="/merchant/style/js/additional-methods.js"></script>
	<!--[if lte IE 8]>
	<script type="text/javascript" src="/merchant/style/js/excanvas.js"></script>

	<script type="text/javascript" src="/merchant/style/js/conv.js"></script><![endif]-->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
	<div id="container">
		<div class="clearfix">
			<div class="content_l">
				<form id="companyListForm" name="companyListForm" method="get" action="h/c/companylist.html">
					<input type="hidden" id="city" name="city" value="全国" />
					<input type="hidden" id="fs" name="fs" value="" />
					<input type="hidden" id="ifs" name="ifs" value="" />
					<input type="hidden" id="ol" name="ol" value="" />

					<ul class="hc_list reset">
						<?php $__empty_1 = true; $__currentLoopData = $shop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
							<li style="position:relative;" >
								<a class="active " href="<?php echo e(route('merchant.shop.shopActive',[ 'sid' => $v->id ,'active'=>$v->active])); ?> " style="position:absolute;top:5px;right:5px;<?php echo e($v -> active == 4 ? 'pointer-events:none' : $v -> active == 3 ? 'pointer-events:none':''); ?>">
									<?php switch($v->active):
										case (1): ?>
											工作中
										<?php break; ?>;
										<?php case (2): ?>
											打烊中
										<?php break; ?>;
										<?php case (3): ?>
										审核中
										<?php break; ?>;
										<?php case (4): ?>
										禁用
										<?php break; ?>;
										<?php endswitch; ?>
								</a>

								<a href="<?php echo e(route('merchant.shop.detail',[ 'sid' => $v->id ])); ?>" target="_blank" style="<?php echo e($v -> active == 4 ? 'pointer-events:none' : ''); ?>">
									<h3 title="CCIC"><?php echo e($v -> shop_name); ?></h3>
									<div class="comLogo">
										<img src="<?php echo e($v -> logo); ?>" width="190" height="190" alt="CCIC" />
									</div>
								</a>
								<a href="<?php echo e(route('merchant.shop.detail',[ 'sid' => $v->id ])); ?>" target="_blank" style="<?php echo e($v -> active ==  4 ? 'pointer-events:none' : ''); ?>"> 电话：<?php echo e($v -> shop_mobile); ?></a>
								<span>简介</span>
								<a href="<?php echo e(route('merchant.shop.detail',[ 'sid' => $v->id ])); ?>" target="_blank" style="<?php echo e($v -> active ==  4 ? 'pointer-events:none' : ''); ?>"><?php echo e(mb_substr($v -> detail,0,26)); ?></a>

							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
							<li >
								<a href="<?php echo e(route('merchant.shop.add')); ?>" target="_blank">
									<div class="comLogo">
										<img src="/image/add.jpg" width="190" height="326" alt="CCIC" />
									</div>
								</a>
							</li>
						<?php endif; ?>
					</ul>
					<div class="Pagination"></div>
				</form>
				<?php echo e($shop -> links()); ?>

			</div>
			<div class="content_r">
				<div class="subscribe_side">
					<a href="<?php echo e(route('merchant.shop.add')); ?>" target="_blank">
						<div class="subpos"><span>创建</span> 店铺</div>
						<div class="c7">创建一个网路店铺，可以将你的名菜上传到店里，小伙伴们就可以点餐啦
						</div>
						<div class="count">已有
							<em>3</em>
							<em>4</em>
							<em>2</em>
							<em>1</em>
							<em>0</em>
							家店铺
						</div>
						<i>我也要创建店铺</i>
					</a>
				</div>
				<div class="greybg qrcode mt20">
					<img src="/merchant/style/images/companylist_qr.png" width="242" height="242" alt="拉勾微信公众号二维码" />
					<span class="c7">扫描上方二维码，微信轻松点餐</span>
				</div>
				<!-- <a href="h/speed/speed3.html" target="_blank" class="adSpeed"></a> -->
				<a href="h/subject/jobguide.html" target="_blank" class="eventAd">
					<img src="/merchant/style/images/subject280.jpg" width="280" height="135" />
				</a>
				<a href="h/subject/risingPrice.html" target="_blank" class="eventAd">
					<img src="/merchant/style/images/rising280.png" width="280" height="135" />
				</a>
			</div>
		</div>
		<input type="hidden" value="" name="userid" id="userid" />

		<div class="clear"></div>
		<input type="hidden" id="resubmitToken" value="" />
		<a id="backtop" title="回到顶部" rel="nofollow"></a>
	</div><!-- end #container -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<script>
		//店铺的激活
		$('.active').click(function(){
			me = $(this);
			$.get(me.attr('href'),'',function(data){
				if(data.stats ==='ok'){
					layer.msg(data.msg,{icon:6});
					me.text(data.act).attr('href',data.url)
				}else{
					layer.msg(data.msg,{icon:5})
				}
			});
			return false;
		})
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('merchant.public.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>