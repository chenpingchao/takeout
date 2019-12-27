<ul class="products" >
<?php $__empty_1 = true; $__currentLoopData = $shop_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <li>
        <a href="<?php echo e(route('home.menuDetail',['uid'=> $v ->id ] )); ?>" target="_blank" title="<?php echo e($v -> menu_name); ?>">
            <img src="/<?php echo e($v->image_dir.$v -> image); ?>" class="foodsimgsize">
        </a>
        <a href="#" class="item">
            <div>
                <p><?php echo e($v -> menu_name); ?></p>
                <p class="AButton">拖至购物车:￥<?php echo e($v -> price); ?></p>
            </div>
        </a>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <li>
        <p style="text-align:center;font-size:30px;font-weight: bold">该商家没有菜哦！</p>
    </li>
<?php endif; ?>
</ul>
<ul class="am-pagination am-pagination-right listpage" style="float:right;margin-right: 10px">
    <?php echo $show; ?>

</ul>
