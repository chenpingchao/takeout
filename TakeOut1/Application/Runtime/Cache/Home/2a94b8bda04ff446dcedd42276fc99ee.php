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
<title>外卖商城</title>
    <style>
        .wheel-scroll.wheel-scroll-hook {
            margin: 0;
            padding: 0;
        }
    </style>
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
    <div style="margin-top:40px;"><img src="/Public/img/000.jpg" width="100%" height="auto"/></div>
    <div class="xx">
    	<div class="xx_1"><img src="/Public/img/ts.png" width="40%" height="auto"/></div>
        <div class="xx_2">外卖：30分钟前A用户联系到大方外卖：30分钟前A用户联系到大方炸鸡炸鸡</div>
    </div>

    <div id="replace">
        <!--    /*主要部分 菜品列表* /-->
        <div class="indexmain">
            <div class="menu">
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;热卖菜品 &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <a href="<?php echo U('Home/index/menu_list');?>">></a>
            </div>
            <table width="100%" border="0" cellspacing="0" class="indexmain_1">
                <?php if(is_array($menu)): $k = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "empty" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><td class="main_1" >
                        <a href="<?php echo U('Home/Index/menuDetail',array('uid'=>$v['id']));?>">
                            <div class="main_2">
                                <img src="http://www.liuweiliming.cn/<?php echo ($v["image_dir"]); ?>100_<?php echo ($v["image"]); ?>" width="100%" height="auto"/>
                            </div>
                            <div class="indetext"><?php echo ($v["menu_name"]); ?></div>
                        </a>
                    </td>
                    <?php if($k == $n*3): ?></tr>
                        <?php $n++; endif; endforeach; endif; else: echo "empty" ;endif; ?>

            </table>
        </div>

        
        <div id="activity" class="indexmain">
            <div class="title">
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;火热店铺 &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <a href="<?php echo U('Home/index/shop_list');?>">></a>
            </div>
            <table width="100%" border="0" cellspacing="0" class="indexmain_1">
                <?php if(is_array($shop)): $k = 0; $__LIST__ = $shop;if( count($__LIST__)==0 ) : echo "empty" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><td class="main_1" style="width: 120px;height: 134px;padding-left: 5px">
                        <a href="<?php echo U('Home/Shop/takeout',array('id'=>$v['id']));?>">
                        <!--tp模板引擎认识$v.id 但PHP不认识解析不了&#45;&#45;$v['id']-->
                            <div class="main_2">
                                <img src="http://www.liuweiliming.cn/<?php echo ($v["logo"]); ?>" width="100%" height="auto"/>
                            </div>
                            <div class="indetext"><?php echo ($v["shop_name"]); ?></div>
                        </a>
                    </td>
                    <?php if($k == $m*3): ?></tr>
                        <?php $m++; endif; endforeach; endif; else: echo "empty" ;endif; ?>
            </table>
            <div style="clear:both;height:52px;">
            </div>
        </div>
    </div>
   	<!--/*底下导航*/-->
    <table width="100%" border="0" cellspacing="0" class="nav">
    	<tr>
        	<td width="25" class="foot"><a href="<?php echo U('Home/Index/index');?>"><img src="/Public/img/1.png" width="30%" height="auto"/><span><p>外卖</p></span></a></td>
            <td width="25" class="foot"><a href="<?php echo U('Home/Find/index');?>"><img src="/Public/img/find.png" width="30%" height="auto"/><p>发现</p></a></td>
            <td width="25" class="foot"><a href="<?php echo U('Home/Block/ShoPP');?>"><img src="/Public/img/33.png" width="30%" height="auto"/><p>购物车</p></a></td>
            <td width="25" class="foot"><a href="<?php echo U('Member/Member/index');?>"><img src="/Public/img/44.png" width="30%" height="auto"/><p>我的</p></a></td>
        </tr>
    </table>
    <div class="kb"></div> 
</body>
<script src="/Public/js/js_from_city/picker.min.js"></script>
<script type="text/javascript" src="/Public/js/js_from_city/city.js"></script>
<script type="text/javascript" src="/Public/js/js_from_city/index.js"></script>
</html>