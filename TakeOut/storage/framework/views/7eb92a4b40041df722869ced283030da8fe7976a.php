<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/public.css">
    <script type="text/javascript" src="/merchant/style/js/jquery.1.10.1.min.js"></script>
    <script src="/js/layer/layer.js" type="text/javascript"></script>
    <title>Document</title>
</head>
<body>
<div class="add_menu_cate">
    <div>你可以在这里添加菜品分类</div>
    <div class="add_box">
        <form action="" id="form">
            <?php echo e(csrf_field()); ?>


            <label for="cate" >添加分类：</label>
            <input type="text" id="cate" name="cate"><br>
            <input type="submit" value="添加" class="insert">
        </form>
    </div>
</div>
</body>
<script>
    $('#form').submit(function(){
        me = $(this);
        $.post('',me.serialize(),function(data){
            if(data.status == 'ok'){
                layer.msg(data.msg,{icon:6})
                parent.location.reload();
                parent.layer.closeAll();
            }else{
                layer.msg(data.msg,{icon:5})
            }
        })
        return false;

    })
</script>
</html>