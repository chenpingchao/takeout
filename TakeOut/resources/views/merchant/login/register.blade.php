<!DOCTYPE HTML>
<html>
<head>
<script id="allmobilize" charset="utf-8" src="/merchant/style/js/allmobilize.min.js"></script>
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="alternate" media="handheld"  />
<!-- end 云适配 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>注册-拉勾网-最专业的互联网招聘平台</title>
<meta property="qc:admins" content="23635710066417756375" />
<meta content="拉勾网是3W旗下的互联网领域垂直招聘网站,互联网职业机会尽在拉勾网" name="description">
<meta content="拉勾,拉勾网,拉勾招聘,拉钩, 拉钩网 ,互联网招聘,拉勾互联网招聘, 移动互联网招聘, 垂直互联网招聘, 微信招聘, 微博招聘, 拉勾官网, 拉勾百科,跳槽, 高薪职位, 互联网圈子, IT招聘, 职场招聘, 猎头招聘,O2O招聘, LBS招聘, 社交招聘, 校园招聘, 校招,社会招聘,社招" name="keywords">
<meta name="baidu-site-verification" content="QIQ6KC1oZ6" />
    <link rel="Shortcut Icon" href="/image/title.ico">
<link rel="stylesheet" type="text/css" href="/merchant/style/css/style.css"/>
<script src="/merchant/style/js/jquery.1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/merchant/style/js/jquery.lib.min.js"></script>
<script type="text/javascript" src="/merchant/style/js/core.min.js"></script>
{{--<script type="text/javascript" src="/merchant/style/js/conv.js"></script>--}}
<script type="text/javascript" src="/js/layer/layer.js"></script>
<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
	<!-- <div class="web_root"  style="display:none">h</div> -->
	<script type="text/javascript">
		var ctx = "h";
		var youdao_conv_id = 271546;
		// console.log(1);
	</script>
	<style>
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
        	<a href="h/"><img src="/merchant/style/images/logo_white.png" width="285" height="62" alt="拉勾招聘" /></a>
            <div id="cloud_s"><img src="/merchant/style/images/cloud_s.png" width="81" height="52" alt="cloud" /></div>
            <div id="cloud_m"><img src="/merchant/style/images/cloud_m.png" width="136" height="95"  alt="cloud" /></div>
        </div>
        
    	<input type="hidden" id="resubmitToken" value="9b207beb1e014a93bc852b7ba450db27" />		
		<div class="login_box">

        	<form id="loginForm">
                {{csrf_field()}}
            	<input type="text" id="email" name="shop_member_name" tabindex="1" placeholder="请输入商家用户名" />
                <span class="error" style="display:none;" id="beError"></span>
                <div class="image shop_member_name"></div>

                <input type="password" id="pwd" name="password" tabindex="2" placeholder="请输入密码" />
                <div class="image password"></div>

                <input type="password" id="repwd" name="repwd" tabindex="2" placeholder="请再次输入密码" />
                <div class="image repwd"></div>

                <input type="text" id="mobile" name="mobile" tabindex="2" placeholder="请输入手机号" />
                <div class="image mobile"></div>

                <input id="zphone" type="button" value=" 手机验证 "  onClick="get_mobile_code()">
                <input type="text" id="Auth_code" name="Auth_code" style="width:200px;" placeholder="请输入手机验证码" />
                <div class="image Auth_code"></div>

            	<label class="fl registerJianJu" for="checkbox">
            		<input type="checkbox" id="checkbox" name="checkbox" checked  class="checkbox valid" />我已阅读并同意<a href="h/privacy.html" target="_blank">《商家用户协议》</a>
           		</label>
                <input type="submit" id="submitLogin" value="注 &nbsp; &nbsp; 册" />

                <input type="hidden" id="callback" name="callback" value=""/>
                <input type="hidden" id="authType" name="authType" value=""/>
                <input type="hidden" id="signature" name="signature" value=""/>
                <input type="hidden" id="timestamp" name="timestamp" value=""/>
            </form>


            <div class="login_right">
            	<div>已有帐号</div>
            	<a  href="{{route('merchant.login')}}"  class="registor_now">直接登录</a>
                {{--  <div class="login_others">使用以下帐号直接登录:</div>
               -- <a  href="h/ologin/auth/sina.html"  target="_blank" class="icon_wb" title="使用新浪微博帐号登录"></a>
                     <a  href="h/ologin/auth/qq.html"  class="icon_qq" target="_blank" title="使用腾讯QQ帐号登录" ></a>
       --}}       </div>
        </div>
        <div class="login_box_btm"></div>
    </div>
    
    <script type="text/javascript">

    $(document).ready(function(e) {
    	$('.register_radio li input').click(function(e){
    		$(this).parent('li').addClass('current').append('<em></em>').siblings().removeClass('current').find('em').remove();
    	});

    	$('#email').focus(function(){
    		$('#beError').hide();
    	});
    	//验证表单
         $("#loginForm").validate({

            rules: {
                shop_member_name: {
                    required: true,
                    remote:{
                        url:'{{route('merchant.remoteShopMemberName')}}',
                        type:'post',
                        data:{_token:'{{csrf_token()}}'}
                    }
                },
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
                    mobile:true,
                    remote:{
                        url:'{{route('merchant.remoteMobile')}}',
                        type:'post',
                        data:{_token:'{{csrf_token()}}'}
                    }
                },
                Auth_code: {
                    required: true,
                    remote:{
                        url:'{{route('merchant.remoteMobileCode')}}',
                        type:'post',
                        data:{_token:'{{csrf_token()}}'}
                    }
                },
                checkbox:{required:true}
            },
            messages: {
                shop_member_name: {
                    required: "请输入商家用户名",
                    remote: "用户名已被占用"
                },
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
                    remote: "手机号已被占用"
                },
                Auth_code: {
                    required: "请输入短信验证码",
                    remote: "验证码错误"
                },
                checkbox: {
                    required: "请接受商家用户协议"
                }
            },
            //配置成功提示样式
            errorElement: "div",
            success: function(div) {
                div.addClass("ok").html('验证通过');
            },
            validClass: "ok",


            errorPlacement:function(label, element){
                    if(element.attr("type") == "radio"){
                        label.insertAfter($(element).parents('ul')).css('marginTop','-20px');
                    }else if(element.attr("type") == "checkbox"){
                        label.inserresult.contenttAfter($(element).parent()).css('clear','left');
                    }else{
                        label.insertAfter(element);
                    }
                    //modify nancy
                    if(element.attr("type") == "radio"){
                        label.insertAfter($(element).parents('ul')).css('marginTop','-20px');
                    }else if(element.attr("type") == "checkbox"){
                        label.insertAfter($(element).parent()).css('clear','left');
                    }else{
                        label.insertAfter(element);
                    };
                },
            submitHandler:function(form){
                    var type =$('input[type="radio"]:checked',form).val();
                    var email =$('#email').val();
                    var password =$('#password').val();
                    var resubmitToken = $('#resubmitToken').val();

                    var callback = $('#callback').val();
                    var authType = $('#authType').val();
                    var signature = $('#signature').val();
                    var timestamp = $('#timestamp').val();

                    $(form).find(":submit").attr("disabled", true);

                   /* $.ajax({
                        type:'POST',
                        data: {email:email,password:password,type:type,resubmitToken:resubmitToken, callback:callback, authType:authType, signature:signature, timestamp:timestamp},
                        url:ctx+'/user/register.json',
                        dataType:'json'
                    }).done(function(result) {
                        $('#resubmitToken').val(result.resubmitToken);
                        if(result.success){
                            window.location.href=result.content;
                        }else{
                            $('#beError').text(result.msg).show();
                        }
                        $(form).find(":submit").attr("disabled", false);
                    });*/
                }
        });
    });
    //手机号码验证
    jQuery.validator.addMethod('mobile',function(value,element){
        var mobileReg = '/^1[345789][0-9]{9}$/';
        return this.optional(element)||(mobileReg.test(value));
    },'请正确填写手机号码');

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



    //异步提交
        $('#loginForm').submit(function(){
            me =$(this);
            $.ajax({
                url : '',
                type : 'post',
                data : me.serialize(),
                datatype : 'json',
                success:function(data) {
                    if (data.stats === 'ok') {
                        layer.msg('注册成功!', {icon: 6});
                        location = data.url;
                    } else {
                        layer.msg('注册失败!', {icon: 5})
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
    </script>
</body>
</html>
