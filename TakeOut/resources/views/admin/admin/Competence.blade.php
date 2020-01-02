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
        <script src="/admin/js/dragDivResize.js" type="text/javascript"></script>
<title>添加权限</title>
	<style>
		span.extend{
			display: inline-block;
			/*行内块*/
			font-size:1.5em;
			color:#888;
			font-weight: bold;
			cursor:pointer;
		}
	</style>
</head>
<body>
	<div class="left_Competence_add">
				<!--按钮操作-->
		<div class="">
			<a href="{{route('bg.admin.ad_Permission_add',['id'=>0])}}" class="admin_Permission_add btn btn-warning" style="width: 130px;margin-left:20px" type="button">添加顶级权限</a>
			<a href="{{route('bg.admin.Power')}}" class="btn btn-secondary  btn-warning" type="button">返回上一步</a>
		</div>
		<div style="margin-top:20px;margin-left: 20px;">
			<!--留言列表-->
			<div class="Guestbook_list">
				<form id="deletes_form" action="">
					{{csrf_field()}}
					<table class="table table-striped table-bordered table-hover" id="sample-table">
						<thead>
						<tr>
							<th width="80px">ID</th>
							<th width="150px">权限名称</th>
							<th width="">权限路由</th>
							<th width="200px">上级权限名称</th>
							<th width="200px">操作</th>
						</tr>
						</thead>
						<tbody>
						@forelse($permissions as $k=>$v)
							<tr title="{{$v->path}}">
								<td>{{$permissions->firstItem() + $k}}</td>
								<td>
									{{$v->display_name}}
									<span title="{{route('bg.admin.ad_Permission_son',['pid'=>$v->id])}}" class="extend">{{$v->child_num>0?'+' : ''}}</span>
								</td>
								<td>{{$v->name}}</td>
								<td>{{$v->parent_name or '顶级分类'}}</td>
								<td>
									<a href="{{route('bg.admin.ad_Permission_add',['id'=>$v->id])}}" class="admin_Permission_add">添加子分类</a>
                                    <a href="{{route('bg.admin.ad_Permission_edit',['id'=>$v->id])}}" class="admin_Permission_edit">编辑</a>
									<a href="{{route('bg.admin.ad_Permission_del',['id'=>$v->id])}}" class="admin_Permission_del">删除</a>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="5">
									<h1>未找到相关记录</h1>
								</td>
							</tr>
						@endforelse
						</tbody>
					</table>
				</form>
				<!-- 分页 -->
				<div class="pagin">
					<div style="float: left" class="message">
						共<i class="blue"> {{$permissions->total()}} </i>条记录，当前显示第&nbsp;<i class="blue">{{$permissions->currentPage()}}&nbsp;</i>页
					</div>
					{!!$permissions->links()!!}
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	/*管理员角色添加*/
	$('.admin_Permission_add').on('click', function(){
		parent.layer.open({
			type: 2,
			title:'分类添加',
			area: ['420px','300px'],
			shadeClose: false,
			content: [$(this).attr('href'),'no'] ,
		});
		//阻止超链接的默认行为
		return false;
	})
    /*管理员角色添加*/
    $('.admin_Permission_edit').on('click', function(){
        parent.layer.open({
            type: 2,
            title:'分类添加',
            area: ['420px','300px'],
            shadeClose: false,
            content: [$(this).attr('href'),'no'] ,
        });
        //阻止超链接的默认行为
        return false;
    })

	//显示子权限
	$('body').on('click','.extend',function(){
		var me = this;
		//判断当前符号类型
		if( $(this).text() === '+'){
			$(this).text('-');
			//显示数据
			$.get($(this).attr('title'),'',function(data){
				$(me).closest('tr').after(data);
			},'html')
		}else{
			$(this).text('+');
			//删除数据
			var path = $(this).closest('tr').attr('title');
			console.log(path);
			$('tr[title^="'+path+',"]').detach();
		}
	});
	//删除权限
    $('.admin_Permission_del').click(function(){
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
</script>
