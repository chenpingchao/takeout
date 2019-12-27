<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        table{
            background-color: #f0c040;
        }
        th{
            text-align: center;
            font-weight: bold;
            background-color: #000;
            color:#fff;
        }
        td,th{
            border:1px solid #ff0300;
            vertical-align: middle;
        }

    </style>
</head>
<body>

<table>
   <tr>
       <td colspan="5">
           <h1 style="text-align: center;font-family: 黑体">商品列表</h1>
       </td>
   </tr>
    <tr>
        <th  width="10">id</th>
        <th  width="100">用户名</th>
        <th  width="400">密码</th>
        <th  width="30">等级</th>
        <th  width="30">电话号码</th>
    </tr>
    <?php $__empty_1 = true; $__currentLoopData = $member; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($v['id']); ?></td>
            <td><?php echo e($v['username']); ?></td>
            <td><?php echo e($v['password']); ?></td>
            <td><?php echo e($v['grade']); ?></td>
            <td><?php echo e($v['mobile']); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <?php endif; ?>
</table>
</body>
</html>