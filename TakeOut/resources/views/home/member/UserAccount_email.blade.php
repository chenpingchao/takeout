<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta charset="utf-8" />
        <title>DeathGhost-登录</title>
        <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
        <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
        <meta name="author" content="DeathGhost"/>
        <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/home/js/public.js"></script>
        <script type="text/javascript" src="/home/js/jquery.js"></script>
        <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
        <script type="text/javascript" src="/home/js/jqpublic.js"></script>
        <link rel="stylesheet" type="text/css" href="/home/style/register.css">
        <style>
            div.regArea{
                margin:0 auto;
                width: 360px;
                height: 290px;
                background-color: #FfF5DC;
            }
            div.regRight{
                border:0;
                background-color: #DCDCDC;
                height:265px;
            }
            .tab dd{
                float:left;
                width:145px;
                padding:8px 2px;
                text-align: center;
                color:#000;
                font-weight: bold;
                cursor:pointer;
            }
            .regRight form.current{
                display: block;
            }

            table td{
                position: relative;
                height:40px;
            }
            table td:first-child{
                text-align-last: justify;
            }
            form input.error{
                border: 1px solid #FF0000;
                background-color: #ffcaca;
            }
            form div.error{
                position: absolute;
                top:48px;
                height:25px;
                line-height: 25px;
                z-index: 10;
                color:red;
                font-weight: bold;
                font-size:12px;
            }
            form div.ok{
                color:green;
            }
        </style>
    </head>
<body>
    <!--Start content-->
    <div class="regArea">
        <div class="regRight" >
            <form action="" method="post"  id="form1" class="current">
                {{csrf_field()}}
                <table border="0">
                    <tr>
                        <td class="FontW"><label>旧邮箱地址：</label></td>
                        <td>
                            <input type="text" value="{{$mem->email}}" name="oldemail" id="email"  disabled="disabled"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="FontW"><label>验证码：</label></td>
                        <td>
                            <input type="text"  name="msg_code" class='yzm' placeholder="请输入验证码" />
                            <button type="button" class="yzmBtn" id="yzmBtn2" onclick="getMail()">获取邮件</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="FontW"><label>邮箱地址：</label></td>
                        <td>
                            <input type="text" name="email" id="email" placeholder="可以账号绑定的邮箱地址" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" id="loginTd" style="text-align-last:center">
                            <a class="loginBtn" id="1" style="background-color:#778899;height:30px;width:80px;color:#CCCCCC;">确认</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
    <script type="text/javascript" src="/home/js/jQuery.1.8.2.min.js"></script>
    <script type="text/javascript"  src="/home/js/layer/layer.js"></script>
    <script type="text/javascript"  src="/home/js/jquery.validate.min.js"></script>
    <script>
        //表单验证配置--邮箱
        var validate=$('#form1').validate({
            //配置验证规则
            rules:{
                email:{
                    required:true,
                    email:true
                },
                msg_code:{
                    required:true,
                    remote:{
                        url:'{{url("home.chkMail")}}',
                        type:'post',
                        data:{_token:'{{csrf_token()}}'}
                    }
                }
            },
            //配置提示信息
            messages:{
                email:{
                    required:'邮箱不能为空',
                    email:"请正确填写您的邮箱号码"
                },
                msg_code:{
                    required:'邮箱验证码不能为空',
                    remote:'邮箱验证码错误'
                }
            },
            //配置成功提示样式
            errorElement:'div',
            success:function (div) {
                div.addClass('ok').html('验证通过');
            },
            validClass: 'ok'

        });

        //提交表单
        $('.loginBtn').click(function(){   //submit按钮方式提交
            if(validate.form()){ //判断前端验证是否通过
                $.post('{{route("hm.mem.UserAccount_email")}}',$('#form1').serialize(),function(data){
                    //判断是否注册成功
                    if(data.status === 'ok'){
                        layer.msg(data.msg,{icon:1, time:1000, shade:[0.6]},function(){
                            parent.layer.closeAll();
                            location = '{{route("hm.mem.UserAccount")}}';
                        })
                    }else{
                        layer.msg(data.msg,{icon:2,time:2000,shade:[0.6]})
                    }
                },'json')
            }
        });

        //邮箱短信验证码
        function getMail(){
            var username = $('#username2').val()
            var email=$('input[name="oldemail"]').val();
            var mobileReg = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
            if(mobileReg.test(email)){
                $.post('{{route("home.sendMail")}}', {username:username,email:email,_token:'{{csrf_token()}}'}, function(data) {
                    // console.log(data);
                    if(data.status === 'ok') {
                        RemainTime();
                    }else if(data.status === 'error'){
                        layer.tips(data.msg,'#email', {tips:[3,'#bb0000']});
                    }else{
                        layer.tips( data.msg,'#yzmBtn2',{tips:[3,'#FF7113']} );
                    }
                })
            }else{
                layer.tips('请输入正确的邮箱号码','#email', {
                    tips:[3,'#bb0000']
                });
            }
        }
        //短信倒计时
        var iTime = 30; //倒计时时间
        var Account; //定时器
        function RemainTime(){
            var yzmBtn=document.getElementById('yzmBtn2')
            yzmBtn.disabled = true;
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
                    yzmBtn.disabled = false;
                }else{
                    Account = setTimeout("RemainTime()",1000);
                    iTime = iTime-1;
                }
            }else{
                sTime = '没有倒计时';
            }
            yzmBtn.innerHTML = sTime;
        }
    </script>
</html>
