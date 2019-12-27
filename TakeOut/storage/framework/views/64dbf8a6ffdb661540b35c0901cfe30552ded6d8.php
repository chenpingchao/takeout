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
		<script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
        <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
        <script src="/admin/assets/js/bootstrap.min.js"></script>
		<script src="/admin/assets/js/typeahead-bs2.min.js"></script>
		<script src="/admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
        <link href="/admin/css/validate.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/admin/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="/admin/js/jquery.idTabs.min.js"></script>

<title>个人信息管理</title>
</head>

<body>
<div class="clearfix">
    <div class="admin_info_style">
        <div class="admin_modify_style" id="Personal">
            <div class="type_title">管理员信息 </div>
            <div class="xinxi">
                <form action="" method="post" id="form1">
                    <?php echo e(csrf_field()); ?>

                <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">用户名： </label>
                    <div class="col-sm-9">
                        <input type="text" name="username"  value="<?php echo e($admin->username); ?>" class="col-xs-7 text_info" disabled="disabled">&nbsp;&nbsp;&nbsp;
                        <a href="javascript:ovid()" onclick="change_Password()" class="btn btn-warning btn-xs">修改密码</a>
                    </div>
                </div>
                <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">性别： </label>
                    <div class="col-sm-9">
                        <span class="sex"><?php echo e($admin->sex); ?></span>
                        <div class="add_sex">
                            <label><input name="sex" value="保密" type="radio" class="ace" checked="checked"><span class="lbl">保密</span></label>&nbsp;&nbsp;
                            <label><input name="sex" value="男" type="radio" class="ace"><span class="lbl">男</span></label>&nbsp;&nbsp;
                            <label><input name="sex" value="女" type="radio" class="ace"><span class="lbl">女</span></label>
                        </div>
                    </div>
                </div>

                <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">移动电话： </label>
                    <div class="col-sm-9">
                        <input type="text" name="moble" id="" value="<?php echo e($admin->moble); ?>" class="col-xs-7 text_info" disabled="disabled">
                    </div>
                </div>

                <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">电子邮箱： </label>
                    <div class="col-sm-9">
                        <input type="text" name="email" value="<?php echo e($admin->email); ?>" class="col-xs-7 text_info" disabled="disabled">
                    </div>
                </div>

                <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">权限： </label>
                    <div class="col-sm-9" > <span>
                            <?php
                            //{{$v->grade}}
                            switch($admin['grade']){
                                case 1:
                                    echo '超级管理员';
                                    break;
                                case 2:
                                    echo '普通管理员';
                                    break;
                                case 3:
                                    echo '栏目主编';
                                    break;
                                case 4:
                                    echo '栏目编辑';
                                    break;
                            }
                            ?>
                        </span></div>
                </div>
                <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">注册时间： </label>
                    <div class="col-sm-9" > <span><?php echo e($admin->add_time?date('Y-m-d H:i:s',$admin->add_time):'开天之物'); ?></span></div>
                </div>
                <div class="Button_operation clearfix">
                    <button onclick="modify();" class="btn btn-danger radius" type="button">修改信息</button>
                    <button onclick="" class="btn btn-success radius" id="admin_update" type="button">保存修改</button>
                </div>
                </form>
            </div>
        </div>
        <div class="recording_style">
            <div class="type_title">管理员登陆记录 </div>
            <div class="recording_list">
                <form action="">
                    <?php echo e(csrf_field()); ?>

                <table class="table table-border table-bordered table-bg table-hover table-sort" id="sample-table">
                    <thead>
                    <tr class="text-c">
                        <th width="80">ID</th>
                        <th width="100">状态</th>
                        <th>内容</th>
                        <th width="10%">用户名</th>
                        <th width="120">客户端IP</th>
                        <th width="150">时间</th>
                    </tr>
                    </thead>
                    <?php $__empty_1 = true; $__currentLoopData = $admin_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tbody>
                    <tr>
                        <td><?php echo e($admin_logs->firstItem()+$k); ?></td>
                        <td><?php echo e($v->active==1?'激活':'禁用'); ?></td>
                        <td>
                            <?php echo e($v->active==1?'登陆成功':'登录失败'); ?>

                        </td>
                        <td><?php echo e($v->ad_name); ?></td>
                        <td><?php echo e($v->login_ip); ?></td>
                        <td><?php echo e($v->login_time?date('Y-m-d H:i:s',$v->login_time):'开天之物'); ?></td>
                    </tr>
                    </tbody>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td>
                                <h3>没找到满足条件的数据</h3>
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
                    <div>共<?php echo e($admin_logs->total()); ?>条记录,当前页为第<?php echo e($admin_logs->currentPage()); ?>页</div>
                    <div align="right">
                        <?php echo e($admin_logs->links()); ?>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--修改密码样式-->
<div class="change_Pass_style" id="change_Pass">
    <form action=""  id="pwd">
        <?php echo e(csrf_field()); ?>

    <ul class="xg_style forminfo">
        <li><label class="label_name">原&nbsp;&nbsp;密&nbsp;码</label><input name="oldpwd" type="password"  class="dfinput" placeholder="请填写原密码"></li>
        <div  class="validate-error oldpwd"></div>
        <li><label class="label_name">新&nbsp;&nbsp;密&nbsp;码</label><input name="password" type="password" class="dfinput" placeholder="请填写管理员密码" ></li>
        <div  class="validate-error password"></div>
        <li><label class="label_name">确认密码</label><input name="repwd" type="password" class="dfinput" placeholder="请确认管理员密码"></li>
        <div  class="validate-error repwd"></div>
    <div class="center"><input  type="submit" class="btn btn-primary" value="确认修改"/></div>
    </ul>
    </form>
</div>
</body>
</html>
<script>

    //按钮点击事件
    function modify(){
        $('.text_info').attr("disabled", false);
        $('.text_info').addClass("add");
        $('#Personal').find('.xinxi').addClass("hover");
        $('#Personal').find('.btn-success').css({'display':'block'});
    };
    // function save_info(){
    //     var num=0;
    //     var str="";
    //     $(".xinxi input[type$='text']").each(function(n){
    //         if($(this).val()=="")
    //         {
    //
    //             layer.alert(str+=""+$(this).attr("name")+"不能为空！\r\n",{
    //                 title: '提示框',
    //                 icon:0,
    //             });
    //             num++;
    //             return false;
    //         }
    //     });
    //     if(num>0){  return false;}
    //     else{
    //
    //         layer.alert('修改成功！',{
    //             title: '提示框',
    //             icon:1,
    //         });
    //         $('#Personal').find('.xinxi').removeClass("hover");
    //         $('#Personal').find('.text_info').removeClass("add").attr("disabled", true);
    //         $('#Personal').find('.btn-success').css({'display':'none'});
    //         layer.close(index);
    //
    //     }
    // };
    //初始化宽度、高度
    $(".admin_modify_style").height($(window).height());
    $(".recording_style").width($(window).width()-400);
    //当文档窗口发生改变时 触发
    $(window).resize(function(){
        $(".admin_modify_style").height($(window).height());
        $(".recording_style").width($(window).width()-400);
    });
    //修改密码窗口
    function change_Password(){
        layer.open({
            type: 1,
            title:'修改密码',
            area: ['300px','300px'],
            shadeClose: true,
            content: $('#change_Pass'),
        });
    }
</script>
<script>jQuery(function($) {
        var oTable1 = $('#sample-table').dataTable( {
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,2,3,4,5,6]}// 制定列不参与排序
            ] } );
        $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function(){
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });

        });
    });
</script>

<script type="text/javascript">
    $('form').submit(function(){
        $.ajax({
            url:'<?php echo e(route('bg.admin.up_pwd',['id'=>$admin['id']])); ?>',
            type:'post',
            data:$(this).serialize(),
            dataType:'json',
            success:function(data){
                //显示修改成功信息
                if(data.status === 'ok'){
                    layer.msg(data.msg,{icon:6,shade:[0.6]},function(){
                        //关闭窗口
                        layer.closeAll();
                    })
                }else{
                    layer.msg(data.msg,{icon:5,shade:[0.6]})
                }
            },
            error:function(xhr){
                //显示验证信息
                var errors = JSON.parse(xhr.responseText).errors;
                console.log(errors);
                //方式一：
                for(var i in errors){
                    $('.'+i).text(errors[i][0])
                }
            }
        });
        //阻止表单默认提交
        return false;
    })
</script>

<script type="text/javascript">
    $('#admin_update').click(function () {
        $.post('<?php echo e(route("bg.admin.update",['id'=>$admin['id']])); ?>', $('#form1').serialize(), function (data) {
            if(data.status === 'ok'){
                layer.msg(data.msg,{icon:6,shade:[0.6]},function(){
                    //重定向窗口
                    location = data.url;
                })
            }else{
                layer.msg(data.msg,{icon:5,shade:[0.6]})
            }
        }, 'json')
    })
</script>