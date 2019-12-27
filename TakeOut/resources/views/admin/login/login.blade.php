<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="Shortcut Icon" href="/image/title.ico">
		<link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="/admin/assets/css/font-awesome.min.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="/admin/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
		<link rel="stylesheet" href="/admin/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="/admin/assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="/admin/css/style.css"/>
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="/admin/assets/js/ace-extra.min.js"></script>
		<!--[if lt IE 9]>
		<script src="/admin/assets/js/html5shiv.js"></script>
		<script src="/admin/assets/js/respond.min.js"></script>
		<![endif]-->
		<script src="/admin/js/jquery-1.9.1.min.js"></script>
        <script src="/admin/assets/layer/layer.js" type="text/javascript"></script>
<title>登陆</title>
</head>
<body class="login-layout Reg_log_style">
<div class="logintop">    
    <span>欢迎后台管理界面平台</span>    
    <ul>
    <li><a href="#">返回首页</a></li>
    <li><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
    </ul>    
    </div>
    <div class="loginbody">
		<div class="login-container">
			<div class="center">
				 <img src="/admin/images/logo1.png" />
			</div>
			<div class="space-6"></div>
			<div class="position-relative">
				<div id="login-box" class="login-box widget-box no-border visible">
					<div class="widget-body">
						<div class="widget-main">
							<h4 class="header blue lighter bigger">
								<i class="icon-coffee green"></i>
									管理员登陆
							</h4>
							<div class="login_icon"><img src="/admin/images/login.png" /></div>

							<form action="" method="post">
								<fieldset>
									{{csrf_field()}}
									<ul>
									   <li class="frame_style form_error">
										   <label class="user_icon"></label>
										   <input name="username" type="text" placeholder="用户名"  id="username"/>
									   </li>
									   <li class="frame_style form_error">
										   <label class="password_icon"></label>
										   <input name="password" type="password" placeholder="密码"   id="userpwd"/>
									   </li>
									   <li class="frame_style form_error">
										   <label class="Codes_icon"></label>
										   <input name="captcha" type="text" placeholder="验证码"  id="Codes_text"/>
										   <div class="Codes_region">
											   <img src="{{route("bg.captcha")}}" alt="验证码" onclick="this.src='{{route("bg.captcha")}}?num='+Math.random()">
										   </div>
									   </li>
									</ul>
										<div class="space"></div>
											<div class="clearfix">
												<label class="inline">
													<input type="checkbox" class="ace">
														<span class="lbl">保存密码</span>
												</label>
												<button type="button" class="width-35 pull-right btn btn-sm btn-primary" id="login_btn">
													<i class="icon-key"></i>
														登陆
												</button>
											</div>
											<div class="space-4"></div>
								</fieldset>
							</form>

								<div class="social-or-login center">
									<span class="bigger-110">通知</span>
								</div>
								<div class="social-login center">
									本网站系统不再对IE8以下浏览器支持，请见谅。
								</div>
						</div><!-- /widget-main -->
						<div class="toolbar clearfix">
						</div>
					</div><!-- /widget-body -->
				</div><!-- /login-box -->
			</div><!-- /position-relative -->
		</div>
	</div>
<div class="loginbm">版权所有  2016  <a href="">南京思美软件系统有限公司</a></div><strong></strong>
</body>
</html>
<script>
	//异步登录
	$('#login_btn').click(function(){
		//执行异步请求
		$.post("{{route('bg')}}",$('form').serialize(),function(data){
			// console.log(data);
			if( data.status == 'ok' ){
				layer.msg(data.msg, {icon:6,shade:[0.6],time:2000}, function(){
					location = data.url;
				})
			}else{
				layer.msg(data.msg, {icon:5,shade:[0.6]});
			}
		},'json');
	})
</script>