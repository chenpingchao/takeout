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
    <script type="text/javascript" src="/home/js/jqpublic.js"></script>
    <style>
        table td{
            position: relative;
            height:40px;
        }
        #embed-captcha {
            width: 280px;
            margin: 0 auto;
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
@endsection
{{--截取主体--}}
@section('main')
<!--Start content-->
<section class="Psection MT20">
    <form action="" method="post" id="form1">
        {{csrf_field()}}
        <table class="login">
            <tr>
                <td width="40%" align="right" class="FontW">账号：</td>
                <td>
                    <input type="text" name="username" class="username" required autofocus placeholder="账号/手机号码">
                    <span class="error" style="display: block;">{{$errors->first('username')}}</span>
                </td>
            </tr>
            <tr>
                <td width="40%" align="right" class="FontW">密码：</td>
                <td>
                    <input type="password" name="password" required>
                    <span class="error" style="display: block;">{{$errors->first('password')}}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="embed-captcha" style="text-align:center;margin:20px auto;">正在加载验证码......</div>
                </td>
            </tr>
            <tr>
                <td width="40%" align="right"></td>
                <td>
                    <button name="" id="Submit_b" class="Submit_b" style="background-color:#2d6983;height:30px;width:80px;color:#CCCCCC;">登 录</button>
                    ( 未注册会员，<a href="{{route('home.register')}}" class="BlueA">请注册.</a>
                     忘记密码？<a href="{{route('home.findPassword')}}"  onclick="findPassword()" class="BlueA">忘记密码</a> )
                </td>
            </tr>
        </table>
    </form>
</section>
<!--End content-->
@endsection
<!--另起炉灶-->
@section('script')
    <script type="text/javascript" src="/home/js/jQuery.1.8.2.min.js"></script>
    <script type="text/javascript"  src="/home/js/layer/layer.js"></script>
    <script type="text/javascript"  src="/home/js/jquery.validate.min.js"></script>
    <script type="text/javascript"  src="/home/js/gt.js"></script>
    <script>
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
                url: "{{route('home.geetest')}}"+"?id="+Math.random(), // 加随机数防止缓存
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
        $('.Submit_b').click(function(captchaObj){
            if(myvalidate.form()) { //判断前端验证是否通过
                $.post('{{route("home.login")}}', $('#form1').serialize(), function (data) {
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
@endsection