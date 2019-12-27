<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr path="<?php echo e($v -> path); ?>">
        <td width="80px" ></td>
        <td width="250px" style="text-align: left"><?php echo e($v -> cate_name); ?>

            <?php if($v -> child_num > 0): ?>
                <span class="extend" url="<?php echo e(route('admin.category.childList',['pid'=>$v->id])); ?>">+</span>
            <?php endif; ?>
        </td>
        <td width="250px"><?php echo e($v -> parent_name); ?></td>
        <td class="td-status">
            <span url="<?php echo e(route('admin.category.active',['path'=> $v -> path,'active'=> $v -> active])); ?>" class="label label-success radius active">
                <?php echo e($v -> active == 1 ? '激活' : '停用'); ?>

            </span>
        </td>
        <td class="td-manage">
            <a title="编辑"  href="<?php echo e(route('admin.category.edit',['id' => $v -> id])); ?>"  class="btn btn-xs btn-info edit" ><i class="icon-edit bigger-120"></i></a>
            <a title="添加子分类" href="<?php echo e(route('admin.category.add',['pid' => $v -> id])); ?>"  class="btn btn-xs btn-warning child-add" ><i class="icon-plus bigger-120"></i></a>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
