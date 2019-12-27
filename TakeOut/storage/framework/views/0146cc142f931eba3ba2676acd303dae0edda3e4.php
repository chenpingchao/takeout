<?php $__env->startSection('header'); ?>
<head>
    <meta charset="utf-8" />
    <title>DeathGhost-注册</title>
    <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
    <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
    <meta name="author" content="DeathGhost"/>
    <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
    <link rel="Shortcut Icon" href="/image/title.ico">
    <script type="text/javascript" src="/home/js/public.js"></script>

    <script type="text/javascript" src="/home/js/jquery.js"></script>
    <script type="text/javascript" src="/home/js/jqpublic.js"></script>
    <script type="text/javascript" src="/home/js/jQuery.1.8.2.min.js"></script>
    <script type="text/javascript"  src="/home/js/layer/layer.js"></script>
    <script type="text/javascript"  src="/home/js/jquery.validate.min.js"></script>
    <style>
        table td{
             position: relative;
             height:40px;
        }
        #form1 input.error{
            border: 1px solid #FF0000;
            background-color: #ffcaca;
        }
        #form1 span.error{
            position: absolute;
            top:11px;
            height:25px;
            line-height: 25px;
            z-index: 10;
            color:red;
            font-weight: bold;
            font-size:12px;
        }
        #form1 span.ok{
            color:green;
        }
    </style>
</head>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<!--Start content-->
<section class="Psection MT20">
    <form action="" method="post" id="form1">
        <?php echo e(csrf_field()); ?>

        <table class="Register">
            <tr>
                <td width="40%" align="right" class="FontW">用户名：</td>
                <td>
                    <input type="text" name="username" required autofocus>
                    <span class="error" style="display: block;"><?php echo e($errors->first('username')); ?></span>
                </td>
            </tr>
            <tr>
                <td width="40%" align="right" class="FontW">密码：</td>
                <td>
                    <input type="password" id="password"  name="password" required>
                    <span class="error" style="display: block;"><?php echo e($errors->first('password')); ?></span>
                </td>
            </tr>
            <tr>
                <td width="40%" align="right" class="FontW">再次确认：</td>
                <td>
                    <input type="password" name="repwd" required>
                    <span class="error" style="display: block;"><?php echo e($errors->first('repwd')); ?></span>
                </td>
            </tr>
            <tr>
                <td width="40%" align="right" class="FontW">手机号码：</td>
                <td>
                    <input type="text" name="mobile" required>
                    <span class="error" style="display: block;"><?php echo e($errors->first('mobile')); ?></span>
                </td>
            </tr>
            <tr>
                <td width="40%" align="right" class="FontW">手机校验码：</td>
                <td>
                    <input type="text" name="msg_code" required>
                    <button type="button" class="yzmBtn" id="yzmBtn" style="background-color:#94df94;width:120px;" onclick="getMsg()">获取短信验证码</button>
                </td>
            </tr>
            <tr>
                <td width="40%" align="right"></td>
                <td><button type="button" name="" id="Submit_b" class="Submit_b" style="background-color:#2d6983;height:30px;width:80px;color:#CCCCCC;">注 册</button>( 已经是会员，<a href="<?php echo e(route('home.login')); ?>" class="BlueA">请登录</a> )</td>
            </tr>
        </table>
    </form>
</section>
<!--End content-->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    var myvalidate=$('#form1').validate({
        //设置验证规则
        rules:{
            username:{
                required:true,
                minlength:2,
                maxlength:15,
                remote:{
                    url:'<?php echo e(route('home.ChkUser')); ?>',
                    type:'post',
                    data:{_token:'<?php echo e(csrf_token()); ?>'}
                }
            },
            password:{
                required:true,
                minlength:4,
                maxlength:15,
            },
            repwd:{
                required:true,
                equalTo:'#password',
            },
            mobile:{
                required:true,
                mobile:true
            },
            msg_code:{
                required:true,
                remote:{
                    url:'<?php echo e(route("home.chkMsg")); ?>',
                    type:'post',
                    data:{_token:'<?php echo e(csrf_token()); ?>'}
                }
            }
        },
        //设置提示信息
        messages:{
            username:{
                required:'用户名不能为空',
                minlength:'用户名最少需要2位',
                maxlength:'用户名至多允许15位',
                remote:'用户名已被占用'
            },
            password:{
                required:'密码不能为空',
                minlength:'密码最少需要4位',
                maxlength:'密码至多允许15位',
            },
            repwd:{
                required:'确认密码不能为空',
                equalTo:'两次密码输入不一致'
            },
            mobile:{
                required:'手机号不能为空',
                mobile:"请正确填写您的手机号码"
            },
            msg_code:{
                required:'手机验证码不能为空',
                remote:'短信验证码错误'
            }
        },
        //配置成功提示样式
        errorElement: "span",
        success: function(span) {
            span.addClass("ok").html('验证通过');
        },
        validClass: "ok"
    });

    //自定义手机号码规则
    jQuery.validator.addMethod("mobile", function(value, element) {  //mobile为自定义规则的名称
        var mobileReg = /^1[34578][0-9]{9}$/;
        return this.optional(element) || (mobileReg.test(value));
    },"请您正确填写您的手机号码");

    //提交表单
    $('.Submit_b').click(function(){   //submit按钮方式提交
        if(myvalidate.form()){ //判断前端验证是否通过
            $.post('<?php echo e(route("home.register")); ?>',$('#form1').serialize(),function(data){
                //判断是否注册成功
                if(data.status === 'ok'){
                    layer.msg(data.msg,{icon:1, time:1000, shade:[0.6]},function(){
                        location.href=data.url;
                    })
                }else{
                    layer.msg(data.msg,{icon:2,time:2000,shade:[0.6]})
                }
            },'json')
        }
    });
//获取短信验证码
    function getMsg(){
        var mobile=$('input[name="mobile"]').val();
        var mobileReg = /^1[34578][0-9]{9}$/;
        if(mobileReg.test(mobile)){
            $.post('<?php echo e(route("home.sendMsg")); ?>', {mobile:mobile,_token:'<?php echo e(csrf_token()); ?>'}, function(msg) {
                // console.log(msg);
                if(msg === '提交成功'){
                    RemainTime();
                }else{
                    layer.tips( msg,'#yzmBtn',{tips:[3,'#FF7113']} );
                }
            })
        }else{
            layer.tips('请输入正确的手机号码','#mobile', {
                tips:[3,'#bb0000']
            });
        }
    }

    //短信倒计时
    var iTime = 30; //倒计时时间
    var Account; //定时器
    function RemainTime(){
        document.getElementById('yzmBtn').disabled = true; //倒计时开始后不能再点击获取验证码
        var iSecond,sSecond = "" , sTime = "";
        if (iTime >= 0){
            iSecond = parseInt(iTime%60);
            iMinute = parseInt(iTime/60);
            if (iSecond >= 0){
                if(iMinute>0){
                    sSecond = iMinute + "分" + iSecond + "秒后重新获取";
                }else{
                    sSecond = iSecond + " 秒后重新获取";
                }
            }
            sTime=sSecond;
            if(iTime === 0){
                clearTimeout(Account);
                sTime = '重新获取验证码';
                iTime = 30;
                document.getElementById('yzmBtn').disabled = false;
            }else{
                Account = setTimeout("RemainTime()",1000);
                iTime = iTime-1;
            }
        }else{
            sTime = '没有倒计时';
        }
        document.getElementById('yzmBtn').innerHTML = sTime;
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.public.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>