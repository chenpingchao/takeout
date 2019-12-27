<?php if (!defined('THINK_PATH')) exit();?><tr>
<?php if(is_array($menu)): $k = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "empty" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k; if($k-1 == $n*3): ?></tr>
<tr>
    <?php $n++; endif; ?>
    <td class="main_1" >
        <a href="<?php echo U('Home/Index/menuDetail',array('uid'=>$v['id']));?>">
            <div class="main_2">
                <img src="http://www.chpch.top/<?php echo ($v["image_dir"]); ?>100_<?php echo ($v["image"]); ?>" width="100%" height="auto"/>
            </div>
            <div class="indetext"><?php echo ($v["menu_name"]); ?></div>
        </a>
    </td><?php endforeach; endif; else: echo "empty" ;endif; ?>
</tr>