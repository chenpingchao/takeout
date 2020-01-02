<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/admin/css/style.css"/>
    <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
    <![endif]-->
    <script src="/js/jquery.form.js"></script>
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript"></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/js/dragDivResize.js" type="text/javascript"></script>
    <title>添加管理角色</title>
</head>

<body>
<div class="Competence_add_style clearfix">
    <div style="width:420px" class="left_Competence_add">
        <div class="title_name"><span style="margin-left:130px;">添加管理角色</span></div>
        <form action="" method="post" id="form1">
            {{csrf_field()}}
            <ul class="Competence_add">
                @forelse($admins as $key=>$admin)
                    <li>
                        <input name="chk[]"  type="checkbox" {{$admin->is_member or ''}} value="{{$admin->id}}" />
                        <label>{{$admin->username}}</label>
                    </li>
                @empty
                    <li>
                        <h1>没有找到相关的记录</h1>
                    </li>
                @endforelse
                <li class="Button_operation">
                    <button id="allot_admin_roule"  class="btn btn-primary radius"><i class="fa fa-save "></i> 保存并提交</button>
                    <button onclick="layer_close();" class="btn btn-default radius" type="button"><i class="fa fa-reply"></i>&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                </li>
            <!--按钮操作-->
            </ul>
        </form>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    //表单提交 管理员角色表
    $('#allot_admin_roule').click(function () {
        $.post('{{route('bg.admin.ad_Role_allot',['roleId'=>$roleId])}}',$('#form1').serialize(),function(data){
            if (data.status==='ok'){
                parent.layer.msg(data.msg,{icon:6,shade:[0.6]},function(){
                    // parent.location=data.url;
                    top.iframe.location.reload();
                    parent.layer.closeAll();
                })
            } else{
                parent.layer.msg(data.msg,{icon:2, time:2000, shade:[0.6,'#000000']})
            }
        },'json');
        return false;
    })
</script>
<script type="text/javascript">
    /*关闭弹出框口*/
    function layer_close(){
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    }
</script>
