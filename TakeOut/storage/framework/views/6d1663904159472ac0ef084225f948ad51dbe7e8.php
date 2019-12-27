<option value="999" <?php echo e($cid == 999 ? 'selected' : ''); ?>>请选择</option>
<?php $__currentLoopData = $nextCate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($v -> id); ?>" <?php echo e($cid == $v -> id ? 'selected' : ''); ?>><?php echo e($v -> cate_name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
