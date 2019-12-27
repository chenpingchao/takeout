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
<title>注册</title>
</head>

<body>
	<div class="login">
    	<div class="logo"></div>
        <form action="" method="post" id="register">
            <div class="main">
                <table width="100%" border="0" cellspacing="0" class="main1">
                    <tr>
                        <td class="text">
                            <input type="text" name="username" class="text1" placeholder="输入用户名"/>
                            <div class="validate-error username"></div>
                        </td>
                    </tr>
                </table>
                <div class="linee"></div>
                <table width="100%" border="0" cellspacing="0" class="main1">
                    <tr>
                        <td class="text">
                            <input type="password" name="password" id="password" class="text1" placeholder="输入密码"/>
                            <div class="validate-error repwd"></div>
                        </td>
                    </tr>
                </table>
                <div class="linee"></div>
                <table width="100%" border="0" cellspacing="0" class="main1">
                    <tr>
                        <td class="text">
                            <input type="password" name="repwd" class="text1" placeholder="输入确认密码"/>
                            <div class="validate-error repwd"></div>
                        </td>
                    </tr>
                </table>
                <div class="linee"></div>

                <table width="100%" border="0" cellspacing="0" class="main1">
                    <tr>
                        <td class="text">
                            <input type="text" name="mobile" id="mobile" class="text1" placeholder="输入手机号"/>
                            <div class="validate-error mobile"></div>
                        </td>
                    </tr>
                </table>
                <div class="linee"></div>

                <table width="100%" border="0" cellspacing="0" class="main1">
                    <tr>
                        <td class="text" style="position: relative">
                            <input type="text" name="mobile_code"  class="text1" placeholder="输入短信验证" style="width:200px;"/>
                            <button id="zphone" type="button" class="button1" onClick="get_mobile_code()"> 手机验证 </button>
                            <div class="validate-error"><?php echo ((isset($errors["mobile_code"]) && ($errors["mobile_code"] !== ""))?($errors["mobile_code"]):''); ?></div>
                        </td>
                    </tr>
                </table>
                <div class="linee"></div>
            </div>
            <div class="button"><button class="text2" id="submit">注 册</button></div>
        </form>
    </div>
    <div class="footrt">
    	<div class="footrt_left"><a href="<?php echo U('login');?>">已有账号？立即登录</a></div>
    </div>
</body>
<script>
    $form = $('#register').validate({
        rules:{
            username: {
                required: true,
                minlength: 3,
            },
            password: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            repwd: {
                required: true ,
                equalTo:"#password"
            },
            mobile :{
                required :true,
                mobile : true,
                remote:{
                    url:'<?php echo U("remoteMobile");?>',
                    type:'post',
                }
            },
            mobile_code : {
                required: true,
                remote:{
                    url:'<?php echo U("remoteMobileCode");?>',
                    type:'post',
                }
            },
        },
        messages:{
            username:{
                required:"必须填写用户名" ,
                minlength:"用户名长度小于3位",
            },
            password: {
                required: "必须填写密码" ,
                minlength:"密码长度小于3位",
                maxlength:"密码长度大于15位",
            },
            repwd: {
                required: "必须填写确认密码" ,
                equalTo:"两次密码不一致"
            },
            mobile:{
                required: '手机号码不能为空',
                mobile: "手机号格式不正确",
                remote: "手机号已被占用"
            },
            mobile_code : {
                required:"短信验证码不能为空",
                remote:"验证码不正确"
            },
        },
//配置成功提示样式
        errorElement: "div",
        success: function(div) {
            div.addClass("ok").html('验证通过');
        },
        validClass: "ok",
    });
    $('input').focus(function () {
        $(this).closest('td').find('div').text('');
    });

    //短信验证码
    function get_mobile_code(){
        $.post('<?php echo U("remoteMobile");?>',{mobile:jQuery.trim($('#mobile').val())},function(data){
            if(data == true){
                $.post( '<?php echo U("mobile");?>' ,{mobile:jQuery.trim($('#mobile').val())}, function(msg) {
                    if(msg ==='提交成功'){
                        RemainTime();
                    }else{
                        //	location.reload();
                        layer.open({
                            content: msg,
                            btn: '我知道了',
                            shadeClose: false,
                        });
                    }
                });
            }else{
                return false;
            }
        })
    };
    var iTime = 59;
    var Account;
    function RemainTime(){
        time =$('#zphone')
        time.attr('disabled',true);
        var iSecond,sSecond="",sTime="";
        if (iTime >= 0){
            iSecond = parseInt(iTime%60);
            iMinute = parseInt(iTime/60)
            if (iSecond >= 0){
                if(iMinute>0){
                    sSecond = iMinute + "分" + iSecond + "秒";
                }else{
                    sSecond = iSecond + "秒";
                }
            }
            sTime=sSecond;
            if(iTime==0){
                clearTimeout(Account);
                sTime='短信验证';
                iTime = 59;
                document.getElementById('zphone').disabled = false;
            }else{
                Account = setTimeout("RemainTime()",1000);
                iTime=iTime-1;
            }
        }else{
            sTime='没有倒计时';
        }
        time.text(sTime);
    }


    $('#submit').click(function(){
        if(($form.form() === 'true')){
            return false
        }
        me =$(this);
        $.ajax({
            url : '',
            type : 'post',
            data : $('#register').serialize(),
            datatype : 'json',
            success:function(data) {
                if (data.stats === 'ok') {
                    layer.open({
                        content: '注册成功'
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                    });
                    history.back();
                } else {
                    if(data.status){
                        layer.open({
                            content: data.msg
                            ,skin: 'msg'
                            ,time: 2 //2秒后自动关闭
                        });
                    }
                    $('div.error').html('');
                    if (data) {
                        for (var i in data) {
                            // console.log(data.i);
                            if(i==='username'){
                                $('.username').text(data.username).addClass('error')
                            }else if(i==='password'){
                                $('.password').text(data.password).addClass('error')
                            }else if(i==='repwd'){
                                $('.repwd').text(data.password).addClass('error')
                            }

                        }
                    }
                    return false
                }
            },
        });
        return false
    })
    //手机号码验证
    jQuery.validator.addMethod("mobile", function(value, element) {
        var mobileReg = /^1[34578][0-9]{9}$/;
        return this.optional(element) || (mobileReg.test(value));
    }, "请正确填写您的手机号码");
</script>
</html>