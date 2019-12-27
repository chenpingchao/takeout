<style>
    ul.smallpic li{
        border: 1px solid #ccc;
        margin-left: 5px;
        cursor: pointer;
    }
    #showimg{
        border: 1px solid #ccd0d2;
    }
    ul,li{
        list-style-type: none;
    }
    .smallpic li{
        float: left;
    }
</style>

<div class="foodpic">
    <div style="clear: both">
        <ul class="smallpic">
            <li><img src="/<?php echo e($menu_msg[0] -> image_dir); ?>100_<?php echo e($menu_msg[0] -> image); ?>" onclick="show('/<?php echo e($menu_msg[0] -> image_dir); ?>350_<?php echo e($menu_msg[0] -> image); ?>')"></li>
            <?php $__empty_1 = true; $__currentLoopData = $menu_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li><img src="/<?php echo e($v -> image_dir); ?>100_<?php echo e($v -> image); ?>" onclick="show('/<?php echo e($v -> image_dir); ?>350_<?php echo e($v -> image); ?>')" ></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
        </ul>
    </div>
    <div style="margin-left: 25px;margin-top: 5px;display: inline-block">
        <img src="/<?php echo e($menu_msg[0] -> image_dir); ?>350_<?php echo e($menu_msg[0] -> image); ?>" id="showimg" style="margin-left: 20px">
    </div>
</div>
<script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
<script>
    //显示图
    function show(src) {
        $('#showimg').attr('src',src);
    }
</script>