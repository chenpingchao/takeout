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
    <script src="/admin/js/displayPart.js" type="text/javascript"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>

<title>意见反馈</title>
</head>
<body>
    <div class="margin clearfix">
        <div class="Feedback_style">
            <div class="search_style">
                <form action="" >
                    <?php echo e(csrf_field()); ?>

                <ul class="search_content clearfix">
                    <li><label class="l_f">留言</label>
                        <input name="content" type="text" value="<?php echo e($content); ?>" class="text_add" placeholder="输入留言信息" style=" width:250px">
                    </li>
                    <li><label class="l_f">时间</label>
                        <input name="add_time" class="inline laydate-icon" value="<?php echo e(date(" Y-m-d ",$add_time ? $add_time : 1552393600)); ?>" id="start" style=" margin-left:10px;">
                    </li>
                    <li>
                        <label class="l_f">状态</label>
                        <select style="margin-left:10px;" name="active" id="">
                            <option value="" <?php echo e($active != 1 && $active == !2 ? 'selected' : ''); ?>>全部</option>
                            <option value="1" <?php echo e($active == 1 ? 'selected' : ''); ?>>已浏览</option>
                            <option value="2" <?php echo e($active == 2 ? 'selected' : ''); ?>>未浏览</option>
                        </select>
                    </li>
                    <li><label class="l_f">类型</label>
                        <select style="margin-left:10px;" name="type" id="">
                            <option value="" >全部</option>
                            <option value="建议" >建议</option>
                            <option value="投诉" >投诉</option>
                            <option value="其它" >其它</option>
                        </select>
                    </li>
                    <li style="width:90px;">
                        <button type="submit" class="btn_search"><i class="fa fa-search"></i>查询</button>
                    </li>
                </ul>
                </form>
            </div>
            <div class="border clearfix">
                <span class="l_f">
                    <a href="<?php echo e(route('bg.mess.FDeletes')); ?>" class="Feed-deletes btn btn-danger"><i class="fa fa-trash"></i>&nbsp;批量删除</a>
                </span>
                <span class="r_f">共：<b><?php echo e($Feedback->total()); ?></b>条</span>
            </div>
            <div class="feedback">
                <form id="form1" action="">
                    <?php echo e(csrf_field()); ?>

                <table class="table table-striped table-bordered table-hover" id="sample-table">
                    <thead>
                    <tr>
                        <th width="25">
                            <label><input name="chkAll" type="checkbox" class="ace"><span class="lbl"></span></label>
                        </th>
                        <th width="80">编号</th>
                        <th width="100px">姓名</th>
                        <th width="110px">电话</th>
                        <th width="160px">邮箱</th>
                        <th width="">留言内容</th>
                        <th width="180px">时间</th>
                        <th width="80px">状态</th>
                        <th width="100px">类型</th>
                        <th width="130px">删除</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $Feedback; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <label><input name="chk[]" value="<?php echo e($v->id); ?>" type="checkbox" class="ace"><span class="lbl"></span></label>
                        </td>
                        <td><?php echo e($Feedback->firstItem()+$k); ?></td>
                        <td><?php echo e($v->username); ?></td>
                        <td><?php echo e($v->mobile); ?></td>
                        <td><?php echo e($v->email); ?></td>
                        <td class="text-l">
                            <a href="javascript:;" onclick="Guestbook_iew('<?php echo e($v->username); ?>','<?php echo e($v->mobile); ?>','<?php echo e($v->email); ?>','<?php echo e($v->content); ?>','<?php echo e($v->score); ?>','<?php echo e($v->addtime); ?>','<?php echo e(getGrade($v->score)); ?>')" style="overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:3;"><?php echo e($v->content); ?></a>
                        </td>
                        <td><?php echo e(date('Y-m-d H:i:s',$v->add_time)); ?></td>
                        <td class="td-status">
                            <span class="label label-success radius">
                                <a style="color:beige;" href="<?php echo e(route('bg.mess.FeedActive',['id'=>$v->id,'active'=>$v->active])); ?>" class="admin-active tablelink">
                                <?php echo e($v->active==1 ? '已浏览' : '未浏览'); ?></a>
                            </span>
                        </td>
                        <td><?php echo e($v->type); ?></td>
                        <td class="td-manage">
                            <a  href="<?php echo e(route('bg.mess.FDelete',['id'=>$v->id])); ?>"  onclick="member_del(this,'1')" title="删除" class="Feed-delete btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    </tbody>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7">
                                <h3>没找到满足条件的数据</h3>
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
                </form>
                <div>当前页共<?php echo e($Feedback->count()); ?>条记录,为第<?php echo e($Feedback->currentPage()); ?>页</div>
                <div align="right">
                    <?php echo e($Feedback->appends([
                      'content'=>$content,
                      'add_time'=>$add_time,
                      'active'=>$active,
                      'type'=>$type
                  ])->links()); ?>

                </div>
            </div>
        </div>
    </div>
<!--留言详细-->
    <div id="Guestbook" style="display:none">
        <div class="content_style">
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">留言用户 </label>
                <div class="username-one col-sm-9">1</div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">级别 </label>
                <div class="Grade-one col-sm-9"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">注册时间 </label>
                <div class="addtime-one col-sm-9">1</div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">积分 </label>
                <div class="score-one col-sm-9">1</div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">联系电话 </label>
                <div class="mobile-one col-sm-9">1</div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">联系邮箱 </label>
                <div class="email-one col-sm-9">1</div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 留言内容 </label>
                <div class="content-one col-sm-9">1</div>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
/*留言查看*/
function Guestbook_iew(username,mobile,email,content,score,addtime,Grade){
    var index = layer.open({
        type: 1,
        title: '留言信息',
        maxmin: true,
        shadeClose:false,
        area : ['600px' , ''],
        content:$('#Guestbook'),
    })
$(".username-one").text(username);
$('.mobile-one').text(mobile);
$('.email-one').text(email);
$('.content-one').text(content);
$('.score-one').text(score);
$('.addtime-one').text(addtime);
$('.Grade-one').text(Grade);
};

//删除
$('.Feed-delete').click(function () {
    var me=this;
    parent.layer.confirm('确认要删除吗?',{icon:3,title:'删除提示'},function () {
        $.get($(me).attr('href'),'',function (data) {
            if (data.status==='ok'){
                parent.layer.msg(data.msg,{icon:6,shade:[0.6],time:1000},function () {
                    $(me).closest('tr').datach();
                    //     最近的  tr      分离
                    location = data.url;
                })
            } else{
                parent.layer.msg(data.msg,{icon:5,shade:[0.6]})
            }
        },'json')
    });
    //阻止超链接默认行为
    return false;
});

//批量删除
$('.Feed-deletes').click(function () {
    var me=this;
    parent.layer.confirm('确认要删除吗?',{icon:3,title:'删除提示'},function () {
        $.post($(me).attr('href'),$('#form1').serialize(),function (data) {
            if (data.status==='ok'){
                parent.layer.msg(data.msg,{icon:6,shade:[0.6],time:1000},function () {
                    $('input[name="chk[]"]').closest('tr').detach();
                    location = data.url;
                });
            } else{
                parent.layer.msg(data.msg,{icon:5,shade:[0.6]})
            }
        },'json');
    });
    //阻止超链接的默认行为
    return false;
});

laydate({
    elem:'#start',
    theme:'#4060E0'
});
//全选全不选
$('input[name="chkAll"]').click(function(){
    $('input[name="chk[]"]').prop('checked',$(this).prop('checked'));
    //name         //val
});
$('input[name="chk[]"]').click(function(){
    $('input[name="chkAll"]').prop('checked',$(this).prop('checked'));
    //name         //val
});

//管理员激活
$('.admin-active').click(function(){
    var me = this;
    $.get($(this).attr('href'),'',function(data){
        if (data.status==='ok'){
            //激活成功
            $(me).text(data.text).attr('href',data.href);
            layer.tips(data.msg,me,{tips:[1,'#090'],time:2000});
        } else{
            //激活失败
            layer.tips(data.msg,me,{tips:[1,'#900']});
        }
    },'json');
    //阻止超链接的默认行为
    return false;
});
</script>