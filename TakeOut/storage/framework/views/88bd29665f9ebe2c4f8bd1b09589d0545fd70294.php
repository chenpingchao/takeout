<!DOCTYPE HTML>
<html>
<head>
<script type="text/javascript">
	var ctx = "h";
	// console.log(1);
	var youdao_conv_id = 271546;
</script>
<script id="allmobilize" charset="utf-8" src="/merchant/style/js/allmobilize.min.js"></script>
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="alternate" media="handheld"  />
<!-- end 云适配 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>外卖美食</title>
<meta property="qc:admins" content="23635710066417756375" />
<meta content="" name="description">
<meta content="" name="keywords">
<meta name="baidu-site-verification" content="QIQ6KC1oZ6" />
<!-- <div class="web_root"  style="display:none">h</div> -->
	<link rel="Shortcut Icon" href="/image/title.ico">
<link rel="stylesheet" type="text/css" href="/merchant/style/css/style.css"/>

<script src="/merchant/style/js/jquery.1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/merchant/style/js/jquery.lib.min.js"></script>
<script type="text/javascript" src="/merchant/style/js/core.min.js"></script>
<script type="text/javascript" src="/merchant/style/js/conv.js"></script>
<script type="text/javascript" src="/js/gt.js"></script>
<script type="text/javascript" src="/js/layer/layer.js"></script>
</head>

<body id="login_bg">
	<div class="login_wrapper">
		<div class="login_header">
        	<a href="h/"><img src="/image/merchantLogo.png" width="285" height="62" alt="拉勾招聘" /></a>
            <div id="cloud_s"><img src="/merchant/style/images/cloud_s.png" width="81" height="52" alt="cloud" /></div>
            <div id="cloud_m"><img src="/merchant/style/images/cloud_m.png" width="136" height="95"  alt="cloud" /></div>
        </div>
        
    	<input type="hidden" id="resubmitToken" value="" />		
		 <div class="login_box">
        	<form id="loginForm" action="" method="post">
				<?php echo e(csrf_field()); ?>

                <input type="text" id="email" name="name" value="" tabindex="1" placeholder="请输入昵称或手机号码" />
			  	<input type="password" id="password" name="password" tabindex="2" placeholder="请输入密码" />
				<span class="error" style="display:none;" id="beError"></span>
				<div id="embed-captcha" style="text-align:center">正在加载验证码......</div>
			    <label class="fl" for="remember"><input type="checkbox" id="remember" value="" checked="checked" name="autoLogin" /> 记住我</label>
			    <a href="reset.html" class="fr" target="_blank">忘记密码？</a>
			    
				<!--<input type="submit" id="submitLogin" value="登 &nbsp; &nbsp; 录" />-->
				<a style="color:#fff;" href="<?php echo e(route('merchant.login')); ?>" class="submitLogin" target="_self" title="登 &nbsp; &nbsp; 录"/>登 &nbsp; &nbsp; 录</a>

			    
			    <input type="hidden" id="callback" name="callback" value=""/>
                <input type="hidden" id="authType" name="authType" value=""/>
                <input type="hidden" id="signature" name="signature" value=""/>
                <input type="hidden" id="timestamp" name="timestamp" value=""/>
			</form>
			<div class="login_right">
				<div>还没有拉勾帐号？</div>
				<a  href="<?php echo e(route('merchant.register')); ?>"  class="registor_now">立即注册</a>
			    <div class="login_others">使用以下帐号直接登录:</div>
			    <a  href="h/ologin/auth/sina.html"  target="_blank" class="icon_wb" title="使用新浪微博帐号登录"></a>
			    <a  href="h/ologin/auth/qq.html"  class="icon_qq" target="_blank" title="使用腾讯QQ帐号登录"></a>
			</div>
        </div>
        <div class="login_box_btm"></div>
    </div>

<script type="text/javascript">
$(function(){
	//验证表单
		formValidate = $("#loginForm").validate({
	 		/* onkeyup: false,
	    	focusCleanup:true, */
	        rules: {
	    	   	name: {
	    	    	required: true,
	    	   	},
	    	   	password: {
	    	    	required: true,
					rangelength:[6,16],
	    	   	},

	    	},
	    	messages: {
	    	   	name: {
	    	    	required: "请输入昵称或手机号",
	    	   	},
	    	   	password: {
	    	    	required: "请输入密码",
					rangelength:'请输入6到16位密码',
	    	   	}
	    	},
	    	submitHandler:function(form){
	    		if($('#remember').prop("checked")){
	      			$('#remember').val(1);
	      		}else{
	      			$('#remember').val(null);
	      		}
	    		var name = $('#name').val();
	    		var password = $('#password').val();
	    		var remember = $('#remember').val();
	    		
	    		var callback = $('#callback').val();
	    		var authType = $('#authType').val();
	    		var signature = $('#signature').val();
	    		var timestamp = $('#timestamp').val();
	    		
	    		$(form).find(":submit").attr("disabled", true);
	            $.ajax({
	            	type:'POST',
	            	data:{name:name,password:password,autoLogin:remember, callback:callback, authType:authType, signature:signature, timestamp:timestamp},
	            	url:ctx+'/user/login.json'
	            }).done(function(result) {
					if(result.success){
					 	if(result.content.loginToUrl){
							window.location.href=result.content.loginToUrl;
	            		}else{
	            			window.location.href=ctx+'/';
	            		} 
					}else{
						$('#beError').text(result.msg).show();
					}
					$(form).find(":submit").attr("disabled", false);
	            }); 
	        }  
		});
})
	var handlerEmbed = function (captchaObj) {
	// 将验证码加到id为captcha的元素里，会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
		captchaObj.appendTo("#embed-captcha");
		captchaObj.onReady(function () {
			$("#embed-captcha").empty();
		});
	};

function geetest(){
	$.ajax({
		url: "<?php echo e(route('merchant.geetest')); ?>" + "/"+Math.random(), // 加随机数防止缓存
		type: "get",
		dataType: "json",
		success: function (data) {
			// 使用initGeetest接口
			// 参数1：配置参数
			// 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
			initGeetest({
				gt: data.gt,
				challenge: data.challenge,
				new_captcha: data.new_captcha,
				width:'260px',
				product: "embed", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
				offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
			}, handlerEmbed);
		}
	})
}

geetest();


//异步登录
	$(".submitLogin").click(function(){
		if(formValidate.form()) {
            $.ajax({
                url: '',
                type: 'post',
                data: $("#loginForm").serialize(),
                datatype: 'json',
                success: function (data) {
                    if (data.stats === 'ok') {
                        layer.msg(data.msg, {icon: 6, shade: [0.6],time:2000});
                        location = data.url;
                    } else {
                        layer.msg(data.msg, {icon: 5, shade: [0.6]})
                    }
                },
                error: function (xhr) {
                    //获取错误信息
                    //隐藏表单盒子
                    $('.image').css('disable', 'none');
                    var error = JSON.parse(xhr.responseText).errors;
                    $('div.validate-error').html('');
                    if (error) {
                        for (var i in error) {
                            $('#' + i).text(error[i][0])
                        }
                    }
                }
            });
        }
		return false;
	});


</script>
</body>
</html>