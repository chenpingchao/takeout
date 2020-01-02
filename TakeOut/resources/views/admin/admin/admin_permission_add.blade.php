<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/admin/css/style.css"/>
    <link href="/admin/css/select.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
    <![endif]-->
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/js/dragDivResize.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/js/jquery.idTabs.min.js"></script>
    <script type="text/javascript" src="/admin/js/select-ui.min.js"></script>
    <title>分类添加</title>
</head>
<body>
<div class="formbody">
    @if (count($errors) > 0)
        <div>
            <ul class="validate_error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="" method="post">
                {{csrf_field()}}
                <input type="hidden" name="pid" value="{{$permission->id or 0}}"/>
                <ul class="forminfo">
                    <li>
                        <label>上级权限<b>*</b></label>
                        <input  disabled type="text" value="{{$permission->display_name or '顶级权限'}}" class="dfinput" style="width:408px;"/>
                    </li>
                    <li>
                        <label>权限路由名称<b>*</b></label>
                        <input name="name" type="text"  value="{{old('name')}}" class="dfinput" style="width:408px;"/>

                    </li>
                    <li>
                        <label>权限显示名称<b>*</b></label>
                        <input name="display_name" type="text"  value="{{old('display_name')}}" class="dfinput" style="width:408px;"/>
                    </li>

                    <li>
                        <label>&nbsp;</label>
                        <input type="submit" class="btn" value="确认添加"/>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    if('{{session('status')}}'=='ok'){
        parent.layer.msg('添加成功',{
            icon:1,
            time:1000,
            shade:[0.6,'#000000']
        },function(){
            top.iframe.location.reload();
            parent.layer.closeAll();//父 关弹
            //parent.location("route('bg.admin.Power_add')")
        })
    }else if('{{session('status')}}'=='error'){
        parent.layer.msg('添加失败',{
            icon:2,
            time:1000,
            shade:[0.6,'#000000']
        })
    }
</script>
</html>