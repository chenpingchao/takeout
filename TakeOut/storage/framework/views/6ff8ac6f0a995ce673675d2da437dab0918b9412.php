<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/admin/css/validate.css" rel="stylesheet" type="text/css" />
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/js/layer/layer.js"></script>
    <script type="text/javascript" src="/admin/js/kindeditor/kindeditor-all-min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(e) {
            //加载富文本编辑器
            KindEditor.ready(function(K) {
                K.create('#content', {
                    allowFileManager : true,
                    filterMode: true,
                    afterBlur: function(){  //利用该方法处理当富文本编辑框失焦之后，立即同步数据
                        this.sync("#content") ;
                    }
                });
            });
        });
    </script>
    <style>
        ul li{
            list-style-type: none;
        }
        li{
            padding: 10px;
            margin: 10px;
        }
    </style>
</head>
<body>
<ul>
    <form action="" method="post">
        <?php echo e(csrf_field()); ?>

        <li>
            <label for="grade_name">等级名称:</label>
            <input type="text" id="grade_name" name="grade_name" style="line-height: 2em;text-indent: 5px" value="<?php echo e($grade -> grade_name); ?>">
            <div class="validate-error grade_name" style="background: url('/image/error.png') no-repeat 5px 10px;"></div>
        </li>
        <li>
            <label for="score">需求积分:</label>
            <input type="text" id="score" name="score" style="line-height: 2em" value="<?php echo e($grade -> score); ?>">
            <div class="validate-error score" style="background: url('/image/error.png') no-repeat 5px 10px;"></div>
        </li>
        <li>
            <label>详细福利:<b></b></label>
            <textarea name="detail" id="content" style="width: 420px" rows="20"><?php echo e($grade -> detail); ?></textarea>
        </li>
        <li>
            <input type="button" value="编辑" style="width: 60px;background-color:#b471a0;display: inline-block;margin-left:60%" >
        </li>
    </form>
</ul>
</body>
<script>
    $('input:last').click(function () {
       $.ajax({
           url:'',
           data:$('form').serialize(),
           type:'post',
           dataType:'json',
           success:function (data) {
           // console.log(data);
           if (data.status === 'ok'){
               //提示信息
               layer.msg(data.msg,{icon:6,time:2000,shade:[0.6]},function () {
                   //刷新列表页
                   top.iframe.location.reload(true);
                   //关闭弹层
                   parent.layer.closeAll();
               })
           } else {
               layer.msg(data.msg,{icon:5,time:2000,shade:[0.6]})
           }
       },
           error:function (xhr) {
               var errors = JSON.parse(xhr.responseText).errors;
               if (errors){
                   for (var i in errors){
                       $('.'+i).text(errors[i][0]);
                   }
               }
           }
       })
    });
</script>
</html>