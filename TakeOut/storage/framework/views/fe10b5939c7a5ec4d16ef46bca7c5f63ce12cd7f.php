<?php $__empty_1 = true; $__currentLoopData = $menu_comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

    <div class="shopcomment">
        <div class="Spname">
            <a href="<?php echo e(route('home.menuDetail',['uid'=>$v->uid])); ?>" target="_blank" title="酸辣土豆丝"><?php echo e($v->menu_name); ?></a>
        </div>
        <div class="C-content">
            <q><?php echo e($v -> detail); ?></q>
            <i><?php echo e(date('Y-m-d H:i:s',$v ->add_time)); ?></i>
        </div>
        <div class="username">
            用户： <?php echo e($v ->username); ?>

        </div>
    </div>
    <div class="shopcomment">
        <div class="Spname">
            &emsp;
        </div>
        <div class="username">
            <?php echo e($v ->reply_name); ?> 回复：
        </div>
        <div class="C-content">
            <q><?php echo e($v -> reply); ?></q>

        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div>暂时没有评论</div>
    <?php endif; ?>
<ul class="am-pagination am-pagination-right listpage" style="float:right;">
    <?php echo $show; ?>

</ul>