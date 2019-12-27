<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript" src="/merchant/style/js/jquery.1.10.1.min.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
    <style>
        .textaling{
            text-align: center;
        }
        .top{
            color:#00A3EC;
            margin-bottom:10px;
        }
        .comment{
             width:800px;
            margin:10px 0 20px 70px;
             font-size: 20px;
            text-align: center;
         }
        .merchant{
            text-align: center;
            color: #353dff;
        }
        .text{
            width:900px;
            height:200px;
            margin:30px;
        }
        .submit{
            background: #2aff71;
            width:100px;
            height:40px;
            margin:15px 450px;
        }
    </style>
</head>
<body>
<div>
    <?php $__empty_1 = true; $__currentLoopData = $reply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="top textaling"> <span><?php echo e($v -> username); ?></span> 对 <span><?php echo e($v -> menu_name); ?></span>进行了评价</div>

        <div class="comment"><?php echo $v -> detail; ?>}</div>
        <form action="" method="post">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="mc_id" value="<?php echo e($v->id); ?>">
            <div class="merchant"><label for="reply">商家回复</label></div>
            <?php if($v -> reply): ?>
            <div class="comment"><?php echo $v -> reply; ?>}</div>
            <?php else: ?>
            <textarea name="reply" id="reply" cols="30" rows="10" class="text"></textarea>
            <input type="submit" class="submit" value="回复">
            <?php endif; ?>

        </form>
        <hr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <h2>暂时没有评论</h2>
    <?php endif; ?>
</div>
</body>
<script>
    $('.submit').click(function(){
        me = $(this);
        $.post('',me.closest('form').serialize(),function(data){
            if(data.stats == 'ok'){
                layer.msg('回复成功')

            }else{
                layer.msg('回复失败')
            }
        })

        return false
    })
</script>
</html>
