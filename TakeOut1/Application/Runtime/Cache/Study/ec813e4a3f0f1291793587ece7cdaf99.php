<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2><?php echo ($name); ?></h2>
<h2><?php echo ($detail); ?></h2>
<h2><?php echo ($stall["1号"]); ?></h2>
<h2><?php echo ($stall[二号]); ?></h2>
<h2><?php echo ((isset($s) && ($s !== ""))?($s):'没有没有'); ?></h2>
{$stall.4号}
<h2><?php echo (PHP_VERSION); ?></h2>
<h2><?php echo ($_GET['id']); ?></h2>
<h2><?php echo U('Study/Test/test');?></h2>
<h2><?php echo U('Study/Test/test1');?></h2>
<h2><?php echo U('Study/Index/index');?></h2>
<?php if(($name == '请叫我黑心a商人')): ?><h2><?php echo ($stall["三号"]); ?></h2>
<?php elseif(($detail == aaa)): ?>
    <h2><?php echo ($stall["4号"]); ?></h2>
<?php else: ?>
    <h2><?php echo ($stall["1号"]); ?></h2><?php endif; ?>
<?php switch($num): case "1": ?>输出内容1<?php break;?>
    <?php case "2": ?>输出内容2<?php break;?>
    <?php default: ?>默认情况<?php endswitch;?>

<?php $__FOR_START_21048__=1;$__FOR_END_21048__=4;for($i=$__FOR_START_21048__;$i < $__FOR_END_21048__;$i+=1){ echo ($i); } ?>
<?php if(is_array($admin)): foreach($admin as $k=>$v): ?><h2><?php echo ($k); echo ($v["username"]); ?></h2><?php endforeach; endif; ?>
<?php if(is_array($admin)): $k = 0; $__LIST__ = $admin;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><h2><?php echo ($k); ?>-<?php echo ($v["username"]); ?>-<?php echo ($v["password"]); ?></h2><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
</body>
</html>