<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
        <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/admin/css/style.css"/>
        <link href="/admin/css/validate.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/admin/assets/css/ace.min.css"/>
        <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
        <!--[if lte IE 8]>
        <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="/admin/js/jquery-1.9.1.min.js"></script>
        <script src="/admin/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/admin/Widget/Validform/5.3.2/Validform.min.js"></script>
		<script src="/admin/assets/js/typeahead-bs2.min.js"></script>
		<script src="/admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
		<script src="/admin/js/lrtk.js" type="text/javascript" ></script>
        <script src="/admin/assets/layer/layer.js" type="text/javascript"></script>
        <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
<title>管理员</title>
</head>

<body>
<div class="page-content clearfix">
  <div class="administrator">
      <div class="d_Confirm_Order_style">
          <div class="search_style">
              <form action="" method="post">
                  {{csrf_field()}}
                  <ul class="search_content clearfix">
                      <li><label class="l_f">管理员名称</label>
                          <input name="username" type="text" value="{{$username}}"  class="text_add" placeholder=""  style=" width:200px"/>
                      </li>
                      <li><label class="l_f">添加时间</label>
                          <input name="add_time" class="inline laydate-icon" value="{{date(" Y-m-d ",$add_time ? $add_time : 852393600) }}" id="start" style=" margin-left:10px;">
                      </li>
                      <select name="active" id="">
                          <option value="" {{$active != 1 && $active == !2 ? 'selected' : ''}}>全部</option>
                          <option value="1" {{$active == 1 ? 'selected' : ''}}>已激活</option>
                          <option value="2" {{$active == 2 ? 'selected' : ''}}>未激活</option>
                      </select>
                      <li style="width:90px;">
                          <button type="submit" class="btn_search"><i class="fa fa-search"></i>查询</button>
                      </li>
                  </ul>
              </form>
          </div>
    <!--操作-->
     <div class="border clearfix">
       <span class="l_f">
        <a href="javascript:ovid()" id="administrator_add" class="btn btn-warning"><i class="fa fa-plus"></i> 添加管理员</a>
        <a href="{{route('bg.admin.deletes')}}" class="admin-deletes btn btn-danger"><i class="fa fa-trash"></i> 批量删除</a>
       </span>
       <span class="r_f">共：<b>{{$Admins_num}}</b>人</span>
     </div>
            {{--error--}}
           <div id="validate-error">
               @if(count($errors) > 0)
                   <ul class="validate-error">
                       <h4>管理员提交验证</h4>
                       @foreach($errors->all() as $error)
                           <li>{{$error}}</li>
                       @endforeach
                   </ul>
               @endif
           </div>
     <!--管理员列表-->
     <div class="clearfix administrator_style" id="administrator">
      <div class="left_style">
      <div id="scrollsidebar" class="left_Treeview">
        <div class="show_btn" id="rightArrow"><span></span></div>
        <div class="widget-box side_content" >
         <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
         <div class="side_list"><div class="widget-header header-color-green2"><h4 class="lighter smaller">管理员分类列表</h4></div>
         <div class="widget-body">
           <ul class="b_P_Sort_list">
           <li><i class="fa fa-users green"></i> <a href="{{route('bg.admin.list')}}">全部管理员（{{$Admins_num}}）</a></li>
            <li><i class="fa fa-users orange"></i> <a href="{{route('bg.admin.list',['grade'=>1])}}">超级管理员（{{$Grade1}}）</a></li>
            <li><i class="fa fa-users orange"></i> <a href="{{route('bg.admin.list',['grade'=>2])}}">普通管理员（{{$Grade2}}）</a></li>
            <li><i class="fa fa-users orange"></i> <a href="{{route('bg.admin.list',['grade'=>3])}}">栏目主编（{{$Grade3}}）</a></li>
            <li><i class="fa fa-users orange"></i> <a href="{{route('bg.admin.list',['grade'=>4])}}">栏目编辑（{{$Grade4}}）</a></li>
           </ul>
        </div>
       </div>
      </div>  
      </div>
      </div>
      <div class="table_menu_list"  id="testIframe">
          <form action="">
              {{csrf_field()}}
           <table class="table table-striped table-bordered table-hover" id="">
                <thead>
                    <tr>
                        <th width="25px"><label><input name="chkAll" type="checkbox" class="ace"><span class="lbl"></span></label></th>
                        <th width="80px">编号</th>
                        <th width="250px">登录名</th>
                        <th width="100px">手机</th>
                        <th width="100px">邮箱</th>
                        <th width="100px">角色</th>
                        <th width="180px">加入时间</th>
                        <th width="70px">状态</th>
                        <th width="200px">操作</th>
                    </tr>
                </thead>
                @forelse($admins as $k=>$v)
                <tbody>
                    <tr>
                        <td><label><input name="chk[]" class="ace" type="checkbox" value="{{$v->id}}" /><span class="lbl"></span></label></td>
                        <td>{{$admins->firstItem()+$k}}</td>
                        <td>{{$v->username}}</td>
                        <td>{{$v->moble?$v->moble:'|ू･ω･`)'}}</td>
                        <td>{{$v->email?$v->email:'〒▽〒'}}</td>
                        <td>
                            <?php
                            //{{$v->grade}}
                            switch($admins[$k]['grade']){
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
                        </td>
                        <td>{{$v->add_time?date('Y-m-d H:i:s',$v->add_time):'开天之物'}}</td>
                        <td class="td-status">
                            <span class="label label-success radius">
                                <a href="{{route('bg.admin.active',['id'=>$v->id,'active'=>$v->active])}}" class="admin-active tablelink">
                                {{$v->active==1 ? '激活' : '禁用'}}</a>
                            </span>
                        </td>
                        <td class="td-manage">
                            <a title="编辑" href="{{route('bg.admin.info',['id'=>$v->id])}}"  onclick="member_edit('编辑','member-add.html','4','','510')"   class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>
                            <a title="删除" href="{{route('bg.admin.delete',['id'=>$v->id])}}"  onclick="member_del(this,'1')" class="admin-delete btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                </tbody>
                @empty
                   <tr>
                       <td colspan="7">
                           <h3>没找到满足条件的数据</h3>
                       </td>
                   </tr>
                @endforelse
           </table>
              <div>共{{$admins->total()}}条记录,当前页为第{{$admins->currentPage()}}页</div>
              <div align="right">
                  {{$admins->appends([
                      'username'=>$username,
                      'add_time'=>$add_time,
                      'active'=>$active,
                      'grade'=>$Grade
                  ])->links()}}
              </div>
          </form>
      </div>
     </div>
  </div>
</div>
 <!--添加管理员-->
     <div id="add_administrator_style" class="add_menber" style="display:none">
        <form action="{{route('bg.admin.add')}}" method="post" id="form-admin-add">
            {{csrf_field()}}
                    <div class="form-group">
                        <label class="form-label"><span class="c-red">*</span>管理员：</label>
                        <div class="formControls">
                            <input type="text" name="username" class="input-text" value="" placeholder="用户名" id="user-name" datatype="*2-16" nullmsg="用户名不能为空">
                        </div>
                        <div class="col-4"> <span class="Validform_checktip"></span></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><span class="c-red">*</span>初始密码：</label>
                        <div class="formControls">
                            <input type="password" name="password" class="input-text" value="" placeholder="密码" autocomplete="off" datatype="*3-11" nullmsg="密码不能为空">
                        </div>
                        <div class="col-4"> <span class="Validform_checktip"></span></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label "><span class="c-red">*</span>确认密码：</label>
                        <div class="formControls ">
                            <input type="password" name="pwd" class="input-text Validform_error" value="" id="newpassword2" recheck="userpassword" placeholder="确认新密码" autocomplete="off" errormsg="您两次输入的新密码不一致！" datatype="*" nullmsg="请再输入一次新密码！">
                        </div>
                        <div class="col-4"> <span class="Validform_checktip"></span></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label "><span class="c-red">*</span>性别：</label>
                        <div class="formControls  skin-minimal">
                            <label><input name="sex" value="保密" type="radio" class="ace" checked="checked"><span class="lbl">保密</span></label>&nbsp;&nbsp;
                            <label><input name="sex" value="男" type="radio" class="ace"><span class="lbl">男</span></label>&nbsp;&nbsp;
                            <label><input name="sex" value="女" type="radio" class="ace"><span class="lbl">女</span></label>
                        </div>
                        <div class="col-4">
                            <span class="Validform_checktip"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label "><span class="c-red">*</span>手机：</label>
                        <div class="formControls ">
                            <input type="text" name="moble" class="input-text" value="" placeholder="" id="moble" datatype="m" nullmsg="手机不能为空">
                        </div>
                        <div class="col-4">
                            <span class="Validform_checktip"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><span class="c-red">*</span>邮箱：</label>
                        <div class="formControls ">
                            <input type="text" name="email" class="input-text" value="" id="email" placeholder="@" datatype="e" nullmsg="请输入邮箱！">
                        </div>
                        <div class="col-4"> <span class="Validform_checktip"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">角色：</label>
                        <div class="formControls ">
                        <span class="select-box" style="width:150px;">
                            <select class="select" name="grade" size="1">
                                <option value="1">超级管理员</option>
                                <option value="2">管理员</option>
                                <option value="3">栏目主辑</option>
                                <option value="4">栏目编辑</option>
                            </select>
                        </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">备注：</label>
                        <div class="formControls">
                            <textarea name="detail" cols="" value="" rows="" class="textarea" placeholder="说点什么...100个字符以内" dragonfly="true" onkeyup="checkLength(this);"></textarea>
                            <span class="wordage">剩余字数：<span id="sy" style="color:Red;">100</span>字</span>
                        </div>
                        <div class="col-4"> </div>
                    </div>
{{--            <input class="btn btn-primary radius" type="submit" id="Add_Administrator" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">--}}
            <button class="btn btn-primary radius" id="ad_add">
                &nbsp;&nbsp;添加&nbsp;&nbsp;
            </button>
        </form>
     </div>
 <!--添加管理员-->

</div>
</body>
</html>
<script type="text/javascript">
$(function() {
	$("#administrator").fix({
		float : 'left',
		//minStatue : true,
		skin : 'green',
		durationTime :false,
		spacingw:50,//设置隐藏时的距离
	    spacingh:270,//设置显示时间距
	});
});
//字数限制
function checkLength(which) {
	var maxChars = 100; //
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
//初始化宽度、高度
 $(".widget-box").height($(window).height()-215);
 $(".table_menu_list").width($(window).width()-260);
 $(".table_menu_list").height($(window).height()-215);
  //当文档窗口发生改变时 触发
    $(window).resize(function(){
         $(".widget-box").height($(window).height()-215);
         $(".table_menu_list").width($(window).width()-260);
         $(".table_menu_list").height($(window).height()-215);
     });

laydate({
    elem:'#start',
    theme:'#4060E0'
});
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs " onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="fa fa-close bigger-120"></i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}
/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="fa fa-check  bigger-120"></i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!',{icon: 6,time:1000});
	});
}
/*管理员-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}*/
/*添加管理员*/
$('#administrator_add').on('click', function(){
	layer.open({
    type: 1,
	title:'添加管理员',
	area: ['700px',''],
	shadeClose: false,
	content: $('#add_administrator_style'),
	});
})
//表单验证提交
// $("#form-admin-add").Validform({
// 		 tiptype:2,
// 		callback:function(data){
// 		//form[0].submit();
// 		if(data.status==1){
//                 layer.msg(data.info, {icon: data.status,time: 1000}, function(){
//                     location.reload();//刷新页面
//                     });
//             }
//             else{
//                 layer.msg(data.info, {icon: data.status,time: 3000});
//             }
// 			var index =parent.$("#iframe").attr("src");
// 			parent.layer.close(index);
// 			//
// 		}
// 	});

//显示添加是否成功信息
if('{{session('status')}}' === 'ok'){
    //添加成功
    layer.confirm('{{session('msg')}}' , {icon:3,title:'跳转提示',btn:['继续添加','去管理员列表']},
        function(){
            //继续添加
            location.reload(true);
            //关闭弹层
            //layer.closeAll();
        },
        function(){
            //去管理员列表
            location = '{{session('url')}}';
        }
    )
}else if('{{session('status')}}' === 'error'){
    layer.msg('{{session('msg')}}' , {icon:6,shade:[0.6]},
        function(){
            //去管理员列表
            location = '{{session('url')}}';
        }
    );
}
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

//管理员删除 id;
$('.admin-delete').click(function(){
    var me = this;
    parent.layer.confirm('确定要删除吗?',{icon:3,title:'删除提示'},function(){
        $.get($(me).attr('href'),'',function(data){
            if (data.status==='ok'){
                parent.layer.msg(data.msg,{icon:6,shade:[0.6],time:1000},function () {
                    $(me).closest('tr').detach();
                        //最近的 tr      分离
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
$('input[name="chk[]"]').click(function(){  //点击核实 chk
    $('input[name="chkAll"]').prop('checked',$(this).prop('checked'));
});

//管理员批量删除  chk
$('.admin-deletes').click(function(){
    var me = this;
    parent.layer.confirm('确定要删除吗?',{icon:3,title:'删除提示'},function(){
        $.post($(me).attr('href'),$('form').serialize(),function(data){
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
</script>

