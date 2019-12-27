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
    <script src="/admin/js/lrtk.js" type="text/javascript" ></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/js/H-ui.js" type="text/javascript"></script>
    <script src="/admin/js/displayPart.js" type="text/javascript"></script>
    <title>文章管理</title>
</head>

<body>
<div class="clearfix" >
    <div class="article_style" id="article_style">
        <div id="scrollsidebar" class="left_Treeview" >
            <div class="show_btn" id="rightArrow"><span></span></div>
            <!--文章列表-->

                <div class="border clearfix" >
                    <span class="l_f">
                        <a href="<?php echo e(route('bg.article.add')); ?>"  title="添加文章" id="add_page" class="btn btn-warning"><i class="fa fa-plus"></i> 添加文章</a>
                        <a href="<?php echo e(route('bg.article.deletes')); ?>" class="btn article_deletes"><i class="fa fa-trash"></i> 批量删除</a>
                    </span>
                    <span class="r_f">共：<b><?php echo e($article_list_num); ?></b>条文章</span>
                </div>
                <div class="article_list">
                <form>
                <?php echo e(csrf_field()); ?>

                <table class="table table-striped table-bordered table-hover" id="sample-table">
                    <thead>
                    <tr>
                        <th width="25"><label><input type="checkbox" checked="checked" name="chkAll" class="ace"><span class="lbl"></span></label></th>
                        <th width="80px">ID</th>
                        <th width="100">所属分类</th>
                        <th width="220px">标题</th>
                        <th width="500px">简介</th>
                        <th width="150px">添加时间</th>
                        <th width="80px">状态</th>
                        <th width="150px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $article_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><label><input type="checkbox" name="chk[]" value="<?php echo e($v -> id); ?>" class="ace"><span class="lbl"></span></label></td>
                        <td><?php echo e($v -> id); ?></td>
                        <td><?php echo e($v -> mid); ?></td>
                        <td><?php echo e($v -> title); ?></td>
                        <td><?php echo e($v -> details); ?></td>
                        <td><?php echo e(date('Y-m-d H:i:s'),$v -> add_time); ?></td>
                        <td><?php echo e($v -> active == 1 ? '发布':'未发布'); ?></td>
                        <td class="td-manage">
                            <a title="编辑" href=""  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>
                            <a title="删除" href="<?php echo e(route('bg.article.delete',['id'=>$v -> id])); ?>"   class="btn article-delete btn-danger" ><i class="fa fa-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <td colspan="8">
                            没有找到相关信息。
                        </td>
                    <?php endif; ?>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    $(function () {
        $(".displayPart").displayPart();
    });
    //面包屑返回值
    var index = parent.layer.getFrameIndex(window.name);
    parent.layer.iframeAuto(index);
    $('#add_page').on('click', function(){
        var cname = $(this).attr("title");
        var chref = $(this).attr("href");
        var cnames = parent.$('.Current_page').html();
        var herf = parent.$("#iframe").attr("src");
        parent.$('#parentIframe').html(cname);
        parent.$('#iframe').attr("src",chref).ready();
        parent.$('#parentIframe').css("display","inline-block");
        parent.$('.Current_page').attr({"name":herf,"href":"javascript:void(0)"}).css({"color":"#4c8fbd","cursor":"pointer"});
        //parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+" class='iframeurl'>" + cnames + "</a>");
        parent.layer.close(index);

    });
    $(function() {
        var oTable1 = $('#sample-table').dataTable( {
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,2,3,4,5,7,]}// 制定列不参与排序
            ] } );

    });

    $(function() {
        $("#article_style").fix({
            float : 'left',
            //minStatue : true,
            skin : 'green',
            durationTime :false,
            stylewidth:'220',
            spacingw:30,//设置隐藏时的距离
            spacingh:250,//设置显示时间距
            set_scrollsidebar:'.Ads_style',
            table_menu:'.Ads_list'
        });
    });
    //初始化宽度、高度  
    $(".widget-box").height($(window).height());
    $(".Ads_list").width($(window).width()-220);
    //当文档窗口发生改变时 触发  
    $(window).resize(function(){
        $(".widget-box").height($(window).height());
        $(".Ads_list").width($(window).width()-220);
    });

    /*文章-删除*/
    $('.article-delete').click(function(){
        me = this;
        layer.confirm('确认要删除吗？',{icon:3,title:'删除提示'},function(){
            $.get($(me).attr('href'),'',function(data){
                if(data.status === 'ok'){
                    layer.msg(data.msg,{icon:6,shade:[0.5],time:2000},function(){
                        $(me).closest('tr').detach();
                    })
                }else{
                    layer.msg(data.msg,{icon:5,shade:[0.5],time:2000})
                }
            },'json')
        });
        //阻止默认的提交行为
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
    $('.article-deletes').click(function(){
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
