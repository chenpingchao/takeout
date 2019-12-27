

<?php $__env->startSection('header'); ?>

<link href="/merchant/style/css/style.css" type="text/css" rel="stylesheet">
<link href="/merchant/style/css/external.min.css" type="text/css" rel="stylesheet">
<link href="/merchant/style/css/popup.css" type="text/css" rel="stylesheet">
<link href="/css/public.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/merchant/style/js/jquery.1.10.1.min.js"></script>
<script src="/merchant/style/js/jquery.lib.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/merchant/style/js/ajaxfileupload.js"></script>
<script src="/merchant/style/js/additional-methods.js" type="text/javascript"></script>
<!--[if lte IE 8]>
    <script type="text/javascript" src="/merchant/style/js/excanvas.js"></script>
<![endif]-->
<script src="/merchant/style/js/conv.js" type="text/javascript"></script>
<script src="/merchant/style/js/ajaxCross.json" charset="UTF-8"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('orders'); ?>
	<li ><a href="<?php echo e(route('merchant.orders.index',['sid'=> session('sid') ] )); ?>" rel="nofollow">订单</a></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('main'); ?>
<div id="container">
	<div class="sidebar">
		<dl class="company_center_aside">
			<dt>店铺订单</dt>
			<dd <?php echo e($active==0 ? 'class=current' : ''); ?>>
				<a href="<?php echo e(route('merchant.orders.index',['sid' => session('sid')])); ?>">所有的订单</a>
			</dd>
			<dd <?php echo e($active==1 ? 'class=current' : ''); ?>>
				<a href="<?php echo e(route('merchant.orders.index',['sid' => session('sid'),'active' => 1 ])); ?>">待付款订单</a>
			</dd>
			<dd <?php echo e($active==2 ? 'class=current' : ''); ?>>
				<a href="<?php echo e(route('merchant.orders.index',['sid' => session('sid'),'active' => 2 ])); ?>">待发货订单</a>
			</dd>
			<dd <?php echo e($active==3 ? 'class=current' : ''); ?>>
				<a href="<?php echo e(route('merchant.orders.index',['sid' => session('sid'),'active' => 3 ])); ?>">待签收订单</a>
			</dd >
			<dd <?php echo e($active==4 ? 'class=current' : ''); ?>>
				<a href="<?php echo e(route('merchant.orders.index',['sid' => session('sid'),'active' => 4 ])); ?>">待评论订单</a>
			</dd>
			<dd <?php echo e($active==5 ? 'class=current' : ''); ?>>
				<a href="<?php echo e(route('merchant.orders.index',['sid' => session('sid'),'active' => 5 ])); ?>">已评论订单</a>
			</dd>
			<dd <?php echo e($active==6 ? 'class=current' : ''); ?>>
				<a href="<?php echo e(route('merchant.orders.index',['sid' => session('sid'),'active' => 6 ])); ?>">待退货订单</a>
			</dd>
			<dd class="btm" <?php echo e($active==7 ? 'class=current' : ''); ?>>
				<a href="<?php echo e(route('merchant.orders.index',['sid' => session('sid'),'active' => 7 ])); ?>">已退货订单</a>
			</dd>
		</dl>
	</div><!-- end .sidebar -->
	<div class="content">
		<dl class="company_center_content">
				<div class="filter_actions ">
				</div><!-- end .filter_actions -->

				<ul class="reset resumeLists">
					<?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<li data-id="1686182" class="onlineResume">
					<div class="resumeShow">
					<img src="/<?php echo e($v->avatar?$v->avatar_dir.$v->avatar: '/image/avatar.jpg'); ?>">
					<div class="resumeIntro">
						<h3 class="unread">
							<a title="订单编号" href="<?php echo e(route('merchant.orders.detail',['oid'=> $v -> id ])); ?>">
							<?php echo e($v -> orders_num); ?>

							</a>
						</h3>
						<span class="fr">产生时间：<?php echo e(date('Y-m-d H:i:s',$v -> add_time)); ?></span>
						<div>
							订单总价：<?php echo e($v -> orders_price); ?><br>
							收件人：<i style="color:#16cc3a;"><?php echo e($v -> name); ?></i>&emsp; |&emsp;<?php echo e($v -> mobile); ?><br>
							收货地址：<?php echo e($v -> location . $v -> site); ?>

						</div>
						<div class="jdpublisher">
							<span>
								订单状态：
								<?php switch($v -> active):
									case (1): ?>
										未付款
										<?php break; ?>
									<?php case (2): ?>
									已付款
									<?php break; ?>
									<?php case (3): ?>
									已发货
									<?php break; ?>
									<?php case (4): ?>
									已签收
									<?php break; ?>
									<?php case (5): ?>
									已评论
									<?php break; ?>
									<?php case (6): ?>
									退货
									<?php break; ?>
									<?php case (7): ?>
									已退货
									<?php break; ?>
								<?php endswitch; ?>
							</span>
						</div>
					</div>
				<div class="links">
					<?php switch($v -> active):
						case (2): ?>
						<a href="<?php echo e(route('merchant.orders.shipments',['oid'=> $v->id])); ?>" class="shipments">发货</a>
						<?php break; ?>
						<?php case (5): ?>
						<button href="<?php echo e(route('merchant.orders.reply',[ 'oid'=>$v->id , 'sid'=>session('sid')])); ?>">回复</button>
						<?php break; ?>
						<?php case (6): ?>
						<a href="<?php echo e(route('merchant.orders.returns',['oid'=> $v->id])); ?>" class="returns">退货 </a>
						<?php break; ?>
					<?php endswitch; ?>
			</div>
		</div>
	</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
						<li data-id="1686182" class="onlineResume"><h2>你还没有订单哟</h2></li>
					<?php endif; ?>
				</ul><!-- end .resumeLists -->
		<?php echo e($data -> links()); ?>

		</dl><!-- end .company_center_content -->
	</div><!-- end .content -->
            

<!------------------------------------- end -----------------------------------------> <script src="/merchant/style/js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>
<script src="/merchant/style/js/received_resumes.min.js" type="text/javascript"></script>
<script src="/merchant/style/js/core.min.js" type="text/javascript"></script>
<script src="/merchant/style/js/popup.min.js" type="text/javascript"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
$(function(){
	$('#noticeDot-1').hide();
	$('#noticeTip a.closeNT').click(function(){
		$(this).parent().hide();
	});
});
var index = Math.floor(Math.random() * 2);
var ipArray = new Array('42.62.79.226','42.62.79.227');
var url = "ws://" + ipArray[index] + ":18080/wsServlet?code=314873";
var CallCenter = {
		init:function(url){
			var _websocket = new WebSocket(url);
			_websocket.onopen = function(evt) {
				console.log("Connected to WebSocket server.");
			};
			_websocket.onclose = function(evt) {
				console.log("Disconnected");
			};
			_websocket.onmessage = function(evt) {
				//alert(evt.data);
				var notice = jQuery.parseJSON(evt.data);
				if(notice.status[0] == 0){
					$('#noticeDot-0').hide();
					$('#noticeTip').hide();
					$('#noticeNo').text('').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
					$('#noticeNoPage').text('').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
				}else{
					$('#noticeDot-0').show();
					$('#noticeTip strong').text(notice.status[0]);
					$('#noticeTip').show();
					$('#noticeNo').text('('+notice.status[0]+')').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
					$('#noticeNoPage').text(' ('+notice.status[0]+')').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
				}
				$('#noticeDot-1').hide();
			};
			_websocket.onerror = function(evt) {
				console.log('Error occured: ' + evt);
			};
		}
};
CallCenter.init(url);

//发货h和退货
	$('.shipments').click(function () {
		me  = $(this)
		$.get( me.attr('href') , '', function(data){
			if(data.stats === 'ok' ){
				layer.msg(data.msg ,{icon:6});
				me.closest('li').remove();
			}else{
				layer.msg(data.msg ,{icon:5});
			}
		});
		return false;
	})
$('.returns').click(function () {
	me  = $(this)
	$.get( me.attr('href') , '', function(data){
		if(data.stats === 'ok' ){
			layer.msg(data.msg ,{icon:6});
			me.closest('li').remove();

		}else{
			layer.msg(data.msg ,{icon:5});
		}
	});
	return false;
})

	$('button').click(function(){
		me = $(this);
		layer.open({
			type:2,
			title:'商家回复',
			area:['1000px','500px'],
			content:[me.attr('href')]
		})
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('merchant.public.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>