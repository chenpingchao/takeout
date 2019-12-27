<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width"/>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link type="text/css" href="/Public/css/css.css" rel="stylesheet" />
    <script type="text/javascript" src="/Public/js/jQuery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/Public/js/geo_special.js"></script>
    <script type="text/javascript" src="/Public/js/layer_mobile/layer.js"></script>
    <title>外卖商城</title>
</head>

<body>
    <div class="header">
    <table width="100%" border="0" cellspacing="0" class="header_nav">
        <tr>
            
            <form action="">
                <td class="nav_left" style="padding-left:10px ;">
                    <input type="text" id="picker" style="width:100px;background:#ff8000" class="searc city" placeholder="选择城市">
                </td>
            </form>
            <form action="<?php echo U('Home/Index/menu_list');?>" method="post">
                <td class="nav_right"><input name="search" type="text" placeholder="输入关键词或菜品名" autofocus x-webkit-speech class="searc">
                </td>

                <td class="nav_ss"><input type="submit"  value="搜索" class="sss"></td>
            </form>
        </tr>
    </table>
</div>
    
    <!--/*主要部分*/-->
    <div class="classmain">
    	<table width="95%" border="0" cellspacing="0" class="class_main">
        	<tr>
            	<td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/00.png" width="100%" height="auto"/></div>
                    <div class="class_text">KTV<p>酒吧</p></div></a>
                </td>
                <td width="10"></td>
                <td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/014.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">日用<p>办公用品</p></div></a>
                </td>
            </tr>
            <tr height="5"></tr>
            <tr>
            	<td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/001.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">洗浴<p>SPA</p><p>按摩</p></div></a>
                </td>
                <td width="10"></td>
                <td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/002.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">观光<p>订票</p><p>住宿</p></div></a>
                </td>
            </tr>
            <tr height="5"></tr>
            <tr>
            	<td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/003.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">美容<p>美甲</p><p>美发</p></div></a>
                </td>
                <td width="10"></td>
                <td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/004.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">电器<p>厨房</p><p>化妆品</p></div></a>
                </td>
            </tr>
            <tr height="5"></tr>
            <tr>
            	<td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/004.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">体育<p>高尔夫</p><p>休闲</p></div></a>
                </td>
                <td width="10"></td>
                <td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/005.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">服装<p>箱包</p><p>眼镜</p></div></a>
                </td>
            </tr>
            <tr height="5"></tr>
            <tr>
            	<td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/006.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">婚庆<p>鲜花</p><p>饰品</p></div></a>
                </td>
                <td width="10"></td>
                <td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/007.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">保健品<p>酒</p></div></a>
                </td>
            </tr>
        <tr height="5"></tr>
            <tr>
            	<td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/008.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">茶叶<p>茶具</p></div></a>
                </td>
                <td width="10"></td>
                <td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/009.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">医院<p>培训</p></div></a>
                </td>
            </tr>
            <tr height="5"></tr>
            <tr>
            	<td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/010.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">装修<p>家具</p></div></a>
                </td>
                <td width="10"></td>
                <td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/011.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">代驾<p>车租凭</p></div></a>
                </td>
            </tr>
            <tr height="5"></tr>
            <tr>
            	<td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/012.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">学校<p>团体机构</p></div></a>
                </td>
                <td width="10"></td>
                <td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/013.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">物流<p>通讯</p></div></a>
                </td>
            </tr>
            <tr height="5"></tr>
            <tr>
            	<td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/015.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">加盟<p>贸易</p><p>机械</p></div></a>
                </td>
                <td width="10"></td>
                <td class="class_main_1"><a href="dianqi.html">
                	<div class="class_pic"><img src="/Public/img/016.jpg" width="100%" height="auto"/></div>
                    <div class="class_text">净水器<p>空气净化</p></div></a>
                </td>
            </tr>
        </table>
    </div>
    
   	<!--/*底下导航*/-->
    <table width="100%" border="0" cellspacing="0" class="nav">
    	<tr>
        	<td width="25" class="foot"><a href="index.html"><img src="/Public/img/11.png" width="40%" height="auto"/><p>外卖</p></a></td>
            <td width="25" class="foot"><a href="classify.html"><img src="/Public/img/find2.png" width="40%" height="auto"/><p><span>发现</span></p></a></td>
            <td width="25" class="foot"><a href="shopping.html"><img src="/Public/img/33.png" width="40%" height="auto"/><p>购物车</p></a></td>
            <td width="25" class="foot"><a href="member.html"><img src="/Public/img/44.png" width="40%" height="auto"/><p>我的</p></a></td>
        </tr>
    </table>
    <div class="kb"></div> 
</body>
<script src="/Public/js/js_from_city/picker.min.js"></script>
<script type="text/javascript" src="/Public/js/js_from_city/city.js"></script>
<script type="text/javascript" src="/Public/js/js_from_city/index.js"></script>
</html>