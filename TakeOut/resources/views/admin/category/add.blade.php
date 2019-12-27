<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/js/layer/layer.js"></script>
    <style>
        ul{
            list-style-type: none;
        }
        li{
            padding: 10px;
            margin: 10px;
        }
        .errors{
            display: inline-block;
            padding-left: 20px;
            background: url("/image/error.png") no-repeat 5px 5px;
        }
    </style>
</head>
<body>
{{--{{$errors -> all()}}--}}{{ $errors -> first('cate_name')}}
<ul>
    <form action="" method="post">
        {{csrf_field()}}
        <li>
            <label for="parent_name">上级分类名称:</label>
            <input type="text" id="parent_name" name="parent_name" disabled value="{{$parentName or '顶级分类'}}" style="line-height: 2em;text-indent: 5px">
        </li>
        <li>
            <label for="cate_name">&emsp;&emsp;分类名称:</label>
            <input type="text" id="cate_name" name="cate_name" style="line-height: 2em"><span class="errors">{{ $errors -> first('cate_name')}}</span>
        </li>
        <li>
            <input type="button" value="添加" style="width: 60px;background-color:#b471a0;display: inline-block;margin-left:60%" >
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
               layer.msg(data.msg,{icon:6,time:1000,shade:[0.6]},function () {
                   layer.confirm('是否继续添加?',{btn:['继续添加','去列表页面'],title:'跳转提示'},
                       function (index) {
                           //继续添加
                           //刷新添加页面
                           location.reload(true);
                           //关闭询问层
                           parent.layer.close(index);
                           //不关闭弹窗刷新列表页面
                           top.iframe.location.reload(true);
                       },
                       function () {
                           //刷新列表页
                           top.iframe.location.reload(true);
                           //关闭弹层
                           parent.layer.closeAll();
                       }
                   );
               });
           } else {
               layer.msg(data.msg,{icon:5,time:2000,shade:[0.6]})
           }
       },
           error:function (xhr) {
               var errors = JSON.parse(xhr.responseText).errors;
               $('.errors').text(errors['cate_name']);
               console.log(errors);
           }
       })
    });
</script>
</html>