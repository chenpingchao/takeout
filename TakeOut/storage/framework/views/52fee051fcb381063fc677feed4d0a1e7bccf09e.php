<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>欢迎登录</title>
    <link href="/home/loginCart/default/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/home/loginCart/default/js/jquery.js"></script>
    <script src="/home/loginCart/default/js/cloud.js" type="text/javascript"></script>
    <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/home/js/public.js"></script>
    <script type="text/javascript" src="/home/js/jquery.js"></script>
    <script type="text/javascript" src="/home/js/jquery.js"></script>
    <script type="text/javascript" src="/home/js/jqpublic.js"></script>

</head>

<body style="background-color:#1c77ac; background-image:url(/home/images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">

<div id="mainBody">
    <div id="cloud1" class="cloud"></div>
    <div id="cloud2" class="cloud"></div>
</div>

<div class="logintop">
    <span>欢迎登录</span>
    <ul>
        <li><a href="#">回首页</a></li>
        <li><a href="#">帮助</a></li>
        <li><a href="#">关于</a></li>
    </ul>
</div>

<div class="loginbody">
    <span class="systemlogo"></span>
    <div class="loginbox loginbox1">
        <form action="<?php echo e(route('home.login')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <ul>
                <li>
                    <input name="username" type="text" class="loginuser" placeholder="用户名"  />
                    <span class="error" style="display: block;"><?php echo e($errors->first('username')); ?></span>
                </li>
                <li>
                    <input name="password" type="password" class="loginpwd" placeholder="密　码" />
                    <span class="error" style="display: block;"><?php echo e($errors->first('password')); ?></span>
                </li>

                <li class="yzm">
                    <div id="embed-captcha" style="text-align:center;margin:20px auto;">正在加载验证码......</div>
                </li>
                <li>
                    <input type="submit" class="loginbtn" value="登录"   />
                    <!--                    <label><input name="" type="checkbox" value="" checked="checked" />记住密码</label>-->
                </li>
                <li>

                    ( 未注册会员，<a href="<?php echo e(route('home.register')); ?>" class="BlueA">请注册.</a>
                    忘记密码？<a href="#"  onclick="findPassword()" class="BlueA">找回密码</a> )
                </li>
            </ul>
        </form>
    </div>
</div>

</body>
<script language="javascript">
    $(function(){
        $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
        $(window).resize(function(){
            $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
        })
    });

    //极验
    var handlerEmbed = function (captchaObj) {
        // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
        captchaObj.onReady(function () {
            $("#embed-captcha").empty();
        });
        captchaObj.appendTo("#embed-captcha");

    };
    //行为验证
    function geetest(){
        $.ajax({
            // 获取id，challenge，success（是否启用failback）
            url: "<?php echo e(route('home.geetest')); ?>"+"?id="+Math.random(), // 加随机数防止缓存
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

    //表单验证配置
    var myvalidate = $('#form1').validate({
        ignore:[],
        rules:{
            username:{  //规则名称是表单元素的name属性值
                required:true
            },
            password:{
                required:true
            }
        },
        messages:{
            username:{  //规则名称是表单元素的name属性值
                required:'用户名不能为空'
            },
            password:{
                required:'密码不能为空'
            }
        },
        //配置成功提示样式
        errorElement:"span",
        success:function (span) {
            span.addClass('ok').html('验证通过');
        },
        validClass:'ok',
    });

    //表单提交 异步登录
    //异步登录
    $('.loginbtn').click(function(captchaObj){
        if(myvalidate.form()) { //判断前端验证是否通过
            $.post('<?php echo e(route("home.login")); ?>', $('#form1').serialize(), function (data) {
                //判断是否登录成功
                if (data.status === 'ok') {
                    layer.msg(data.msg, { icon: 1, time: 1000, shade: [0.6] }, function(){
                        location = data.url;
                    })
                } else {
                    layer.tips(data.msg, '#embed-captcha', {
                        tips: [2, '#f00'],
                        end: function () {
                            geetest();
                        }
                    })
                }
            }, 'json')
        }

        return false;
    });



</script>
</html>

