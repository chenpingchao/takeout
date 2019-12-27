

<?php $__env->startSection('header'); ?>

	<link href="/merchant/style/css/style.css" type="text/css" rel="stylesheet">
	<link href="/merchant/style/css/external.min.css" type="text/css" rel="stylesheet">
	<link href="/merchant/style/css/popup.css" type="text/css" rel="stylesheet">



	<script type="text/javascript" src="/merchant/style/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="/merchant/style/js/jquery.form.js"></script>
	<script type="text/javascript" src="/merchant/style/js/ajaxfileupload.js"></script>
	<script src="/merchant/style/js/jquery.lib.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/merchant/style/kindeditor/kindeditor-all.js"></script>
	<script src="/merchant/style/js/ajaxCross.json" charset="UTF-8"></script>
	<link rel="stylesheet" href="/merchant/style/css/preview.css">
	<script src="/js/preview/preview.js"></script>
	<script src="/merchant/style/js/geo.js" charset="UTF-8" type="text/javascript"></script>

	<!--[if lte IE 8]>

	<![endif]-->
	<script type="text/javascript">
		var youdao_conv_id = 271546;
	</script>

	<style type=text/css>
		input.error { border: 1px solid #EA5200;background: #ffdbb3;}
		div.error {
			background:url("/image/error.png") no-repeat 5px 2px;
			padding-left: 22px;
			padding-bottom: 2px;
			font-weight: bold;
			color: #EA5200;
			vertical-align: middle
		}
		div.ok {
			background:url("/image/ok.png") no-repeat 5px 2px;
			color: #6aea4c;
		}
	</style>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('main'); ?>

    <div id="container">

  		<div style="" id="stepTip">
       		<a></a>
       		<img width="803" height="59" src="/merchant/style/images/tiponce.jpg">
       	</div>
        <div class="content_mid">
        	<dl class="c_section c_section_mid">
                <dt>
                    <h2><em></em>填写店铺信息</h2>
                </dt>
                <dd>
	                <form id="stepForm"  method="post" enctype="multipart/form-data">
						<?php echo e(csrf_field()); ?>

	                	<div class="c_text_1">基本信息为必填项，是顾客加速了解店铺的窗口，认真填写吧！</div>

	                    <h3>店铺名称 </h3>
	                    <input type="text" placeholder="请输入店铺名称" value="" name="shop_name" id="name" class="valid">
						<div class="image shop_name"></div>

	                    <h3>店铺LOGO</h3> <!--非必填改必填-->
	                   	<div class="c_logo c_logo_pos">
							<div class="preview-div">
								<label for="pic" class="preview-label">店铺LOGO</label>
								<input type="file" id="pic" name="logo" onchange="preview(this,200,200)" class="preview-input">
								<img src="" alt="" >
							</div>
	                    </div>

	                    <h3>所在城市</h3>
							<select name="province" id="s1"></select>
							<select name="city" id="s2"></select>
							<select name="town" id="s3"></select>

						<h3>店铺地址</h3>
						<input type="text" placeholder="请输入店铺的详细地址" value="" name="website" id="website">
						<div class="image website"></div>

						<h3>店铺电话</h3>
						<input type="text" placeholder="请输入店铺的电话" value="" name="shop_mobile" id="shop_mobile">
						<div class="image shop_mobile"></div>

						<h3>店铺负责人姓名</h3>
						<input type="text" placeholder="请输入店铺负责人姓名" value="" name="audit_name" id="audit_name">
						<div class="image audit_name"></div>

						<h3>店铺负责人电话</h3>
						<input type="text" placeholder="请输入店铺负责人电话" value="" name="audit_mobile" id="audit_mobile">
						<div class="image audit_mobile"></div>

						<h3>店铺邮箱</h3>
						<input type="text" placeholder="请输入店铺邮箱" value="" name="e_mail" id="e_mail">
						<div class="image e_mail"></div>

						<h3>店铺负责人身份证号码</h3>
						<input type="text" maxlength="18" placeholder="请输入店铺负责人身份证号码" value="" name="Id_number" id="Id_number">
						<div class="image Id_number"></div>

						<h3>店铺大图</h3> <!--非必填改必填-->
						<div class="c_logo c_logo_pos">
							<div class="preview-div">
								<label for="image" class="preview-label">店铺大图</label>
								<input type="file" id="image" name="image" onchange="preview(this,440,310)" class="preview-input">
								<img src="" alt="" >
							</div>
						</div>

	                    <h3>店铺介绍</h3>
						<textarea  name="detail" id="temptation"  cols="30" rows="10"></textarea>

	                    <span style="display:none;" class="error" id="beError"></span>

	                    <input type="submit" value="创建店铺" id="stepBtn" class="btn_big fr">
	                </form>
                </dd>
            </dl>
       	</div>

<!------------------------------------- end ----------------------------------------->

			<div class="clear"></div>
			<input type="hidden" value="13ae35fedd9e45cdb66fb712318d7369" id="resubmitToken">
	    	<a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
	    </div><!-- end #container -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<script>

		$(document).ready(function(e) {
			//加载富文本编辑器
			KindEditor.ready(function(K) {
				K.create('#temptation', {
					allowFileManager : true,
					filterMode:true,
					afterBlur:function(){
						this.sync("#temptation");
					}
				});
			});
		});


		var avatar = {};
		avatar.uploadComplate = function( data ){
			var result = eval('('+ data +')');
			if(result.success){
				jQuery('#logoShow img').attr("src",ctx+ '/'+result.content);
				jQuery.colorbox.close();
				jQuery('#logoNo').hide();
				jQuery('#logoShow').show();
			}
		};


		//省市县三级联动
		setup();
		preselect('河南省');
		document.getElementById('s2').value='郑州市';
		document.getElementById('s2').onchange();
		document.getElementById('s3').value='中原区';


		//表单验证
		var s = $("#stepForm").validate({
			rules:{
				shop_name:{
					required:true,
					minlength:4,
					maxlength:20,
				},
				logo:{
					required:true,
				},
				website:{
					required:true,
				},
				shop_mobile:{
					required:true,
					number:true,
					mobile1:true,
					remote:{
						url:"<?php echo e(route('merchant.shop.shopMobile')); ?>",
						type:'post',
						data:{ _token:'<?php echo e(csrf_token()); ?>' }
					}
				},
				audit_name:{
					required:true,
				},
				audit_mobile:{
					required:true,
					number:true,
					mobile2:true,
					remote:{
						url:"<?php echo e(route('merchant.shop.auditMobile')); ?>",
						type:'post',
						data:{_token:'<?php echo e(csrf_token()); ?>' }
					}
				},
				e_mail:{
					email:true,
				},
				Id_number:{
					required:true,
					Id_number:true,
				}
			},
			messages:{
				shop_name:{
					required:'必须有店铺名',
					minlength:'店铺名长度在4个汉字以上',
					maxlength:'店铺名不能超过20个汉字',
				},
				logo:{
					required:'logo必须选择',
				},
				website:{
					required:'店铺地址必须填写',
				},
				shop_mobile:{
					required:'店铺电话不能为空',
					number:'手机号必需为数字',
					mobile1:'请正确填写手机号码',
					remote:'手机号已存在'
				},
				audit_name: {
					required:'店铺负责人姓名不能为空'
				},
				audit_mobile:{
					required:'店铺负责人电话不能为空',
					number:'手机号必需为数字',
					mobile2:'请正确填写手机号码',
					remote:'手机号已存在'
				},
				e_mail:{
					email:'邮箱格式不正确',
				},
				Id_number:{
					required:'身份证号不能为空',
					Id_number:'请正确填写身份证号'
				}
			},
			errorElement: "div",
			success: function(div) {
				div.addClass("ok").html('验证成功');
			},
			validClass: "ok"
		});
		//验证手机号码
		jQuery.validator.addMethod("mobile1", function(value, element) {
			var mobileReg = /^1[34578][0-9]{9}$/;
			return this.optional(element) || (mobileReg.test(value));
		}, "请正确填写手机号码");
		jQuery.validator.addMethod("mobile2", function(value, element) {
			var mobileReg = /^1[34578][0-9]{9}$/;
			return this.optional(element) || (mobileReg.test(value));
		}, "请正确填写手机号码");

		//验证身份证号
		jQuery.validator.addMethod("Id_number", function(value, element) {
			var mobileReg = /^[0-9]{18}$/;
			return this.optional(element) || (mobileReg.test(value));
		}, "请正确身份证号");

		$('#stepForm').submit(function(){
            //判断地址是否选中
            if( $('#s1').val() === '省份' ){
                layer.msg('请选择省份',{icon:5,time:1300},function(){
                    return false
                })
            }else if( $('#s2').val() === '地级市' ){
                layer.msg('请选择地级市',{icon:5,time:1300},function(){
                    return false
                })
            }else if( $('#s3').val() === '市、县级市、县' ){
                layer.msg('请选择市、县级市、县',{icon:5,time:1300},function(){
                    return false
                })
            }

            if(s.form()){
				//提交
				me = $(this);
				me.ajaxSubmit({
					success:function(data){
						if(data.stats === 'ok'){
							layer.msg(data.msg,{icon:6,shade:[0.6],time:1500},function(){
								location = data.url;
							})
						}else{
							layer.msg(data.msg,{icon:6,shade:[0.6],time:2500})
						}
					},
					error:function (xhr) {
						var errors = JSON.parse(xhr.responseText).errors;
						//清空前台表单验证
						$('div.image').html('');

						//将错误信息写入表单
						for(var i in errors){
							$('.'+i).text(errors[i][0]).addClass('error')

						}
					}
				});
			}
			return false;
		})
	


	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('merchant.public.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>