

<?php $__env->startSection('header'); ?>

<link href="/merchant/style/css/style.css" type="text/css" rel="stylesheet">
<link href="/merchant/style/css/external.min.css" type="text/css" rel="stylesheet">
<link href="/merchant/style/css/popup.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="/merchant/style/css/preview.css">
<link rel="stylesheet" href="/css/public.css">

<script type="text/javascript" src="/merchant/style/js/jquery.1.10.1.min.js"></script>
<script src="/merchant/style/js/jquery.lib.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/merchant/style/js/ajaxfileupload.js"></script>
<script src="/merchant/style/js/additional-methods.js" type="text/javascript"></script>
<script src="/js/layer/layer.js" type="text/javascript"></script>
<!--[if lte IE 8]-->
    <script type="text/javascript" src="/merchant/style/js/excanvas.js"></script>
<!--[endif]-->
<script src="/js/preview/preview.js"></script>
<style>
    .width{
        width:220px;
        height: 336px;
    }

</style>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('orders'); ?>
    <li ><a href="<?php echo e(route('merchant.orders.index',['sid'=> session('sid') ] )); ?>" rel="nofollow">订单</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <div id="container">
        <!-- <script src="/merchant/style/js/swfobject_modified.js" type="text/javascript"></script> -->
        <div class="clearfix">
			
            <div class="content_l">           
				<div class="c_detail">
					
					<div style="background-color:#fff;" class="c_logo">
						<div class="preview-div">
							<label for="pic" class="preview-label">店铺LOGO</label>
							<input type="file" id="pic" name="logo" onchange="preview(this,190,190)" class="preview-input">
							<img src="<?php echo e($detail -> logo); ?>" alt="店铺logo" >
						</div>
					</div>
					
					<div class="c_box companyName">
						<h2 title="剪短名称"><?php echo e(mb_substr($detail -> shop_name,0,30)); ?></h2>
						<div class="clear"></div>

						
						<form class="clear editDetail dn" id="editDetailForm" method="post" action="<?php echo e(route('merchant.shop.shopchange')); ?>">
							<?php echo e(csrf_field()); ?>

							<input type="text" placeholder="请输入店铺名" value="<?php echo e($detail -> shop_name); ?>" name="shop_name" id="companyShortName">
							<input type="text" placeholder="店铺电话" value="<?php echo e($detail -> shop_mobile); ?>" name="shop_mobile" id="companyFeatures">
							<input type="text" placeholder="店铺地址" value="<?php echo e($detail -> location); ?><?php echo e($detail -> site); ?>" name="site" id="companyFeatures">
							<input type="hidden" value="<?php echo e($detail -> id); ?>" id="companyId" name="sid">
							<input type="submit" value="保存" id="saveDetail" class="btn_small">
							<a id="cancelDetail" class="btn_cancel_s" href="javascript:changeOut('editDetailForm')";>取消</a>
						</form>

						
						<div class="clear oneword">
							<h1 class="fullname" style="display:inline-block;">店铺评价：<?php echo e($detail->grade); ?></h1><div class="bg" style="display:inline-block;"><div style="width:<?php echo e($detail -> gradebi); ?>%;"></div></div>
							<h1 class="fullname">平均消费：<?php echo e($detail->avg_price); ?></h1>
							<h1 title="店铺电话" class="fullname">店铺电话：<?php echo e($detail -> shop_mobile); ?></h1>
							<h1 title="店铺地址" class="fullname">店铺地址：<?php echo e($detail -> site); ?></h1>

					</div>
						<a title="编辑基本信息" class="c_edit" id="editCompanyDetail" href="javascript:show('editDetailForm');"></a>
						<div class="clear"></div>
	                </div>
				<div class="c_breakline"></div>

				<div id="Profile">
					<div class="profile_wrap">
						<!--无介绍 -->
						<!--编辑介绍-->
						<dl class="c_section newIntro dn" id="companyDesFormDiv">
							<dt>
								<h2><em></em>公司介绍</h2>
							</dt>
							<dd>
								<form id="companyDesForm" method="post">
									<?php echo e(csrf_field()); ?>

									<textarea placeholder="" name="detail" id="companyProfile"></textarea>
									<input type="hidden" value="<?php echo e($detail -> id); ?>" id="sid" name="sid">
									<div class="word_count fr">你还可以输入 <span>1000</span> 字</div>
									<div class="clear"></div>
									<input type="submit" value="保存" id="submitProfile" class="btn_small">
									<a id="delProfile" class="btn_cancel_s" href="javascript:changeOut('companyDesFormDiv')">取消</a>
								</form>
							</dd>
						</dl>

						<!--有介绍-->
						<dl class="c_section">
							<dt>
								<h2><em></em>公司介绍</h2>
							</dt>
							<dd>
								<div class="c_intro"><?php echo e($detail -> detail); ?></div>
								<a title="编辑公司介绍" id="editIntro" class="c_edit" href="javascript:show('companyDesFormDiv')"></a>
							</dd>
						</dl>
					</div>
					
                    <dl class="c_section">
                        <dt>
                            <h2><em></em>店铺菜品</h2>
                        </dt>
                        <dd>
                            <ul class="hc_list reset">
                                <?php $__empty_1 = true; $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="width" style="position:relative;">
                                        <a class="active" href="<?php echo e(route('merchant.shop.menuActive',[ 'uid' => $v->id ,'active'=>$v->active])); ?> " style="position:absolute;top:5px;right:5px;">
                                            <?php echo e($v -> active == 1 ? '上架' : '下架'); ?>

                                        </a>
                                        <a href="<?php echo e(route('merchant.shop.menuDetail',[ 'uid' => $v->id ])); ?>" target="_blank" >
                                            <span style="font-size: 20px"><?php echo e($v -> menu_name); ?></span>
                                            <div class="comLogo">
                                                <img src="/<?php echo e($v -> image_dir .$v -> image ?$v -> image_dir .'190_'.$v -> image : "image/timg.jpg"); ?>" width="190" height="190" alt="CCIC" />
                                            </div>
                                        </a>
                                        <span>价格：<?php echo e($v -> price); ?></span>&emsp;&nbsp;
                                        <span>销量：<?php echo e($v -> salde_num); ?></span><br>
                                        <span>评价数量：<?php echo e($v -> eval_num); ?></span><br>
                                        <span>关键词：<?php echo e($v -> key_words); ?></span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <span>您的店铺当中还没有菜品快去添加吧</span>
                                <?php endif; ?>
                            </ul> <!-- end #Product -->
                        </dd>
                    </dl>


      	
      	<!--[if IE 7]> <br /> <![endif]-->
	    
	        	<!--无招聘职位-->
				<dl id="noJobs" class="c_section">
		                	<dt>
		                    	<h2><em></em>发布菜品</h2>
		                    </dt>
		                    <dd>
		                    	<div class="addnew">
		                        	发布新的菜品，让更多的人知道……<br>
		                            <a href="<?php echo e(route('merchant.shop.menuAdd',['sid'=> $detail->id])); ?>">+添加新的菜品</a>
		                        </div>
		                    </dd>
		                </dl>

	          	<input type="hidden" value="" name="hasNextPage" id="hasNextPage">
	          	<input type="hidden" value="" name="pageNo" id="pageNo">
	          	<input type="hidden" value="" name="pageSize" id="pageSize">
          		<div id="flag"></div>
            </div>	<!-- end .content_l -->

   	</div>

<!-------------------------------------弹窗lightbox  ----------------------------------------->
<div style="display:none;">
	<div style="width:650px;height:470px;" class="popup" id="logoUploader">
		<object width="650" height="470" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="FlashID">
		  <param value="../../flash/avatar.swf?url=http://www.lagou.com/cd/saveProfileLogo.json" name="movie">
		  <param value="high" name="quality">
		  <param value="opaque" name="wmode">
		  <param value="111.0.0.0" name="swfversion">
		  <!-- 此 param 标签提示使用 Flash Player 6.0 r65 和更高版本的用户下载最新版本的 Flash Player。如果您不想让用户看到该提示，请将其删除。 -->
		  <param value="../../Scripts/expressInstall.swf" name="expressinstall">
		  <!-- 下一个对象标签用于非 IE 浏览器。所以使用 IECC 将其从 IE 隐藏。 -->
		  <!--[if !IE]>-->
		  <object width="650" height="470" data="../../flash/avatar.swf?url=http://www.lagou.com/cd/saveProfileLogo.json" type="application/x-shockwave-flash">
		    <!--<![endif]-->
		    <param value="high" name="quality">
		    <param value="opaque" name="wmode">
		    <param value="111.0.0.0" name="swfversion">
		    <param value="../../Scripts/expressInstall.swf" name="expressinstall">
		    <!-- 浏览器将以下替代内容显示给使用 Flash Player 6.0 和更低版本的用户。 -->
		    <div>
		      <h4>此页面上的内容需要较新版本的 Adobe Flash Player。</h4>
		      <p><a href="http://www.adobe.com/go/getflashplayer"><img width="112" height="33" src="/merchant/style/images/get_flash_player.gif" alt="获取 Adobe Flash Player"></a></p>
		    </div>
		    <!--[if !IE]>-->
		  </object>
		  <!--<![endif]-->
		</object>
	</div><!-- #logoUploader -->
</div>
<!------------------------------------- end ----------------------------------------->
<script src="/merchant/style/js/company.min.js" type="text/javascript"></script>
<script>
var avatar = {};
avatar.uploadComplate = function( data ){
	var result = eval('('+ data +')');
	if(result.success){
		jQuery('#logoShow img').attr("src",ctx+ '/'+result.content);
		jQuery.colorbox.close();
	}
};
</script>
			<div class="clear"></div>
			<input type="hidden" value="d1035b6caa514d869727cff29a1c2e0c" id="resubmitToken">
	    	<a rel="nofollow" title="回到顶部" id="backtop" style="display: inline;"></a>
	   		 </div><!-- end #container -->
		</div>
		<div class="content_r">
			<div id="Member">
				<!--有创始团队-->
				<dl class="c_section c_member">
					<dt>
						<h2><em></em>店铺负责人</h2>
					</dt>
					<dd>
						<div class="member_wrap">
							<!-- 显示创始人 -->
							<div class="member_info">
								<a title="编辑负责人" class="c_edit member_edit" href="javascript:show('audit')"></a>
								<div style="text-align: center;font-size: 30px;">
									<?php echo e($detail -> audit_name); ?>

									<a target="_blank" class="weibo" href="http://weimob.weibo.com"></a>
								</div>
								<div class="m_position" style="margin-left: 60px;font-size: 18px;"><?php echo e($detail->audit_mobile); ?></div>
								<div class="m_intro" style="text-align: center;font-size: 17px;"><?php echo e($detail -> e_mail); ?></div>
							</div>
							<!-- 编辑创始人 -->
							<div class="member_info newMember dn " id="audit">
								<form class="memberForm" id="audit_form" method="post" action="<?php echo e(route('/')); ?>">
									<?php echo e(csrf_field()); ?>

									<input type="hidden" value="<?php echo e($detail -> id); ?>" id="companyId" name="sid">
									<input type="text" placeholder="请输入负责人姓名" value="<?php echo e($detail -> audit_name); ?>" name="audit_name">
									<input type="text" placeholder="请输入负责人手机号" value="<?php echo e($detail -> mobile); ?>" name="mobile">
									<input type="text" placeholder="请输入负责人邮箱地址" value="<?php echo e($detail -> e_mail); ?>" name="e_mail">
									<input type="text" placeholder="请输入负责身份证号" value="<?php echo e($detail -> Id_number); ?>" name="Id_number">

									<div class="clear"></div>
									<input type="submit" value="保存" class="btn_small">
									<a class="btn_cancel_s member_delete" onclick="changeOut('audit')">取消</a>
									<input type="hidden" value="11493" class="leader_id">
								</form>
							</div>
						</div><!-- end .member_wrap -->
					</dd>
				</dl>
			</div> <!-- end #Member -->

			
			<div id="Category">

				<dl class="c_section c_member">
					<dt>
						<h2><em></em>菜品分类 </h2>
                        <a  class="add_cate">+</a>
					</dt>

					<dd style="padding-top:5px;">
						<?php if(count($menu_cate)): ?>
							<?php $__currentLoopData = $menu_cate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($v -> active ==1 ): ?>
								<a title="菜品分类" class="mc_name" href="<?php echo e(route('merchant.shop.menuCate',['mc_id'=>$v->id])); ?>" >
									<?php echo e($v-> mc_name); ?>

								</a>
								<?php else: ?>
								<a title="菜品分类" class="mc_name mc_unactive" href="<?php echo e(route('merchant.shop.menuCate',['mc_id'=>$v->id])); ?>" >
									<?php echo e($v-> mc_name); ?>

								</a>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php else: ?>
							<div class="member_info">
								<div class="m_intro" style="text-align: center;font-size: 17px;">你还没有分类快去创建吧</div>
							</div>
						<?php endif; ?>
					</dd>

				</dl>

			</div> <!-- end #Member -->
			<div class="clear"></div>
			
			<div id="tg" style="margin-top:40px;">

				<dl class="c_section c_member">
					<dt>
						<h2><em></em>团购礼包 </h2>
						<a  class="add_tuan">+</a>
					</dt>

					<dd style="padding-top:2px;">
						<?php $__empty_1 = true; $__currentLoopData = $tg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
							<?php if($v -> active ==1 ): ?>
								<a title="团购礼包" class="tuan" href="<?php echo e(route('merchant.shop.tuan',['mc_id'=>$v->id])); ?>" >
									<?php echo e($v-> name); ?>

								</a>
							<?php else: ?>
								<a title="团购礼包" class="tuan mc_unactive" href="<?php echo e(route('merchant.shop.tuan',['mc_id'=>$v->id])); ?>" >
									<?php echo e($v-> name); ?>

								</a>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
							<div class="member_info">
								<div class="m_intro" style="text-align: center;font-size: 17px;">你可以创建一个团购购的礼包来吸引用户</div>
							</div>
						<?php endif; ?>
					</dd>

				</dl>

			</div> <!-- end #Member -->
			<div class="clear"></div>
			
			<div class="clear"></div>
			
			<div id="GuestBook" style="margin-top:40px;">
				<!--有创始团队-->
				<dl class="c_section c_member">
					<dt>
						<h2><em></em>用户留言</h2>
					</dt>
					<dd>
						<div class="member_wrap">
							<!-- 显示留言 -->
							<?php $__empty_1 = true; $__currentLoopData = $guestBook; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
								<div class="member_info1" style="">
									<a title="回复留言" class="c_edit member_edit" href="javascript:guestbook('<?php echo e(route('merchant.orders.guestBook',['gid'=>$v->id])); ?>');" ></a>
									<div class="m_intro" style="text-align: center;font-size: 17px;"><?php echo e(mb_substr($v->content,0,15)); ?></div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								<div class="member_info">
									<div class="m_intro" style="text-align: center;font-size: 17px;">暂时没有留言</div>
								</div>
							<?php endif; ?>
						</div><!-- end .member_wrap -->
					</dd>
				</dl>
			</div> <!-- end #Member -->
		</div>
	</div>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    function show(id){
        $('#'+id).show();
    }
    function changeOut(id){
        $('#'+id).css('display','none');
    }
    //店铺信息修改
    $('#editDetailForm').submit(function(){
        me = $(this);
        $.post(me.attr('action'),me.serialize(),function(data){
            if(data.stats ==='ok'){
                layer.msg(data.msg,{icon:6})
            }else{
                layer.msg(data.msg,{icon:5})
            }
        });
        return false;
    });

    //店铺信息详情
    $('#companyDesForm').submit(function(){
        me = $(this);
        $.post('<?php echo e(route('merchant.shop.detailchange')); ?>',me.serialize(),function(data){
            if(data.stats ==='ok'){
                layer.msg(data.msg,{icon:6})
            }else{
                layer.msg(data.msg,{icon:5})
            }
        });
        return false;
    });

    //店铺负责人
    $('#audit_form').submit(function(){
        me = $(this);
        $.post('<?php echo e(route('merchant.shop.auditchange')); ?>',me.serialize(),function(data){
            if(data.stats ==='ok'){
                layer.msg(data.msg,{icon:6})
            }else{
                layer.msg(data.msg,{icon:5})
            }
        });
        return false;
    });

    //商品的激活
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
    //留言弹层
    function guestbook(url){
        layer.open({
            type:2,
            title:'留言详情',
            area:['700px','400px'],
            content:[url]
        })
    }
	//添加商品分类弹层
	$('.add_cate').click(function(){
		layer.open({
			type:2,
			title:'添加分类',
			area:['400px','250px'],
			content:['<?php echo e(route('merchant.shop.addMenuCate',['s_id'=> $detail -> id])); ?>']
		});
		return false;
	})
    //修改商品分类信息弹层
	$('.mc_name').click(function(){
		console.log($(this).attr('href'));
        layer.open({
            type:2,
            title:'修改分类',
            area:['400px','250px'],
            content:[$(this).attr('href')]
        })
		return false;
    });



	//添加团购礼包弹层
	$('.add_tuan').click(function(){
		layer.open({
			type:2,
			title:'添加分类',
			area:['600px','600px'],
			content:['<?php echo e(route('merchant.shop.addTuan',['s_id'=> $detail -> id])); ?>']
		});
		return false;
	})
	//修改团购信息弹层
	$('.tuan').click(function(){
		console.log($(this).attr('href'));
		layer.open({
			type:2,
			title:'修改礼包',
			area:['600px','600px'],
			content:[$(this).attr('href')]
		})
		return false;
	});


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('merchant.public.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>