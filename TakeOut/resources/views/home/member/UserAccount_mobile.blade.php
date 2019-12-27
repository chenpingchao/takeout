<!doctype html>
<html lang="en">
    <head>
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
            <form action="" method="post"  id="form0" class="current">
                {{csrf_field()}}
                <table border="0">
                    <tr>
                        <td class="FontW"><label>旧手机号码：</label></td>
                        <td>
                            <input type="text" value="{{$mem->mobile}}" disabled="disabled"  name="oldmobile" id="mobile" placeholder="输出账号绑定的手机号码" />
                        </td>
                    </tr>
                    <tr>
                        <td class="FontW"><label>短信验证码：</label></td>
                        <td>
                            <input type="text"  name="msg_code" class='yzm' placeholder="请输入验证码" />
                            <button type="button" class="yzmBtn" id="yzmBtn1" onclick="getMsg()">获取短信验证码</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="FontW"><label>新手机号码：</label></td>
                        <td>
                            <input type="text" name="mobile" id="mobile" placeholder="输出账号绑定的手机号码" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" id="loginTd" style="text-align-last:center">
                            <a class="loginBtn" id="0" style="background-color:#778899;height:30px;width:80px;color:#CCCCCC;">确认</a>
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>
    <!--End content-->
    </body>
    <script type="text/javascript" src="/home/js/jQuery.1.8.2.min.js"></script>
    <script type="text/javascript"  src="/home/js/layer/layer.js"></script>
    <script type="text/javascript"  src="/home/js/jquery.validate.min.js"></script>
    <script>
        //表单验证配置--手机
        var validate=$('#form0').validate({
            //配置验证规则
            rules:{
                mobile:{
                    required:true,
                    mobile:true
                },
                msg_code:{
                    required:true,
                    remote:{
                        url:'{{route("home.chkMsg")}}',
                        type:'post',
                        data:{_token:'{{csrf_token()}}'}
                    }
                }
            },
            //配置提示信息
            messages:{
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
            errorElement: "div",
            success: function(div) {
                div.addClass("ok").html('验证通过');
            },
            validClass: "ok"
        });
        //自定义手机号码规则
        jQuery.validator.addMethod("mobile", function(value, element) {  //mobile为自定义规则的名称
            var mobileReg = /^1[34578][0-9]{9}$/;
            return this.optional(element) || (mobileReg.test(value));
        },"请您正确填写您的手机号码");

        //提交表单
        $('.loginBtn').click(function(){   //submit按钮方式提交
            if(validate.form()){ //判断前端验证是否通过
                $.post('{{route("hm.mem.UserAccount_mobile")}}',$('#form0').serialize(),function(data){
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

        //获取短信验证码
        function getMsg(){
            var username = $('#username1').val()
            var mobile=$('input[name="oldmobile"]').val();
            var mobileReg = /^1[34578][0-9]{9}$/;
            if(mobileReg.test(mobile)){
                $.post('{{route("home.sendMsg")}}', {username:username,mobile:mobile,_token:'{{csrf_token()}}'}, function(msg) {
                    // console.log(msg);
                    if(msg === '提交成功'){
                        RemainTime();
                    }else{
                        layer.tips( msg,'#yzmBtn1',{tips:[3,'#FF7113']} );
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
            var yzmBtn=document.getElementById('yzmBtn1')
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
