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
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/js/H-ui.js" type="text/javascript"></script>
    <script src="/admin/js/displayPart.js" type="text/javascript"></script>
    <title>文章分类</title>
</head>

<body>
<div class="margin clearfix">
    <div class="sort_style">
        <div class="border clearfix">
        <span class="l_f">
        <a href="javascript:ovid()" id="add_page" class="btn btn-warning" onclick="add_article_sort()"><i class="fa fa-plus"></i> 添加分类</a>
        <a href="<?php echo e(route('bg.article.deletes1')); ?>" class="btn article_deletes1 btn-danger"><i class="fa fa-trash"></i> 批量删除</a>
        </span>
            <span class="r_f">共：<b>5</b>分类</span>
        </div>
        <!--分类类表-->
        <div class="article_sort_list">
            <form>
                <?php echo e(csrf_field()); ?>

            <table class="table table-striped table-bordered table-hover" id="sample-table">
                <thead>
                <tr>
                    <th width="25"><label><input type="checkbox" checked="checked" name="chkAll" class="ace"><span class="lbl"></span></label></th>
                    <th width="80px">ID</th>
                    <th width="150px">分类名称</th>
                    <th width="">简介</th>
                    <th width="80px">状态</th>
                    <th width="150px">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $article_sort; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><label><input type="checkbox" name="chk[]" value="<?php echo e($v -> id); ?>" class="ace"><span class="lbl"></span></label></td>
                    <td><?php echo e($v -> id); ?></td>
                    <td><?php echo e($v -> article_name); ?></td>
                    <td><?php echo e($v -> dateil); ?></td>
                    <td><?php echo e($v -> active == 1 ? '发布':'未发布'); ?></td>
                    <td class="td-manage">
                        <a title="编辑" onclick="member_edit('510')" href="javascript:;"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>
                        <a title="删除" href="<?php echo e(route('bg.article.delete1',['id'=>$v -> id])); ?>" class="btn btn-xs article_delete1 btn-danger" ><i class="fa fa-trash  bigger-120"></i></a>
                    </td>
                </tr>
                </tbody>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <td colspan="8">
                        <h3>没有找到相关内容</h3>
                    </td>
                <?php endif; ?>
            </table>
            </form>
        </div>
    </div>
</div>
<!--添加文章分类图层-->
<div id="addsort_style" style="display:none" class="article_style">
    <div class="add_content" id="form-article-add">
        <ul>
            <li class="clearfix Mandatory"><label class="label_name"><i>*</i>分类名称</label>
                <span class="formControls w_txt"><input name="articelname" type="text" id="form-field-1" class="col-xs-7 col-sm-5 "></span>
            </li>
            <li class="clearfix"><label class="label_name">排序</label>
                <span class="formControls w_txt"><input name="pid" type="text" id="form-field-1" value="0" class="col-xs-7 col-sm-2 "></span>
            </li>
            <li class="clearfix"><label class="label_name">简介</label>
                <span class="formControls w_txt"><textarea name="detail" class="form-control" id="form_textarea" placeholder="" onkeyup="checkLength(this);"></textarea><span  style=" margin-left:10px;">剩余字数：<span id="sy" style="color:Red;">200</span>字</span></span>
            </li>
        </ul>
    </div>
</div>
</body>
</html>
<script>
    $(function(){
        var oTable1 = $('#sample-table').dataTable( {
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,2,3,4,6,7,]}// 制定列不参与排序
            ]});
        $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function(){
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });
        });
    });
    /**添加分类**/
    function add_article_sort(index){
        layer.open({
            type: 1,
            title: '添加文章分类',
            maxmin: true,
            shadeClose: true, //点击遮罩关闭层
            area : ['600px' , ''],
            content:$('#addsort_style'),
            btn:['提交','取消'],
            yes:function(index,layero){
                var num=0;
                var str="";
                $(".Mandatory input[type$='text']").each(function(n){
                    if($(this).val()=="")
                    {
                        layer.alert(str+=""+$(this).attr("name")+"不能为空！\r\n",{
                            title: '提示框',
                            icon:0,
                        });
                        num++;
                        return false;
                    }
                });
                if(num>0){  return false;}
                else{
                    layer.alert('添加成功！',{
                        title: '提示框',
                        icon:1,
                    });
                    layer.close(index);
                }

            }
        })
    }
    /*文章-删除*/
    $('.article_delete1').click(function () {
        me = this;
        layer.confirm('真的要删除吗？', {icon: 3, title: '删除提示'}, function () {
            $.get($(me).attr('href'), '', function (data) {
                if (data.status === 'ok') {
                    layer.msg(data.msg, {icon: 6, shade: [0.5], time: 2000}, function () {
                        $(me).closest('tr').detach();
                    })
                } else {
                    layer.msg(data.msg, {icon: 5, shade: [0.5], time: 2000})
                }
            }, 'json');
        });
        //阻止超链接的默认行为
        return false;
    });
    //全选全不选
    $('input[name="chkAll"]').click(function(){
        $('input[name="chk[]"]').prop('checked',$(this).prop('checked'));
    });
    $('input[name="chk[]"]').click(function(){
        $('input[name="chkAll"]').prop('checked',!$('input[name="chk[]"]:not(:checked)').length)
    });
    //批量删除
    $('.article_deletes1').click(function(){
        me = this;
        layer.confirm('确认都要删除吗？',{icon:3,title:'删除提示'},function(){
            $.post($(me).attr('href'),$('form').serialize(),function(data){
                if(data.status === 'ok'){
                    layer.msg(data.msg,{icon:6,shade:[0.5],time:2000},function(){
                        $('input[name="chk[]"]:checked').closest('tr').detach();
                    })
                }else{
                    layer.msg(data.msg,{icon:5,shade:[0.5],time:2000})
                }
            })
        });
        //阻止默认的超链接行为
        return false;
    });
</script>
