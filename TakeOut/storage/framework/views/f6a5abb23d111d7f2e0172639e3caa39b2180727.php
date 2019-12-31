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
    <script type="text/javascript" src="/admin/js/jquery.js"></script>
    <script type="text/javascript" src="/admin/js/jquery.idTabs.min.js"></script>
<title>留言</title>
</head>
<body>
    <!--留言列表-->
    <div class="margin clearfix">
        <div class="Guestbook_style">
            <div class="search_style">
                <form action="" method="post">
                    <?php echo e(csrf_field()); ?>

                    <ul class="search_content clearfix">
                        <li><label class="l_f">管理员名称</label>
                            <input name="username" type="text" value="<?php echo e($username); ?>"  class="text_add" placeholder=""  style=" width:200px"/>
                        </li>
                        <li><label class="l_f">添加时间</label>
                            <input name="add_time" class="inline laydate-icon" value="<?php echo e(date(" Y-m-d ",$add_time ? $add_time : 1352550280)); ?>" id="start" style=" margin-left:10px;">
                        </li>
                        <select name="active" id="">
                            <option value="" <?php echo e($active != 1 && $active == !2 ? 'selected' : ''); ?>>全部</option>
                            <option value="1" <?php echo e($active == 1 ? 'selected' : ''); ?>>已回复</option>
                            <option value="2" <?php echo e($active == 2 ? 'selected' : ''); ?>>未回复</option>
                        </select>
                        <li style="width:90px;">
                            <button type="submit" class="btn_search"><i class="fa fa-search"></i>查询</button>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="border clearfix">
                <span class="l_f">
                    <a href="<?php echo e(route('bg.mess.GDeletes')); ?>" class="Guest-deletes btn btn-danger"><i class="fa fa-trash"></i>&nbsp;批量删除</a>
                </span>
                <span class="r_f">共：<b><?php echo e($Guestbook->total()); ?></b>条</span>
            </div>
            <!--留言列表-->
            <div class="Guestbook_list">
                <form id="form1" action="">
                    <?php echo e(csrf_field()); ?>

                <table class="table table-striped table-bordered table-hover" id="sample-table">
                    <thead>
                    <tr>
                        <th width="25">
                            <label><input name="chkAll" type="checkbox" class="ace"><span class="lbl"></span></label>
                        </th>
                        <th width="80">ID</th>
                        <th width="150px">用户名</th>
                        <th width="">留言内容</th>
                        <th width="200px">时间</th>
                        <th width="100">状态</th>
                        <th width="200">操作</th>
                    </tr>
                    </thead>
                    <?php $__empty_1 = true; $__currentLoopData = $Guestbook; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tbody>
                    <tr>
                        <td>
                            <label><input name="chk[]" value="<?php echo e($v->id); ?>" type="checkbox" class="ace"><span class="lbl"></span></label>
                        </td>
                        <td><?php echo e($Guestbook->firstItem()+$k); ?></td>
                        <td>
                            <a href="<?php echo e(route('bg.mess.MemberShow',['id'=>$v->id])); ?>" style="cursor:pointer;color:dodgerblue;"  class="text-primary"><?php echo e($v->username); ?></a>
                        </td>
                        <td class="text-l">
                            <a href="javascript:;" onclick="Guestbook_iew('<?php echo e($v->id); ?>','<?php echo e($v->username); ?>','<?php echo e($v->content); ?>','<?php echo e($v->mid); ?>')" style="overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:3;"><?php echo e($v->content); ?></a>
                        </td>

                        <td><?php echo e(date('Y-m-d H:i:s',$v->add_time)); ?></td>
                        <td class="td-status">
                            <span class="label label-success radius">
                                <a style="color:beige;" href="<?php echo e(route('bg.mess.GuestActive',['id'=>$v->id,'active'=>$v->active])); ?>" class="admin-active tablelink">
                                <?php echo e($v->active==1 ? '已回复' : '未回复'); ?></a>
                            </span>
                        </td>
                        <td class="td-manage">
                            <a href="javascript:;"  onclick="Guestbook_iew('<?php echo e($v->id); ?>','<?php echo e($v->username); ?>','<?php echo e($v->content); ?>','<?php echo e($v->mid); ?>')" title="回复" class="btn btn-xs btn-pink" ><i class="fa fa-envelope-o  bigger-120"></i></a>
                            <a href="<?php echo e(route('bg.mess.GDelete',['id'=>$v->id])); ?>"  onclick="member_del(this,'1')" title="删除" class="Guest-delete btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    </tbody>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <td colspan="7">
                                <h3>没找到满足条件的数据</h3>
                            </td>
                    <?php endif; ?>
                </table>
                </form>
                <div>当前页共<?php echo e($Guestbook->count()); ?>条记录,为第<?php echo e($Guestbook->currentPage()); ?>页</div>
                <div align="right">
                    <?php echo e($Guestbook->appends([
                      'username'=>$username,
                      'add_time'=>$add_time,
                      'active'=>$active])->links()); ?>

                </div>
            </div>
        </div>
    </div>
    <!--留言详细 member-add-->
    <div id="Guestbook" style="display:none">
        <div class="content_style">
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">留言用户 </label>
                <div class="col-sm-9 username-one">aa</div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 留言内容 </label>
                <div class="col-sm-9 content-one">bb</div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">是否回复 </label>
                <div class="col-sm-9">
                    <label>
                        <input name="checkbox" type="checkbox" class="ace" id="checkbox">
                        <span class="lbl"> 回复</span>
                    </label>
                    <form action="" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="Reply_style">
                            <input name="id" type="text" style="display: none" value="" class="guest-id"/>
                            <input name="mid" type="text" style="display: none" value="" class="guest-mid"/>
                            <textarea name="reply" class="guest-reply form-control" id="form_textarea" placeholder="" onkeyup="checkLength(this);"></textarea>
                            <div  class="validate-error reply"></div>
                            <span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span>字</span>
                            <div class="center">
                            <button onclick="" class="btn radius btn-primary" id="Reply-one" type="button">提交回复</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    //删除
    $('.Guest-delete').click(function () {
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
    //删除全部
    $('.Guest-deletes').click(function () {
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
    //全选全不选
    $('input[name="chkAll"]').click(function(){
        $('input[name="chk[]"]').prop('checked',$(this).prop('checked'));
        //name         //val
    });
    $('input[name="chk[]"]').click(function(){
        $('input[name="chkAll"]').prop('checked',$(this).prop('checked'));
        //name         //val
    });

    laydate({
        elem:'#start',
        theme:'#4060E0'
    });
</script>
<script type="text/javascript">
    $('#Reply-one').click(function () {
        $.ajax({
            url:'<?php echo e(route('bg.mess.GuestReply')); ?>',
            type:'post',
            data:$('form').serialize(),
            dataType:'json',
            success:function(data){
                //显示回复成功信息
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
 /*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url+'#?='+id,w,h);
}
/*留言-删除*/
// function member_del(obj,id){
// 	layer.confirm('确认要删除吗？',function(index){
// 		$(obj).parents("tr").remove();
// 		layer.msg('已删除!',{icon:1,time:1000});
// 	});
// }

/*checkbox激发事件*/
$('#checkbox').on('click',function(){
	if($('input[name="checkbox"]').prop("checked")){
		 $('.Reply_style').css('display','block');
		}
	else{
		
		 $('.Reply_style').css('display','none');
		}	
	})
/*留言查看*/
 function Guestbook_iew(id,username,content,mid){
     var index = layer.open({
         type: 1,
         title: '留言信息',
         maxmin: true,
         shadeClose:false,
         area : ['600px' , ''],
         content:$('#Guestbook'),
     })
$(".username-one").text(username);
$('.content-one').text(content);
$('.guest-id').val(id);
$('.guest-mid').val(mid);
 };

	/*字数限制*/
function checkLength(which) {
	var maxChars = 200; //
	if(which.value.length > maxChars){
	   layer.open({
	   icon:2,
	   title:'提示框',
	   content:'您输入的字数超过限制!',	
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
<script type="text/javascript">
jQuery(function($) {
		var oTable1 = $('#sample-table').dataTable( {
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,3,5,6]}// 制定列不参与排序
		] } );
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});

				});
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();

					var off2 = $source.offset();
					var w2 = $source.width();

					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			})
</script>
