<?php if (!defined('THINK_PATH')) exit();?>

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
        <?php if(is_array($shop)): $k = 0; $__LIST__ = $shop;if( count($__LIST__)==0 ) : echo "empty" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><td class="main_1">
                <a href="<?php echo U('Home/Shop/takeout',array('id'=>$v['id']));?>">
                    <!--tp模板引擎认识$v.id 但PHP不认识解析不了&#45;&#45;$v['id']-->
                    <div class="main_2">
                        <img src="http://www.liuweiliming.cn<?php echo ($v["logo"]); ?>" width="100%" height="auto"/>
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