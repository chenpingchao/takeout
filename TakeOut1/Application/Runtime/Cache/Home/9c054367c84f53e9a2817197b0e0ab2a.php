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
<title>店铺列表</title>

</head>

<body>
    <div class="header">
    <table width="100%" border="0" cellspacing="0" class="header_nav">
    	<tr>
        	<td width="10%" class="nav_left1"><a  href='javascript:window.history.go(-1)'><</a></td>
            <form action="<?php echo U('Home/Index/shop_list');?>" method="post">
                <td class="nav_right"><input name="search" type="text" placeholder="输入店铺名" value="<?php echo session('shop_search')?session('shop_search'):'';?>" autofocus x-webkit-speech class="searc">
                </td>
                <td class="nav_ss"><input type="submit"  value="搜索" class="sss"></td>
            </form>
            <td width="10%" class="nav_r"></td>
        </tr>
    </table>
    </div>
    
    <!--/*主要部分*/-->
    <div class="takemain" id="main">
        <?php if(is_array($shop)): $k = 0; $__LIST__ = $shop;if( count($__LIST__)==0 ) : echo "$empty_shop" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><a href="<?php echo U('Home/Shop/takeout',array('id' => $v['id']));?>"><div class="take">
                <table width="100%" border="0" cellspacing="0">
                    <tr>
                        <td width="30" class="take_pic"><img src="http://www.liuweiliming.cn/<?php echo ($v["logo"]); ?>" width="100%" height="auto"/></td>
                        <td width="50" class="take_text">
                            <div take_text_1><?php echo ($v["shop_name"]); ?></div>
                            <div>
                                <div></div>
                                <div class="jj"><span class="sj">平均消费</span>￥:<?php echo ($v["avg_price"]); ?></div>
                            </div>
                            <div class="sj">外卖时间：8:00-23:00</div>
                            <div class="sj">评分&emsp;<?php echo ($v["grade"]); ?> | <div class="bg" style="display:inline-block;"><div style="width:<?php echo ($v["gradebi"]); ?>%;"></div></div></div>
                        </td>
                        <td width="20" class="take_phone">
                            <div class="dh"><!--<a href="tel:15854290371"><img src="/Public/img/bd.png" width="100%" height="auto"/></a>--></div>
                        </td>
                    </tr>
                </table>
            </div></a><?php endforeach; endif; else: echo "$empty_shop" ;endif; ?>
    </div>
    
    
   	<!--/*底下导航*/-->
    <table width="100%" border="0" cellspacing="0" class="nav">
        <tr>
            <td width="25" class="foot"><a href="<?php echo U('Home/Index/index');?>"><img src="/Public/img/1.png" width="40%" height="auto"/><p><span>外卖</span></p></a></td>
            <td width="25" class="foot"><a href="classify.html"><img src="/Public/img/22.png" width="40%" height="auto"/><p>分类</p></a></td>
            <td width="25" class="foot"><a href="shopping.html"><img src="/Public/img/33.png" width="40%" height="auto"/><p>购物车</p></a></td>
            <td width="25" class="foot"><a href="<?php echo U('Member/Member/index');?>"><img src="/Public/img/44.png" width="40%" height="auto"/><p>我的</p></a></td>
        </tr>
    </table>
<!--    <extend name="Public/public" >-->
    <div class="kb"></div> 
</body>
<script>
    var scroller = 200;
    var pageNum = <?php echo ($pageNum); ?> + 10; //已经有24条记录
    $(window).scroll(function(){
        me = $(this);
        //滚动距离超过设定值就会加载
        if( me.scrollTop() >= scroller ){
            scroller += 1100 ;
            //判断是否有搜索条件
            if('<?php echo ($haveSearch); ?>'){
                //搜索
                console.log('post')
                /*$.ajax({
                    url : "<?php echo U('Home/Index/menu_list');?>",
                    type : 'post',
                    data:'{pageNum:'+pageNum+'}',
                    datatype:'html',
                    success:function(data){
                        $('#main').append(data);
                        pageNum += 10;
                    }
                })*/
                $.post("<?php echo U('Home/Index/shop_list');?>",{pageNum:pageNum},function(data){
                    $('#main').append(data);
                    pageNum += 24;
                },'html')
            }else{
                //未搜索
                console.log('get')
                $.get("<?php echo U('Home/Index/shop_list');?>?pageNum="+pageNum,'',function(data){
                    $('#main').append(data);
                    pageNum += 10;
                },'html')
            }
        }
    })


</script>
</html>