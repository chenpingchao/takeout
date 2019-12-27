<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width"/>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link type="text/css" href="/public/css/css.css" rel="stylesheet" />
<script type="text/javascript" src="/Public/js/jQuery-1.8.2.min.js"></script>
<script type="text/javascript" src="/Public/js/geo.js"></script>
<script type="text/javascript" src="/Public/js/layer_mobile/layer.js"></script>
<title>中韩商城</title>
</head>

<body>
    <div class="header">
    <table width="100%" border="0" cellspacing="0" class="header_nav">
    	<tr>

            <form action="<?php echo U('Home/Index/menu_list');?>" method="post">
                <td class="nav_right"><input type="text" placeholder="输入关键词或菜品名" autofocus x-webkit-speech class="searc">
                </td>

                <td class="nav_ss"><input type="submit"  value="搜索" class="sss"></td>
            </form>
        </tr>
    </table>
    </div>

    <div class="xx">
    </div>

    <div id="replace">
        <!--    /*主要部分 菜品列表* /-->
        <div class="indexmain">
            <table width="100%" border="0" cellspacing="0" class="indexmain_1">
                <?php if(is_array($menu)): $k = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "empty" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><td class="main_1" >
                        <a href="<?php echo U('Home/Index/menuDetail',array('uid'=>$v['id']));?>">
                            <div class="main_2">
                                <img src="http://www.chpch.top/<?php echo ($v["image_dir"]); ?>100_<?php echo ($v["image"]); ?>" width="100%" height="auto"/>
                            </div>
                            <div class="indetext"><?php echo ($v["menu_name"]); ?></div>
                        </a>
                    </td>
                    <?php if($k == $n*3): ?></tr>
                        <?php $n++; endif; endforeach; endif; else: echo "empty" ;endif; ?>

            </table>
        </div>

    </div>
   	<!--/*底下导航*/-->
    <table width="100%" border="0" cellspacing="0" class="nav">
    	<tr>
        	<td width="25" class="foot"><a href="<?php echo U('Home/Index/index');?>"><img src="/public/img/1.png" width="30%" height="auto"/><span><p>外卖</p></span></a></td>
            <td width="25" class="foot"><a href="classify.html"><img src="/public/img/22.png" width="30%" height="auto"/><p>分类</p></a></td>
            <td width="25" class="foot"><a href="shopping.html"><img src="/public/img/33.png" width="30%" height="auto"/><p>购物车</p></a></td>
            <td width="25" class="foot"><a href="<?php echo U('Member/Member/index');?>"><img src="/public/img/44.png" width="30%" height="auto"/><p>我的</p></a></td>
        </tr>
    </table>
    <div class="kb"></div> 
</body>
<script>
    // console.log('aa');
    $('#s2').change(function(){
        me= $(this);
        if(me.val() == '地级市'){
            layer.open({
                content: '请选择地级市'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return false;
        }
        $.get("<?php echo U('index');?>?city="+me.val(),'',function(data){
            $('#replace').html(data);
        },'html')
    })

    setup();
    preselect("<?php echo ($province?$province:'北京市'); ?>");
    document.getElementById('s2').value="<?php echo ($city?$city:'北京市'); ?>";


</script>
</html>