<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width"/>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link type="text/css" href="/public/css/css.css" rel="stylesheet" />
<script src="/public/js/layer_mobile/layer.js"></script>
<script src="/public/js/jquery-3.3.1.min.js"></script>
<title>我的中心</title>
    <style>
        .my_n tr,.my_name tr{
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="header">
    <table width="100%" border="0" cellspacing="0" class="header_nav">
    	<tr>
        	<td width="10%" class="nav_left1"></td>
            <td width="80%" class="nav_title">我的中心</td>
            <td width="10%" class="nav_r"></td>
        </tr>
    </table>
    </div>
    
    <!--/*主要部分*/-->
    <div class="my">
            <table width="100%" border="0" cellspacing="0" class="my_name">
            	<tr class="myinfo" href="<?php echo U('Member/Member/myinfo');?>">
                	<td class="my_main_1">
                        <span><img src="http://www.liuweiliming.cn/<?php echo session('avatar');?>" alt=""></span>
                    	<div><h3><?php echo session('mname');?></h3></div>
                        <div>会员等级：<?php echo getGrade(session('grade'));?></div>
                    </td>
                    <td class="my_mainn">></td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" class="my_2">
            	<tr>
                	<td width="30" class="my_3"><a href="<?php echo U('Member/Member/mycomment');?>"><img src="/public/img/pj.jpg" width="30%" height="auto"/><p>我的评价</p></a></td>
                    <td width="30" class="my_4"><a href="<?php echo U('Member/Member/myscore');?>"><img src="/public/img/xh.jpg" width="30%" height="auto"/><p>我的积分</p></a></td>
                    <td width="30" class="my_4"><a href="<?php echo U('Member/Member/myred');?>"><img src="/public/img/jk.jpg" width="30%" height="auto"/><p>我的红包</p></a></td>
                </tr>
            </table>
            
        	<table width="100%" border="0" cellspacing="0" class="my_n">
            	<tr class="myorder" href="<?php echo U('Member/Member/myorder');?>">
                	<td class="my_main">我的订单</td>
                    <td class="my_mainn">></td>
                </tr>
                <tr class="cart">
                	<td class="my_main_p">我的购物车</td>
                    <td class="my_mainn_p">></td>
                </tr>
                <tr class="grade" href="<?php echo U('Member/Member/mygrade');?>">
                    <td class="my_main_p">我的会员</td>
                    <td class="my_mainn_p">></td>
                </tr>
             </table>
        </div>
        <div class="button1 logout" href="<?php echo U('Member/Member/logout');?>"><input type="button" value="退出当前账号" class="text2"  /></div>

   	<!--/*底下导航*/-->
    <table width="100%" border="0" cellspacing="0" class="nav">
    	<tr>
        	<td width="25" class="foot"><a href="<?php echo U('Home/Index/index');?>"><img src="/public/img/11.png" width="40%" height="auto"/><p>外卖</p></a></td>
            <td width="25" class="foot"><a href="classify.html"><img src="/public/img/22.png" width="40%" height="auto"/><p>分类</p></a></td>
            <td width="25" class="foot"><a href="shopping.html"><img src="/public/img/33.png" width="40%" height="auto"/><p>购物车</p></a></td>
            <td width="25" class="foot"><a href="member.html"><img src="/public/img/4.png" width="40%" height="auto"/><p><span>我的</span></p></a></td>
        </tr>
    </table>
    <div class="kb"></div> 
</body>
<script type="text/javascript">
$('.myinfo').click(function () {
    location = $(this).attr('href');
});

 $('.myorder').click(function () {
    location = $(this).attr('href');
 });

 $('.cart').click(function () {
     location = $(this).attr('href');
 });

 $('.grade').click(function () {
     location = $(this).attr('href');
 });

 $('.logout').click(function () {
     me=this;
     layer.open({
         content:'确认退出？',
         btn:['退出','取消'],
         yes:function () {
            location=($(me).attr('href'));
         }
     })
 });
</script>
</html>