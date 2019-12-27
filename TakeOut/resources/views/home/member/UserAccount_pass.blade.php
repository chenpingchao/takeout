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
                height: 215px;
                background-color: #FfF5DC;
            }
            div.regRight{
                border:0;
                background-color: #DCDCDC;
                height:185px;
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
                password:{
                    required:true,
                    minlength:4,
                    maxlength:15
                },
                repwd:{
                    required:true,
                    equalTo:'#pwd1'
                }
            },
            //配置提示信息
            messages:{
                password:{
                    required:'密码不能为空',
                    minlength:'密码至少需要4个字符',
                    maxlength:'密码最多允许15个字符'
                },
                repwd:{
                    required:'确认密码不能为空',
                    equalTo:'两次密码输入不一致'
                }
            },
            //配置成功提示样式
            errorElement: "div",
            success: function(div) {
                div.addClass("ok").html('验证通过');
            },
            validClass: "ok"
        });
        //提交表单
        $('.loginBtn').click(function(){   //submit按钮方式提交
            if(validate.form()){ //判断前端验证是否通过
                $.post('{{route("hm.mem.UserAccount_pass")}}',$('#form0').serialize(),function(data){
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
    </script>
</html>