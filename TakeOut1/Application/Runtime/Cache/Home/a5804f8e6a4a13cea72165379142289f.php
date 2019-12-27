<?php if (!defined('THINK_PATH')) exit(); if(is_array($shop)): $k = 0; $__LIST__ = $shop;if( count($__LIST__)==0 ) : echo "$empty_shop" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><a href="<?php echo U('Home/Shop/takeout',array('id' => $v['id']));?>"><div class="take">
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