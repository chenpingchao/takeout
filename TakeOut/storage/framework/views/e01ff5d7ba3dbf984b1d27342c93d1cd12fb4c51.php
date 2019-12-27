<?php $__empty_1 = true; $__currentLoopData = $guestbook; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <span class="Ask"><i><?php echo e($v -> username); ?></i>:<?php echo e($v -> content); ?></span>
        <?php if($v -> reply): ?>
            <span class="Answer"><i><?php echo e($v -> reply_name); ?>回复</i>：<?php echo e($v -> reply); ?></span>
        <?php else: ?>
            <span class="Answer">商家还没有回复呦！</span>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <span>没有查询的数据</span>
<?php endif; ?>
<ul class="am-pagination am-pagination-right listpage" style="float:right;">
    <?php echo $show; ?>

</ul>