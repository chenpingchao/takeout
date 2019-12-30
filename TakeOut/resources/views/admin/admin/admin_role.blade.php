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
    <div class="left_Competence_add">
        <div class="title_name"><span style="margin-left:130px;">添加管理角色</span></div>
        <form action="" method="post" id="form1">
            {{csrf_field()}}
            <div class="Competence_add">
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 角色名称 </label>
                <div class="col-sm-9">
                    <input type="text" name="role_name" id="form-field-1" placeholder="管理角色" style="width: 350px;" class="col-xs-10 col-sm-5">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 角色描述 </label>
                <div class="col-sm-9">
                    <textarea name="detail" class="form-control" id="form_textarea" placeholder="角色描述" onkeyup="checkLength(this);"></textarea>
                    <span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span>字</span>
                </div>
            </div>
{{--            <div class="form-group">--}}
{{--                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 用户选择 </label>--}}
{{--                <div class="col-sm-9">--}}
{{--                    <label class="middle">--}}
{{--                        <input class="ace" type="checkbox" id="id-disable-check">--}}
{{--                        <span class="lbl"> sm123456</span>--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!--按钮操作-->
            <div class="Button_operation">
                <button id="add_admin_roule"  class="btn btn-primary radius"><i class="fa fa-save "></i> 保存并提交</button>
                <button onclick="layer_close();" class="btn btn-default radius" type="button"><i class="fa fa-reply"></i>&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
        </form>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    //表单提交 管理员角色表
    $('#add_admin_roule').click(function () {
        $.post('{{route('bg.admin.ad_Role')}}',$('#form1').serialize(),function(data){
            if (data.status==='ok'){
                parent.layer.msg(data.msg,{icon:6,shade:[0.6]},function(){
                    // parent.location=data.url;
                    parent.layer.closeAll();
                })
            } else{
                parent.layer.msg(data.msg,{icon:5,shade:[0.6]},function () {
                    //重定向窗口
                    parent.layer.closeAll();
                });
            }
        },'json');
        return false;
    })
</script>
<script type="text/javascript">
    //初始化宽度、高度
    $(".left_Competence_add,.Competence_add_style").height($(window).height()).val();;
    $(".Assign_style").width($(window).width()-500).height($(window).height()).val();
    $(".Select_Competence").width($(window).width()-500).height($(window).height()-40).val();
    //当文档窗口发生改变时 触发
    $(window).resize(function(){
        $(".Assign_style").width($(window).width()-500).height($(window).height()).val();
        $(".Select_Competence").width($(window).width()-500).height($(window).height()-40).val();
        $(".left_Competence_add,.Competence_add_style").height($(window).height()).val();;
    });
    /*字数限制*/
    function checkLength(which) {
        var maxChars = 200; //
        if(which.value.length > maxChars){
            layer.open({
                icon:2,
                title:'提示框',
                content:'您出入的字数超多限制!',
            });
            // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
            which.value = which.value.substring(0,maxChars);
            return false;
        }else{
            var curr = maxChars - which.value.length; //250 减去 当前输入的
            document.getElementById("sy").innerHTML = curr.toString();
            return true;
        }
    };
    /*关闭弹出框口*/
    function layer_close(){
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    }
</script>
