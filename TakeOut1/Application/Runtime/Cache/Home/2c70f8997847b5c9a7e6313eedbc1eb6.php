<?php if (!defined('THINK_PATH')) exit();?><tr>
<?php if(is_array($menu)): $k = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "$empty_menu" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k; if($k-1 == $n*3): ?></tr>
<tr>
    <?php $n++; endif; ?>
    <td class="main_1" >
        <a href="<?php echo U('Home/Index/menuDetail',array('uid'=>$v['id']));?>">
            <div class="main_2">
                <img src="../../../../index.php" width="100%" height="auto"/>
            </div>
            <div class="indetext"><?php echo ($v["menu_name"]); ?></div>
        </a>
    </td><?php endforeach; endif; else: echo "$empty_menu" ;endif; ?>
</tr>