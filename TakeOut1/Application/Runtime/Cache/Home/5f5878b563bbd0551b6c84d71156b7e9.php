<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width"/>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link type="text/css" href="/public/css/css.css" rel="stylesheet" />
<title>中韩商城</title>
</head>

<body>
    <div class="header">
    <table width="100%" border="0" cellspacing="0" class="header_nav">
    	<tr>
        	<td class="nav_left">
            <select class="nav_op">
            	<option class="nav_tion">青岛</option>
                <option class="nav_tion">北京</option>
                <option class="nav_tion">上海</option>
                <option class="nav_tion">广州</option>
                <option class="nav_tion">天津</option>
                <option class="nav_tion">沈阳</option>
                <option class="nav_tion">大连</option>
                <option class="nav_tion">重庆</option>
                <option class="nav_tion">西安</option>
                <option class="nav_tion">成都</option>
                <option class="nav_tion">燕郊</option>
                <option class="nav_tion">延边</option>
                <option class="nav_tion">烟台</option>
                <option class="nav_tion">威海</option>
            </select>
            </td>
            <td ></td>
            <td class="nav_right"><input type="text" placeholder="输入关键词搜索商品" autofocus x-webkit-speech class="searc">
            </td>
            <td class="nav_ss"><input type="submit"  value="搜索" class="sss"></td>
        </tr>
    </table>
    </div>
    <div style="margin-top:40px;"><img src="/public/img/000.jpg" width="100%" height="auto"/></div>
    <div class="xx">
    	<div class="xx_1"><img src="/public/img/ts.png" width="40%" height="auto"/></div>
        <div class="xx_2">外卖：30分钟前A用户联系到大方外卖：30分钟前A用户联系到大方炸鸡炸鸡</div>
    </div>
    
    <!--/*主要部分*/-->
    <div class="indexmain">
    	<table width="100%" border="0" cellspacing="0" class="indexmain_1">
            <?php if(is_array($menu)): $k = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "empty" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k; if($menu): endif; ?>
                <tr>
                    <td class="main_1"><a href="take-out.html">
                        <div class="main_2"><img src="/public/img/cp.jpg" width="100%" height="auto"/></div>
                        <div class="indetext">炸鸡</div></a>
                    </td>
                    <td class="main_1"><a href="take-out.html">
                        <div class="main_2"><img src="/public/img/cp1.jpg" width="100%" height="auto"/></div>
                        <div class="indetext">烧烤</div></a>
                    </td>
                    <td class="main_1"><a href="take-out.html">
                        <div class="main_2"><img src="/public/img/cp2.jpg" width="100%" height="auto"/></div>
                        <div class="indetext">中餐</div></a>
                    </td>
                </tr><?php endforeach; endif; else: echo "empty" ;endif; ?>
        	<tr>
            	<td class="main_1"><a href="take-out.html">
                	<div class="main_2"><img src="/public/img/cp.jpg" width="100%" height="auto"/></div>
                    <div class="indetext">炸鸡</div></a>
                </td>
                <td class="main_1"><a href="take-out.html">
                	<div class="main_2"><img src="/public/img/cp1.jpg" width="100%" height="auto"/></div>
                    <div class="indetext">烧烤</div></a>
                </td>
                <td class="main_1"><a href="take-out.html">
                	<div class="main_2"><img src="/public/img/cp2.jpg" width="100%" height="auto"/></div>
                    <div class="indetext">中餐</div></a>
                </td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" class="indexmain_1">
            <?php if(): ?><tr>
            	<td class="main_1"><a href="take-out.html">
                	<div class="main_2"><img src="/public/img/cp3.jpg" width="100%" height="auto"/></div>
                    <div class="indetext">猪蹄</div></a>
                </td>
                <td class="main_1"><a href="take-out.html">
                	<div class="main_2"><img src="/public/img/cp4.jpg" width="100%" height="auto"/></div>
                    <div class="indetext">披萨</div></a>
                </td>
                <td class="main_1"><a href="take-out.html">
                	<div class="main_2"><img src="/public/img/cp5.jpg" width="100%" height="auto"/></div>
                    <div class="indetext">寿司.肉包</div></a>
                </td>
            </tr><?php endif; ?>
        	<tr>
            	<td class="main_1"><a href="take-out.html">
                	<div class="main_2"><img src="/public/img/cp6.jpg" width="100%" height="auto"/></div>
                    <div class="indetext">盒饭.粥</div></a>
                </td>
                <td class="main_1"><a href="take-out.html">
                	<div class="main_2"><img src="/public/img/cp7.jpg" width="100%" height="auto"/></div>
                    <div class="indetext">拌菜.汤饭</div></a>
                </td>
                <td class="main_1"><a href="take-out.html">
                	<div class="main_2"><img src="/public/img/cp8.jpg" width="100%" height="auto"/></div>
                    <div class="indetext">咖啡店</div></a>
                </td>
            </tr>
        	<tr>
            	<td class="main_1"><a href="take-out.html">
                	<div class="main_2"><img src="/public/img/cp9.jpg" width="100%" height="auto"/></div>
                    <div class="indetext">蛋糕</div></a>
                </td>
                <td class="main_1"><a href="take-out.html">
                	<div class="main_2"><img src="/public/img/cp10.jpg" width="100%" height="auto"/></div>
                    <div class="indetext">周边美食</div></a>
                </td>
                <td class="main_1"><a href="take-out.html">
                	<div class="main_2"><img src="/public/img/cp11.jpg" width="100%" height="auto"/></div>
                    <div class="indetext">食品超市</div></a>
                </td>
            </tr>
        </table>
    </div>
    
    <div id="activity">
    	<div class="title">优惠中心</div>
        <div class="content">
                <div class="text">网上订餐，每单任意消费后，加6元即可享受缤纷美味,加6元即可享受缤纷美味</div>
                <div class="jt">></div>
        </div>
        <div class="content">
                <div class="text">网上订餐，每单任意消费后，加6元即可享受缤纷美味,加6元即可享受缤纷美味</div>
                <div class="jt">></div>
        </div>
        <div class="content">
                <div class="text">网上订餐，每单任意消费后，加6元即可享受缤纷美味,加6元即可享受缤纷美味</div>
                <div class="jt">></div>
        </div>
        <div class="content">
                <div class="text">网上订餐，每单任意消费后，加6元即可享受缤纷美味,加6元即可享受缤纷美味</div>
                <div class="jt">></div>
        </div>
    </div>
        
    </div>
   	<!--/*底下导航*/-->
    <table width="100%" border="0" cellspacing="0" class="nav">
    	<tr>
        	<td width="25" class="foot"><img src="/public/img/1.png" width="30%" height="auto"/><span><p>外卖</p></span></td>
            <td width="25" class="foot"><a href="classify.html"><img src="/public/img/22.png" width="30%" height="auto"/><p>分类</p></a></td>
            <td width="25" class="foot"><a href="shopping.html"><img src="/public/img/33.png" width="30%" height="auto"/><p>购物车</p></a></td>
            <td width="25" class="foot"><a href="login.html"><img src="/public/img/44.png" width="30%" height="auto"/><p>我的</p></a></td>
        </tr>
        
    </table>
    <div class="kb"></div> 
</body>
</html>