<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/admin/css/style.css"/>
    <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/colorbox.css">
    <!--图片相册-->
    <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
    <![endif]-->
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script type="/admin/js/jquery-1.8.3.min.js"></script>
    <script src="/admin/assets/js/jquery.colorbox-min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script type="text/javascript" src="/admin/Widget/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="/admin/Widget/swfupload/swfupload.queue.js"></script>
    <script type="text/javascript" src="/admin/Widget/swfupload/swfupload.speed.js"></script>
    <script type="text/javascript" src="/admin/Widget/swfupload/handlers.js"></script>
    <script rel="stylesheet" href="/js/preview/preview.css"></script>
    <script rel="stylesheet" href="/js/webuploader/webuploader.css"></script>

    <script type="/js/preview/preview.js"></script>
    <script type="/js/webuploader/webuploader.js"></script>
    <script type="/js/webuploader/upload.js"></script>
    <script type="/js/layer/layer.js"></script>
    <title>广告管理</title>
</head>
<body>
<div class="page-content clearfix">
    <div class="sort_adsadd_style">
        <div class="border clearfix">
        <span class="l_f">
        <a href="<?php echo e(route('bg.advertis.add')); ?>" title="添加品牌" class="btn btn-warning Order_form"><i class="fa fa-plus"></i> 添加广告</a>
        <a href="<?php echo e(route('bg.advertis.deletes')); ?>" class="btn advertis-deletes"><i class="fa fa-trash"></i> 批量删除</a>
        <a href="javascript:ovid()" onClick="javascript :history.back(-1);" class="btn btn-info"><i class="fa fa-reply"></i> 返回上一步</a>
        </span>
            <span class="r_f">共：<b></b>个品牌</span>
        </div>
        <!--列表样式-->
        <div class="sort_Ads_list">
            <form action="">
                <?php echo e(csrf_field()); ?>

            <table class="table table-striped table-bordered table-hover" id="sample-table">
                <thead>
                <tr>
                    <th width="25px"><label><input name="chkAll" type="checkbox" checked="checked" class="ace"><span class="lbl"></span></label></th>
                    <th width="80px">ID</th>
                    <th width="100px">广告名称</th>
                    <th width="100px">分类</th>
                    <th width="240px">图片</th>
                    <th width="200px">链接地址</th>
                    <th width="180px">加入时间</th>
                    <th width="70Ppx">状态</th>
                    <th width="250px">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $advertis_index; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="deletes1">
                    <td><label><input name="chk[]" type="checkbox" value="<?php echo e($v -> id); ?>" class="ace"><span class="lbl"></span></label></td>
                    <td><?php echo e($v -> id); ?></td>
                    <td><?php echo e($v -> advertis_name); ?></td>
                    <td><?php echo e($v -> classify); ?></td>
                    <td><?php echo e($v -> image); ?></td>
                    <td><?php echo e($v -> gery); ?></td>
                    <td><?php echo e(date('Y-m-d H:i:s',$v -> add_time)); ?></td>
                    <td><?php echo e($v -> active== 1 ? '显示':'不显示'); ?></td>
                    <td class="td-manage">
                        <a title="状态" href="<?php echo e(route('bg.advertis.active',['id'=>$v->id,'active'=>$v->active])); ?>"   class="btn advertis-active btn-success"><i class="fa fa-check  bigger-120"></i></a>
                        <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120">编辑</i></a>
                        <a title="删除" href="<?php echo e(route('bg.advertis.delete',['id'=>$v->id])); ?>"   class="btn advertis-delete btn-warning"><i class="fa fa-trash  bigger-120">删除</i></a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9">
                            <h3>没找到满足条件的数据</h3>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </form>
        </div>
    </div>
</div>
<script>
    /*******添加广告*********/
    $('#ads_add').on('click', function(){
        layer.open({
            type: 1,
            title: '添加广告',
            maxmin: true,
            shadeClose: false, //点击遮罩关闭层
            area : ['800px' , ''],

            content:$('#add_ads_style'),
            btn:['提交','取消'],
            yes:function(index,layero){
                var num=0;
                var str="";
                $(".add_adverts input[type$='text']").each(function(n){
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
        });
    })
</script>
<script type="text/javascript">
    function updateProgress(file) {
        $('.progress-box .progress-bar > div').css('width', parseInt(file.percentUploaded) + '%');
        $('.progress-box .progress-num > b').html(SWFUpload.speed.formatPercent(file.percentUploaded));
        if(parseInt(file.percentUploaded) == 100) {
            // 如果上传完成了
            $('.progress-box').hide();
        }
    }

    function initProgress() {
        $('.progress-box').show();
        $('.progress-box .progress-bar > div').css('width', '0%');
        $('.progress-box .progress-num > b').html('0%');
    }



    function successAction(fileInfo) {
        var up_path = fileInfo.path;
        var up_width = fileInfo.width;
        var up_height = fileInfo.height;
        var _up_width,_up_height;
        if(up_width > 120) {
            _up_width = 120;
            _up_height = _up_width*up_height/up_width;
        }
        $(".logobox .resizebox").css({width: _up_width, height: _up_height});
        $(".logobox .resizebox > img").attr('src', up_path);
        $(".logobox .resizebox > img").attr('width', _up_width);
        $(".logobox .resizebox > img").attr('height', _up_height);
    }

    var swfImageUpload;
    $(document).ready(function() {
        //状态
        $('.advertis-active').click(function(){
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
        //删除
        $('.advertis-delete').click(function(){
            me = this;
            //异步提交
            layer.confirm('真的要删除吗？',{icon:3,title:'删除提示'},function(){
                $.get($(me).attr('href'),'',function(data){
                    if(data.status === 'ok'){
                        //删除成功
                        layer.msg(data.msg,{icon:6,shade:[0.5],time:2000},function(){
                            $(me).closest('tr').detach();
                        })
                    }else{
                        //删除失败
                        layer.msg(data.msg,{icon:5,shade:[0.5],time:2000})
                    }
                },'json')
            });
            //阻止默认的超链接行为
            return false;
        });
        //全选全不选
        $('input[name="chkAll"]').click(function(){
            $('input[name="chk[]"]').prop('checked',$(this).prop('checked'));
        });
        $('input[name="chk[]"]').click(function(){
            $('input[name="chkAll"]').prop('checked',!$('input[name="chk[]"]:not(:checked)').length);
        });
        //批量删除
        $('.advertis-deletes').click(function(){
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

        var settings = {
            flash_url : "/admin/Widget/swfupload/swfupload.swf",
            flash9_url : "/admin/Widget/swfupload/swfupload_fp9.swf",
            upload_url: "upload.php",// 接受上传的地址
            file_size_limit : "5MB",// 文件大小限制
            file_types : "*.jpg;*.gif;*.png;*.jpeg;",// 限制文件类型
            file_types_description : "图片",// 说明，自己定义
            file_upload_limit : 100,
            file_queue_limit : 0,
            custom_settings : {},
            debug: false,
            // Button settings
            button_image_url: "admin/Widget/swfupload/upload-btn.png",
            button_width: "95",
            button_height: "30 ",
            button_placeholder_id: 'uploadBtnHolder',
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_cursor : SWFUpload.CURSOR.HAND,
            button_action: SWFUpload.BUTTON_ACTION.SELECT_FILE,

            moving_average_history_size: 40,

            // The event handler functions are defined in handlers.js
            swfupload_preload_handler : preLoad,
            swfupload_load_failed_handler : loadFailed,
            file_queued_handler : fileQueued,
            file_dialog_complete_handler: fileDialogComplete,
            upload_start_handler : function (file) {
                initProgress();
                updateProgress(file);
            },
            upload_progress_handler : function(file, bytesComplete, bytesTotal) {
                updateProgress(file);
            },
            upload_success_handler : function(file, data, response) {
                // 上传成功后处理函数
                var fileInfo = eval("(" + data + ")");
                successAction(fileInfo);
            },
            upload_error_handler : function(file, errorCode, message) {
                alert('上传发生了错误！');
            },
            file_queue_error_handler : function(file, errorCode, message) {
                if(errorCode == -110) {
                    alert('您选择的文件太大了。');
                }
            }
        };
        swfImageUpload = new SWFUpload(settings);
    });
    jQuery(function($) {
        var colorbox_params = {
            reposition:true,
            scalePhotos:true,
            scrolling:false,
            previous:'<i class="fa fa-chevron-left"></i>',
            next:'<i class="fa fa-chevron-right"></i>',
            close:'&times;',
            current:'{current} of {total}',
            maxWidth:'100%',
            maxHeight:'100%',
            onOpen:function(){
                document.body.style.overflow = 'hidden';
            },
            onClosed:function(){
                document.body.style.overflow = 'auto';
            },
            onComplete:function(){
                $.colorbox.resize();
            }
        };

        $('.table-striped [data-rel="colorbox"]').colorbox(colorbox_params);
        $("#cboxLoadingGraphic").append("<i class='icon-spinner orange'></i>");

    });

    jQuery(function($) {
    var oTable1 = $('#sample-table').dataTable( {
        "aaSorting": [[ 1, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable":false,"aTargets":[0,2,3,4,5,7,8,]}// 制定列不参与排序
        ] } );




    // $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
   /* function tooltip_placement(context, source) {
        var $source = $(source);
        var $parent = $source.closest('table')
        var off1 = $parent.offset();
        var w1 = $parent.width();

        var off2 = $source.offset();
        var w2 = $source.width();

        if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
        return 'left';
    }*/
})
</script>