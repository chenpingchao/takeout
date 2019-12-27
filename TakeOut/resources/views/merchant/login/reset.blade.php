<!DOCTYPE HTML>
<html>
<head>
<script id="allmobilize" charset="utf-8" src="/merchant/style/js/allmobilize.min.js"></script>
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="alternate" media="handheld"  />
<!-- end 云适配 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>找回密码</title>

<!-- <div class="web_root"  style="display:none">http://www.lagou.com</div> -->
<script type="text/javascript">
var ctx = "http://www.lagou.com";
console.log(1);
</script>

<link rel="stylesheet" type="text/css" href="/merchant/style/css/style.css"/>
    <link rel="Shortcut Icon" href="/image/title.ico">
<script src="/merchant/style/js/jquery.1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/merchant/style/js/jquery.lib.min.js"></script>
<script type="text/javascript" src="/merchant/style/js/core.min.js"></script>
<script type="text/javascript" src="/merchant/style/js/analytics.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
    <script type="text/javascript" src="/js/jquery.validate.min.js"></script>
<script type="text/javascript">
var youdao_conv_id = 271546; 
</script> 
{{--//<script type="text/javascript" src="/merchant/style/js/conv.js"></script>--}}
    <style>
        .title {
            text-align: center;
            color: #000;
            font-size: 20px;
        }
          #zphone{
              width:96px;
              height:42px;
              padding:0;
              background:#019875 ;
          }
        #repwd,#pwd{
            width:296px;
            font-size: 16px;
            color:#777;
        }
        #mobile{
            width:296px;
            font-size: 16px;
            color:#777;
        }
        .image{
            background:url("/image/error.png") no-repeat 6px;
            padding:0 20px;
            color:#ff2f2f;

        }
        .error{
            color:red;
        }
        .ok{
            color:green;

        }

    </style>
</head>

<body id="login_bg">
	<div class="login_wrapper">
		<div class="login_header">
            <a href="{{route('/')}}"><img src="/image/merchantLogo.png" width="285" height="62" alt="拉勾招聘" /></a>
            <div id="cloud_s"><img src="/merchant/style/images/cloud_s.png" width="81" height="52" alt="cloud" /></div>
            <div id="cloud_m"><img src="/merchant/style/images/cloud_m.png" width="136" height="95"  alt="cloud" /></div>
        </div>
        
    	<input type="hidden" id="resubmitToken" value="" />
     	<div class="find_psw">
            <h2 class="title">找回密码</h2>
            <form id="pswForm" >
                {{csrf_field()}}
                <input type="password" id="pwd" name="password" tabindex="2" placeholder="请输入密码" />
                <div class="image password"></div>

                <input type="password" id="repwd" name="repwd" tabindex="2" placeholder="请再次输入密码" />
                <div class="image repwd"></div>

                <input type="text" id="mobile" name="mobile" tabindex="2" placeholder="请输入手机号" />
                <div class="image mobile"></div>

                <input id="zphone" type="button" value=" 手机验证 "  onClick="get_mobile_code()">
                <input type="text" id="Auth_code" name="Auth_code" style="width:200px;" placeholder="请输入手机验证码" />
                <div class="image Auth_code" ></div>

                <input type="submit" id="submitLogin" value="找回密码" />
            </form>
        </div>
    </div>
    
<script type="text/javascript">
    $(document).ready(function() {
    	$('#pswForm input[type="text"]').focus(function(){
    		$('div[class="image"]').siblings('.error').hide();
    	});
        //验证表单
        $("#pswForm").validate({

            rules: {
                password: {
                    required: true,
                    rangelength: [6,16]
                },
                repwd:{
                    required: true,
                    rangelength: [6,16],
                    equalTo:"#pwd"
                },
                mobile :{
                    required :true,
                    // mobile:true,
                },
                Auth_code: {
                    required: true,
                    remote:{
                        url:'{{route('merchant.remoteMobileCode')}}',
                        type:'post',
                        data:{_token:'{{csrf_token()}}'}
                    }
                }
            },
            messages: {
                password: {
                    required: "请输入密码",
                    rangelength: "请输入6-16位密码，字母区分大小写"
                },
                repwd:{
                    required: "请输入确认密码",
                    rangelength: "请输入6-16位确认密码，字母区分大小写",
                    equalTo:'两次密码不一样'
                },
                mobile:{
                    required: '手机号码不能为空',
                        // mobile:'手机号码格式不正确',
                },
                Auth_code: {
                    required: "请输入短信验证码",
                    remote: "验证码错误"
                }

            },
            //配置成功提示样式
            errorElement: "div",
            success: function(div) {
                div.addClass("ok").html('验证通过');
            },
            validClass: "ok",


            });
        //异步提交
        $('#pswForm').submit(function(){
            me =$(this);
            $.ajax({
                url : '{{route('merchant.misspwd')}}',
                type : 'post',
                data : me.serialize(),
                datatype : 'json',
                success:function(data) {
                    if (data.stats === 'ok') {
                        layer.msg(data.msg, {icon: 6});
                        location = data.url;
                    } else {
                        layer.msg(data.msg, {icon: 5});

                    }
                },
                error:function(xhr){
                    //获取错误信息
                    //隐藏表单盒子
                    $('.image').css('disable','none');
                    var error = JSON.parse(xhr.responseText).errors;
                    $('div.validate-error').html('');
                    if(error){
                        for(var i in error){
                            $('#'+i).text(error[i][0])
                        }
                    }

                }

            });
            return false
        })
    	});


    //短信验证码
    function get_mobile_code(){
        $.post('{{route('merchant.mobile')}}', {_token:'{{csrf_token()}}',mobile:jQuery.trim($('#mobile').val())}, function(msg) {
            if(msg ==='提交成功'){
                RemainTime();
            }else{
                //	location.reload();
                layer.msg(msg);
            }
        });
    };
    var iTime = 59;
    var Account;
    function RemainTime(){
        $('#zphone').attr('disabled',true);
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
        document.getElementById('zphone').value = sTime;
    }



    //手机号码验证
    jQuery.validator.addMethod('mobile',function(value,element){
        var mobileReg = '/^1[345789][0-9]{9}$/';
        return this.optional(element)||(mobileReg.test(value));
    },'请正确填写手机号码');

</script>
</body>
</html>
