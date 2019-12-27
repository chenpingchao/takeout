@extends('home.public.public')
{{--截取头部--}}
@section('header')
    <head>
        <meta charset="utf-8" />
        <title>DeathGhost-登录</title>
        <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
        <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
        <meta name="author" content="DeathGhost"/>
        <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
        <link rel="Shortcut Icon" href="/image/title.ico">
        <script type="text/javascript" src="/home/js/public.js"></script>
        <script type="text/javascript" src="/home/js/jquery.js"></script>
        <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
        <script type="text/javascript" src="/home/js/jqpublic.js"></script>
        <link rel="stylesheet" type="text/css" href="/home/style/register.css">
        <style>
            div.regArea{
                margin:0 auto;
                width: 360px;
                height: 450px;
                background-color: #FfF5DC;
            }
            div.regRight{
                border:0;
                background-color: #DCDCDC;
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

            .tab dd.active{
                border-bottom:2px solid #fdd0ac;
            }
            .display{
                display: none;
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
@endsection
{{--截取主体--}}
@section('main')
    <!--Start content-->
    <div class="regArea">
        <div class="regRight" >
            <dl class="tab">
                <dd class="active">手机找回密码</dd>
                <dd>邮箱找回密码</dd>
            </dl>
            <form action="" method="post"  id="form0" class="current">
                {{csrf_field()}}
                <table border="0">
                    <tr>
                        <td class="FontW"><label>用户名：</label></td>
                        <td>
                            <input type="text" name="username" id="username1" placeholder="请输入用户名"    />
                        </td>
                    </tr>

                    <tr>
                        <td class="FontW"><label>手机号码：</label></td>
                        <td>
                            <input type="text" name="mobile" id="mobile" placeholder="输出账号绑定的手机号码" />
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
                        <td class="FontW"><label>密码：</label></td>
                        <td>
                            <input type="password" name="password" id="pwd1" placeholder="请输入密码" />
                        </td>
                    </tr>
                    <tr>
                        <td class="FontW"><label>确认密码：</label></td>
                        <td>
                            <input type="password" name="repwd"  placeholder="请再次输入密码" />
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" id="loginTd" style="text-align-last:center">
                            <a class="loginBtn" id="0" style="background-color:#778899;height:30px;width:80px;color:#CCCCCC;">确认</a>
                        </td>
                    </tr>

                </table>
            </form>
            <form action="" method="post"  id="form1" class="current" style="display: none">
                {{csrf_field()}}
                <table border="0">
                    <tr>
                        <td class="FontW"><label>用户名：</label></td>
                        <td>
                            <input type="text" name="username" id="username2" placeholder="请输入用户名"    />
                        </td>
                    </tr>

                    <tr>
                        <td class="FontW"><label>邮箱地址：</label></td>
                        <td>
                            <input type="text" name="email" id="email" placeholder="可以账号绑定的邮箱地址" />
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
                        <td class="FontW"><label>密码：</label></td>
                        <td>
                            <input type="password" name="password" id="pwd2" placeholder="请输入密码" />
                        </td>
                    </tr>
                    <tr>
                        <td class="FontW"><label>确认密码：</label></td>
                        <td>
                            <input type="password" name="repwd"  placeholder="请再次输入密码" />
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
    <!--End content-->
@endsection
<!--另起炉灶-->
@section('script')
    <script type="text/javascript" src="/home/js/jQuery.1.8.2.min.js"></script>
    <script type="text/javascript"  src="/home/js/layer/layer.js"></script>
    <script type="text/javascript"  src="/home/js/jquery.validate.min.js"></script>
    <script>
        //选项卡
        $('.tab dd').click(function(){
            //划过哪个选项，哪个选项高亮显示 ，而其它的选项取消高亮显示
            $(this).addClass('active').siblings('dd').removeClass('active');
            //取出划过选项卡的下标
            var i=$(this).index();
            // console.log($('#form'+i));
            //通过下标找到对应的商品
            $('#form'+i).css('display','block').siblings('form').css('display','none');


        });
    </script>
    <script>
        //表单验证配置--手机
        var myvalidate0=$('#form0').validate({
            //配置验证规则
            rules:{
                username:{  //规则名称是表单元素的name属性值
                    required:true
                },
                password:{
                    required:true,
                    minlength:4,
                    maxlength:15
                },
                repwd:{
                    required:true,
                    equalTo:'#pwd1'
                },
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
                username:{  //规则名称是表单元素的name属性值
                    required:'用户名不能为空',
                },
                password:{
                    required:'密码不能为空',
                    minlength:'密码至少需要4个字符',
                    maxlength:'密码最多允许15个字符'
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
            errorElement: "div",
            success: function(div) {
                div.addClass("ok").html('验证通过');
            },
            validClass: "ok"
        });
        //表单验证配置--邮箱
        var myvalidate1=$('#form1').validate({
            //配置验证规则
            rules:{
                username:{  //规则名称是表单元素的name属性值
                    required:true
                },
                password:{
                    required:true,
                    minlength:4,
                    maxlength:15
                },
                repwd:{
                    required:true,
                    equalTo:'#pwd2'
                },
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
                username:{
                    required:'用户名不能为空',
                },
                password:{
                    required:'密码不能为空',
                    minlength:'密码最小4位',
                    maxlength:'密码最大15位'
                },
                repwd:{
                    required:'确认密码不能为空',
                    equalTo:'两次密码输入不一致'
                },
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
        //自定义手机号码规则
        jQuery.validator.addMethod("mobile", function(value, element) {  //mobile为自定义规则的名称
            var mobileReg = /^1[34578][0-9]{9}$/;
            return this.optional(element) || (mobileReg.test(value));
        },"请您正确填写您的手机号码");

        //提交表单
        $('.loginBtn').click(function(){   //submit按钮方式提交
            var id=$(this).attr('id');
            //通过id判断是哪个前端验证
            if (id == 0){
                myvalidate=myvalidate0;
            } else if(id == 1){
                myvalidate=myvalidate1;
            }
            if(myvalidate.form()){ //判断前端验证是否通过
                $.post('{{route("home.findPassword")}}',$('#form'+id).serialize(),function(data){
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
            var username = $('#username1').val()
            var mobile=$('input[name="mobile"]').val();
            var mobileReg = /^1[34578][0-9]{9}$/;
            if(mobileReg.test(mobile)){
                $.post('{{route("home.sendMsg")}}', {username:username,mobile:mobile,_token:'{{csrf_token()}}'}, function(msg) {
                    // console.log(msg);
                    if(msg === '提交成功'){
                        RemainTime(0);
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
        //邮箱短信验证码
        function getMail(){
            var username = $('#username2').val()
            var email=$('input[name="email"]').val();
            var mobileReg = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
            if(mobileReg.test(email)){
                $.post('{{route("home.sendMail")}}', {username:username,email:email,_token:'{{csrf_token()}}'}, function(data) {
                    // console.log(data);
                    if(data.status === 'ok') {
                        RemainTime(1);
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
        function RemainTime(id){
            if (id === 0) {
                var yzmBtn=document.getElementById('yzmBtn1')
            }else{
                var yzmBtn=document.getElementById('yzmBtn2')
            }
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
@endsection