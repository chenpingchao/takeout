<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width"/>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link type="text/css" href="/Public/css/style.css" rel="stylesheet" />
<script type="text/javascript" src="/Public/js/jQuery-1.8.2.min.js"></script>
<script type="text/javascript" src="/Public/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/Public/js/layer_mobile/layer.js"></script>
<title>登录</title>
</head>

<body>
	<div class="login">
    	<div class="logo"></div>
        <form action="" method="post" id="login">
        <div class="main">
        	<table width="100%" border="0" cellspacing="0" class="mainl">
            	<tr>
                	<td class="text"><input type="text" class="text1" name="username" placeholder="输入手机号或用户名"/>
                        <div class="validate-error"><?php echo ((isset($errors["username"]) && ($errors["username"] !== ""))?($errors["username"]):''); ?></div>
                    </td>
                </tr>
            </table>
            <div class="linee"></div>

			<table width="100%" border="0" cellspacing="0" class="mainl">
                <tr>
                    <td class="text">
                        <input type="password" name="password" class="text1" placeholder="输入密码"/>
                        <div class="validate-error"><?php echo ((isset($errors["password"]) && ($errors["password"] !== ""))?($errors["password"]):''); ?></div>
                    </td>
                </tr>
            </table>
            <div class="linee"></div>

        </div>
        <div class="button"><a href="member.html"><input type="submit" value="登 录" class="text2" /></a></div>
        </form>
    </div>
    <div class="footrt">
    	<div class="footrt_left"><a href="<?php echo U('register');?>">注册新用户</a></div>
        <div class="footrt_right"><a href="<?php echo U('pwdChange');?>">忘记密码？</a></div>
    </div>
</body>

<script>
    $('#login').validate({
        rules:{
            username: {
                required: true,
                minlength: 3,
                maxlength: 15,
            },
            password: {
                required: true,
                minlength: 3,
                maxlength: 15
            }
        },
        messages:{
            username:{
                required:"必须填写用户名" ,
                minlength:"用户名长度小于3位",
                maxlength:"用户名长度大于15位",

            },
            password: {
                required: "必须填写密码" ,
            }
        },
//配置成功提示样式
        errorElement: "div",
        success: function(div) {
            div.addClass("ok").html('验证通过');
        },
        validClass: "ok",
    })

    $('form').submit(function(){
        me =$(this);
        $.ajax({
            url : '',
            type : 'post',
            data : me.serialize(),
            datatype : 'json',
            success:function(data) {
                if (data.status === 'ok') {
                    layer.open({
                        content: '登录成功'
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                        ,success:function(){
                            // location.replace.history.go(-2);
                        }
                    });
                } else {
                    layer.open({
                        content: data.msg
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                    });
                }
            },
        });
        return false
    })
</script>
</html>