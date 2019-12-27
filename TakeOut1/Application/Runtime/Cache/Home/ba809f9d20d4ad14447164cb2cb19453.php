<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width"/>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link type="text/css" href="/Public/css/style.css" rel="stylesheet" />
<script type="text/javascript" src="/Public/js/jQuery-1.8.2.min.js"></script>
<script type="text/javascript" src="/Public/js/layer_mobile/layer.js"></script>

<title>产品详情</title>


</head>

<body>
	<div class="header">
    <table width="100%" border="0" cellspacing="0" class="header_nav">
    	<tr>
        	<td width="10%" class="nav_left1"><a  href='javascript:window.history.go(-1)'><</a></td>
            <td width="80%"class="nav_title">产品详情</td>
            <td width="10%" class="nav_r"></td>
        </tr>
    </table>
    </div>
    <!--/*主要部分*/-->
    <?php $image = $menu['image']?"http://www.liuweiliming.cn/".$menu['image_dir']."320_".$menu['image'] : '\Public\img\default1.jpg' ?>
    <div class="bodymain">
    	<div><img src="<?php echo ($image); ?>" width="100%" height="253"/></div>
        <div class="cp" >
                <div class="cp_left">
            	<div><h3><?php echo ($menu["menu_name"]); ?></h3></div>

            </div>
            <div class="cp_right"><?php echo ($menu["price"]); ?></div>
        </div>
        <div class="dz">
        <div class="dz_left">
            <div><h5>外卖电话：<?php echo ($shop["shop_mobile"]); ?></h5></div>
            <div><?php echo ($shop["site"]); ?></div>
            <div>外卖时间：08:00-23:00</div>
        </div>
        <div class="dz_right"><img src="/Public/img/bd.png" width="70%" height="auto" /></div>
    </div>

		<div class="btn">
            <table width="100%" border="0" cellspacing="0">
                <tr>
                    <td class="btn1"><a href="javascript:add_cart();"><input type="button" value="加入购物车" class="btn2"></a></td>
                    <td class="btn1"><a href="javascript:buy();"><input type="button" value="立即购买" class="btn3"></a></td>
            </table>
        </div>
        <div class="nr" style="width:320px;margin:0 auto;"></div>
        <div class="btnn">
            <table width="100%" border="0" cellspacing="0">
                <tr>
                    <td class="bt"><input type="button" value="产品详情" class="b"></td>
                    <td class="bt"><a href="#evaluate"><input type="button" value="产品评价" class="bb"></a></td>
            </table>
        </div>
     
     <div><!--产品详情-->
        <div class="pic"><?php echo ($menu["detail"]); ?></div>
    </div>
        <a id="evaluate"></a>
    <div class="pl"><!--产品评价-->
        <input type="button" value="产品评价" class="b">
        <?php if(is_array($evaluate)): $k = 0; $__LIST__ = $evaluate;if( count($__LIST__)==0 ) : echo "暂时没有评论" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="pll">
        	<div class="pl_1" ><h4><?php echo ($v["username"]); ?></h4></div>
            <a href="javascript:highlightStar('<?php echo ($v["fenshu"]); ?>');"></a>

            <div class="pl_2">满意：<?php echo ($v["fenshu"]); ?><div class="bg" style="display:inline-block;"><div style="width:<?php echo ($v["fenshubi"]); ?>%;"></div></div>
                <span>| <?php echo ($v["add_time"]); ?></span></div>
            <div class="pl_3"><?php echo ($v["detail"]); ?></div>
            <div class="pl_pic">

            </div>
        </div><?php endforeach; endif; else: echo "暂时没有评论" ;endif; ?>
    </div>
    </div>
    <div class="kb"></div>
</body>
<script>
    //添加购物车
    function add_cart(){
        if("<?php echo empty(session('?mid'));?>"){
            location = "<?php echo U('Home/Login/index');?>";
        }else {
            $.get('<?php echo U("/Home/Block/addCart",["uid"=> $menu["id"]] ) ;?>', '', function (data) {
                if (data.status === 'ok') {
                    layer.open({
                        title: [
                            '询问',
                            'background-color:#ff8000; color:#fff;'
                        ]
                        , anim: 'up'
                        , content: '是否去购物车'
                        , btn: ['去购物车', '留在本页面']
                        , yes: function () {
                            location = '';
                        }
                    });
                } else {
                    layer.open({
                        style: 'border:none; background-color:#ff8000; color:#fff;',
                        content: '购物车添加失败',
                        time: 2
                    })
                }
            })
        }
    }

    //评价星级
       
    function highlightStar(num) {
        num1 = parseInt(num);
        var starBg = document.getElementById("starContainer");
        var stars = starBg.getElementsByTagName("a");
        for ( i = 0; i < num1 ; i++) {
            stars[i].className = 'highlight';
        }
    }

    // 直接下单
    function buy(){
        location = '<?php echo U("Home/Block/buy",array("uid"=>$menu["id"]));?>';
    }


</script>
</html>