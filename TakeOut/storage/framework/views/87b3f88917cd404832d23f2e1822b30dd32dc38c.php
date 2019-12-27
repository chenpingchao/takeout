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
    <title>店铺列表</title>

</head>
<body>
<div class="clearfix">
    <div class="article_style" id="article_style">
        <!--文章列表-->
        <div class="Ads_list" style="margin-left:0px; ">
            <div class="search_style">
                <ul class="search_content clearfix">
                    <li><label class="l_f">报表类型</label><select name="" style=" width:150px"><option>--选择报表类型--</option></select></li>
                    <li><label class="l_f">信息来源</label><input name="" type="text" class="text_add" placeholder="信息来源" style=" width:150px"></li>
                    <li><label class="l_f">咨询方式</label><input name="" type="text" class="text_add" placeholder="咨询方式" style=" width:150px"></li>
                    <li><label class="l_f">校区</label><input name="" type="text" class="text_add" placeholder="校区" style=" width:200px"></li>
                    <li><label class="l_f">添加时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
                    <li style="width:90px;"><button type="button" class="btn_search"><i class="fa fa-search"></i>查询</button></li>
                </ul>
            </div>
            <div class="border clearfix"><span class="l_f"><a href="<?php echo e(route('bg.shop.deletes')); ?>" class="btn shop-deletes"><i class="fa fa-trash"></i> 批量删除</a></span>
                <span class="r_f">共：<b></b>家</span>
            </div>
            <div class="article_list">
                <form action="">
                <?php echo e(csrf_field()); ?>

                <table class="table table-striped table-bordered table-hover" id="sample-table">
                    <thead>
                    <tr>
                        <th width="25px"><label><input type="checkbox" name="chkAll" checked="checked" class="ace"><span class="lbl"></span></label></th>
                        <th width="80px">排序</th>
                        <th width="150px">店铺名称</th>
                        <th width="100px">店铺评分</th>
                        <th width="100px">平均消费</th>
                        <th width="100px">简介</th>
                        <th width="120px">店铺电话</th>
                        <th width="120px">店铺地址</th>
                        <th width="150px">添加时间</th>
                        <th width="100px">状态</th>
                        <th width="100px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $shop_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><label><input type="checkbox" name="chk[]" value="<?php echo e($v -> id); ?>" class="ace"><span class="lbl"></span></label></td>
                        <td><?php echo e($v -> id); ?></td>
                        <td><?php echo e($v -> shop_name); ?></td>
                        <td><?php echo e($v -> grade); ?></td>
                        <td><?php echo e($v -> avg_price); ?></td>
                        <td><?php echo e($v -> detail); ?></td>
                        <td><?php echo e($v -> shop_moble); ?></td>
                        <td><?php echo e($v -> site); ?></td>
                        <td><?php echo e(date('Y-m-d H:i:s',$v -> add_time)); ?></td>
                        <td><a href="<?php echo e(route('bg.shop.active1',['id'=>$v->id,'active'=>$v->active])); ?>" class="shop-active1">
                                <?php echo e($v -> active== 1 ? '工作中':'打烊了'); ?>

                            </a></td>
                        <td class="td-manage">
                            <a title="删除" href="<?php echo e(route('bg.shop.delete',['id'=>$v->id])); ?>" class="btn shop-delete btn-danger" ><i class="fa fa-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <td colspan="11">
                            <h3>没有找到相关内容</h3>
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
    laydate({
        elem: '#start',
        event: 'focus'
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
        parent.layer.close(index);
    });
    $(function() {
        var oTable1 = $('#sample-table').dataTable( {
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,2,3,4,5,7,8]}// 制定列不参与排序
            ] } );
    });

    $('.shop-active1').click(function(){
        me = this;
        //异步提交
        $.get($(this).attr('href'),'',function(data){
            if(data.status === 'ok'){
                //激活成功
                $(me).text(data.text).attr('href',data.href);
                layer.tips(data.msg,me,{tips:[2,'#084']});
            }else{
                //激活失败
                layer.tips(data.msg,me,{tips:[2,'#800']})
            }
        },'json');
        //阻止超链接的默认行为
        return false;
    });
    $(document).ready(function() {
        //删除
        $('.shop-delete').click(function () {
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
        $('.shop-deletes').click(function(){
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
    })
</script>