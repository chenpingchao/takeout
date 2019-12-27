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
        #cate_name{
            display: inline-block;
            width: 169px;
            height: 26px;
        }
    </style>
</head>
<body>
<ul>
    <form action="" method="post">
        {{csrf_field()}}
        <li>
            <label >&emsp;&emsp;分类名称:</label>
            <div id="cate_name">
                {{$category -> sc_name}}
            </div>
            <span class="errors errors-cate_name">{{ $errors -> first('sc_name')}}</span>
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
                if (data.status === 'ok'){
                    //提示信息
                    layer.msg(data.msg,{icon:6,time:1000,shade:[0.6]},function () {
                        //刷新列表页
                        top.iframe.location.reload(true);
                        //关闭弹层
                        parent.layer.closeAll();
                    });
                } else {
                    layer.msg(data.msg,{icon:5,time:2000,shade:[0.6]})
                }
            },
            error:function (xhr){
                var errors = JSON.parse(xhr.responseText).errors;
                for (var i in errors){
                    $('.errors-'+i).text(errors[i][0]);
                }
            }
        })
    });

</script>
</html>
