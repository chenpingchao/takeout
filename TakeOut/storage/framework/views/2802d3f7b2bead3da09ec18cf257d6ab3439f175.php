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
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>4
    <script src="/admin/js/displayPart.js" type="text/javascript"></script>
    <title>店铺审核</title>
</head>

<body>
<div class="margin clearfix">
    <div class="Shops_Audit">
        <div class="prompt">当前共有<b><?php echo e($shop_audit_num); ?></b>家店铺申请入住</div>
        <!--申请列表-->
        <div class="audit_list">
            <table class="table table-striped table-bordered table-hover" id="sample-table">
                <thead>
                <tr>
                    <th width="100px">编号</th>
                    <th width="180px">店铺名称</th>
                    <th width="180px">店铺持有人</th>
                    <th width="">简介</th>
                    <th width="150px">添加时间</th>
                    <th width="100px">审核状态</th>
                    <th width="250px">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $shop_audit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($v -> id); ?></td>
                    <td><?php echo e($v -> shop_name); ?></td>
                    <td><?php echo e($v -> sm_name); ?></td>
                    <td><?php echo e(mb_strcut($v -> detail,0,75)); ?></td>
                    <td><?php echo e(date('Y-m-d H:i:s',$v -> add_time)); ?></td>
                    <td>待审核</td>
                    <td class="td-manage">
                        <a title="店铺详细" href="<?php echo e(route('bg.shop.detail',['id'=>$v->id])); ?>" class="btn btn-xs btn-info Refund_detailed">详细</a>
                        <a title="删除" href="<?php echo e(route('bg.shop.delete',['id'=>$v->id])); ?>" class="btn shop-delete1 btn-danger" >删除</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <td colspan="7">
                        <h3>没有找到相关内容</h3>
                    </td>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
<script>
    $(function () {
        $(".displayPart").displayPart();
    });
    $(function() {
        var oTable1 = $('#sample-table').dataTable( {
            //"aaSorting": [],//默认第几个排序
            "bStateSave": true,//状态保存
            //"dom": 't',
            "bFilter":false,
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,1,2,3,4,5,6]}// 制定列不参与排序
            ] } );
        $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function(){
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });

        });
    })
    /*店铺-删除*/
    $('.shop-delete1').click(function(){
        me = this;
        layer.confirm('确认要删除吗？',{icon:3,title:'删除提示'},function(){
            $.get($(me).attr('href'),'',function (data) {
                if(data.status === 'ok'){
                    layer.msg(data.msg,{icon:6,shade:[0.5],time:2000},function(){
                        $(me).closest('tr').detach()
                    })
                }else{
                    layer.msg(data.msg,{icon:5,shade:[0.5],time:2000})
                }
            },'json');
        });
        //阻止默认的提交行为
        return false;
    });
    //面包屑返回值
    var index = parent.layer.getFrameIndex(window.name);
    parent.layer.iframeAuto(index);
    $('.Refund_detailed').on('click', function(){
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
</script>
