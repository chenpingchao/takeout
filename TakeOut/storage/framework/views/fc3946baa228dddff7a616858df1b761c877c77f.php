<!DOCTYPE HTML>
<html xmlns:wb="http://open.weibo.com/wb">
<head>

    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate" media="handheld"  />
    <!-- end 云适配 -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>外卖订餐</title>
    <meta property="qc:admins" content="23635710066417756375" />
    <meta content="全国condition-condition-公司列表-拉勾网-最专业的互联网招聘平台" name="description">
    <meta content="全国condition-公司列表-拉勾网-最专业的互联网招聘平台" name="keywords">
    <meta name="baidu-site-verification" content="QIQ6KC1oZ6" />
    <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/merchant/style/js/core.min.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
    <link rel="Shortcut Icon" href="/image/title.ico">
    <style>
        .loginTop{
            padding: 5px 10px;
        }

    </style>
    <!-- <div class="web_root"  style="display:none">h</div> -->
    <script type="text/javascript">
        var ctx = "h";
        console.log(1);
    </script>

    <?php echo $__env->yieldContent('header'); ?>

    <script type="text/javascript">
        var youdao_conv_id = 271546;
    </script>

</head>
<body>
<div id="body">
    <div id="header">
        <div class="wrapper">
            <a href="<?php echo e(route( '/' )); ?>" class="logo">
                <img src="/image/merchantLogo.png" width="229" height="43" alt="外卖商城" />
            </a>
            <ul class="reset" id="navheader">
                <li class="current"><a href="<?php echo e(route('merchant.index')); ?>" >店铺</a></li>
                <?php echo $__env->yieldContent('orders'); ?>
            </ul>

            
            <dl class="collapsible_menu">
                <dt style="text-align: center" id="top">
                    <?php echo e(session('smname')); ?>

                    <span class="red dn " id="noticeDot-1"></span>
                    <i></i>
                </dt>
                <dd class="logout"><a rel="nofollow" href="javascript:logout()">退出</a></dd>
            </dl>

        </div>
    </div><!-- end #header -->

<?php echo $__env->yieldContent('main'); ?>



</div><!-- end #body -->
<div id="footer">
    <div class="wrapper">
        <a href="h/about.html" target="_blank" rel="nofollow">联系我们</a>
        <a href="h/af/zhaopin.html" target="_blank">互联网公司导航</a>
        <a href="http://e.weibo.com/lagou720" target="_blank" rel="nofollow">拉勾微博</a>
        <a class="footer_qr" href="javascript:void(0)" rel="nofollow">拉勾微信<i></i></a>
        <div class="copyright">&copy;2013-2014 Lagou <a target="_blank" href="http://www.miitbeian.gov.cn/state/outPortal/loginPortal.action">京ICP备14023790号-2</a></div>
    </div>
</div>



<!--  -->
<script>
    $('#top').mouseenter(function (){
        $('.logout').css('display','block');
    })
    $('.collapsible_menu').mouseleave(function (){
        $('.logout').css('display','none');
    })
    function logout(){
        $.get('<?php echo e(route('merchant.logout')); ?>','',function(data){
            if(data.stats ==='ok'){
                layer.msg(data.msg,{icon:6})
                location = data.url;
            }else{
                layer.msg(data.msg,{icon:5})
            }
        })
    }

</script>

</body>
<?php echo $__env->yieldContent('script'); ?>
</html>
