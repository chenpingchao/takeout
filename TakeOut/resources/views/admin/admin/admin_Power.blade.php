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
        <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
<title>管理权限</title>
</head>
<style>
    table { table-layout: fixed;}
    td { white-space: nowrap;overflow: hidden;text-overflow: ellipsis;}
</style>
<body>
 <div class="margin clearfix">
   <div class="border clearfix">
       <span class="l_f">
		   <a href="javascript:ovid()" id="admin_role_add" class="btn btn-info"><i class="fa fa-plus"></i> 添加角色</a>
		   <a href="{{route('bg.admin.Power_add')}}" id="Competence_add" class="btn btn-warning" title="添加权限"><i class="fa fa-plus"></i> 添加权限</a>
       </span>
       <span class="r_f">共：<b>5</b>类</span>
     </div>
     <div class="Guestbook_list">
		 <form action="" method="post" id="deletes_form">
		 {{csrf_field()}}
		 <!-- 列表 -->
			 <table class="table table-striped table-bordered table-hover" id="sample-table">
				 <thead>
				 <tr>
					 <th width="5%">ID</th>
					 <th width="10%">角色名称</th>
					 <th width="30%">拥有成员</th>
					 <th width="30%">拥有权限</th>
					 <th width="25%">操作</th>
				 </tr>
				 </thead>
				 <tbody>
				 @forelse($roles as $key=>$role)
					 <tr>
						 <td>
							 {{$key+$roles->firstItem()}}
						 </td>
						 <td>
							 {{$role->role_name}}
						 </td>
						 <td>
							 @forelse($role->members as $member)
								 {{$member->username}} &nbsp;&nbsp;&nbsp;
							 @empty
								 暂时没有所属成员
							 @endforelse
						 </td>
						 <td>
							 @forelse($role->permissions as $permission)
								 {{$permission->display_name}} &nbsp;&nbsp;&nbsp;
							 @empty
								 暂时没有所属权限
							 @endforelse
						 </td>

						 <td>
							 <a href="{{route('bg.admin.ad_Role_allot',['roleId'=>$role->id])}}" class="tablelink assign_member">分配成员 </a> |
							 <a href="{{route('bg.admin.ad_Permission_allot',['roleId'=>$role->id])}}" class="tablelink assign_permission">分配权限 </a> |
							 <a href="{{route('bg.admin.ad_Role_del',['roleId'=>$role->id])}}" class="tablelink admin_Role_del">删除角色 </a>
						 </td>
					 </tr>
				 @empty
					 <tr>
						 <td colspan="4">
							 <h1>没有找到相关的记录</h1>
						 </td>
					 </tr>
				 @endforelse
				 </tbody>
			 </table>
		 </form>
     </div>
 </div>
</body>
</html>
<script type="text/javascript">
	/*管理员角色添加*/
	$('#admin_role_add').on('click', function(){
		parent.layer.open({
			type: 2,
			title:'(σﾟ∀ﾟ)σ..:*☆哎哟不错哦',
			area: ['420px','420px'],
			shadeClose: false,
			content: ['{{route('bg.admin.ad_Role')}}','no'] ,
		});
	})
	//角色分配管理员
	$('.assign_member').click(function(){
		parent.layer.open({
			title:'分配成员',
			type:2,
			area:['420px','420px'],
			content:[$(this).attr('href')]
		});
		return false;
	});
	//删除角色(角色表/管理员角色关系表/角色权限关系表)
	$('.admin_Role_del').click(function(){
		var me = this;
		parent.layer.confirm('确定要删除吗?',{icon:3,title:'删除提示'},function(){
			$.get($(me).attr('href'),function(data){
				if (data.status==='ok'){
					parent.layer.msg(data.msg,{icon:6,shade:[0.6],time:1000},function () {
						top.iframe.location.reload();
						location = '{{route('bg.admin.Power')}}';
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
<script type="text/javascript">
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
//面包屑返回值
var index = parent.layer.getFrameIndex(window.name);
parent.layer.iframeAuto(index);
$('.Order_form ,#Competence_add').on('click', function(){
	var cname = $(this).attr("title");
	var cnames = parent.$('.Current_page').html();
	var herf = parent.$("#iframe").attr("src");
    parent.$('#parentIframe span').html(cname);
	parent.$('#parentIframe').css("display","inline-block");
    parent.$('.Current_page').attr("name",herf).css({"color":"#4c8fbd","cursor":"pointer"});
	//parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+">" + cnames + "</a>");
    parent.layer.close(index);
	
});
</script>