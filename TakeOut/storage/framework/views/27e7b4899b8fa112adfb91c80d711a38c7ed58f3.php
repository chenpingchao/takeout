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
    <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/admin/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/admin/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <link href="/admin/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
    <!--[if IE 7]>
      <link rel="stylesheet" href="/admin/assets/css/font-awesome-ie7.min.css" />
    <![endif]-->
    <!--[if lte IE 8]>
      <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
    <![endif]-->
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <!-- page specific plugin scripts -->
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="/admin/js/H-ui.js"></script>
    <script type="text/javascript" src="/admin/js/H-ui.admin.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script>
    <script src="/admin/js/lrtk.js" type="text/javascript" ></script>
    <title>会员等级列表</title>
    <style>
        div .detail{
            display: none;
        }
    </style>
</head>
<body>
<div class=" page-content clearfix">
    <div class="search_style">
        <form action="">
            <ul class="search_content clearfix">
                <li>
                    <label class="l_f">福利搜索</label>
                    <input name="detail" type="text" value="<?php echo e(old('detail')); ?>" class="text_add" placeholder="输入要搜索的福利内容"  style=" width:250px"/>
                </li>
                <li style="width:90px;" class="l_f">
                    <button type="submit" class="btn_search"><i class="icon-search"></i>查询</button>
                </li>
            </ul>
        </form>
    </div>
 <div id="products_style">
     <div class="border clearfix">
       <span class="l_f">
        <a href="<?php echo e(route('admin.member.add')); ?>" title="添加会员等级" class="grade-add btn btn-warning "><i class="icon-plus"></i>添加会员等级</a>
       </span>
     </div>
     <!--产品列表展示-->
     <div class="table_menu_list" id="testIframe">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				<th width="80px">编号</th>
				<th width="150px">等级名称</th>
				<th width="200px">等级福利</th>
				<th width="100px">所需积分</th>
				<th width="200px">操作</th>
			</tr>
		</thead>
	<tbody>
    <?php $__empty_1 = true; $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
     <tr>
        <td width="80px" >
            <?php echo e($k +1); ?>

        </td>
        <td width="150px" >
            <?php echo e($v -> grade_name); ?>

        </td>
         <td width="200px" >
             <a href="javascript:detail(<?php echo e($v -> id); ?>);"><?php echo e(mb_substr($v -> detail,0,30)); ?><?php echo e(strlen($v -> detail) > 30 ? '...' : ''); ?></a>
             <div class="detail" id="<?php echo e($v -> id); ?>"><?php echo $v -> detail; ?></div>
         </td>
         <td width="100px">
             <?php echo e($v -> score); ?>

         </td>
        <td class="td-manage">
        <a title="编辑"  href="<?php echo e(route('admin.member.edit',['id' => $v -> id])); ?>"  class="btn btn-xs btn-info edit" ><i class="icon-edit bigger-120"></i></a>
        <a title="删除" href="<?php echo e(route('admin.member.delete',['id' => $v -> id])); ?>"  class="btn btn-xs btn-warning delete" ><i class="icon-trash  bigger-120"></i></a>
       </td>
	  </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="5"><h3>暂未找到符合条件的数据</h3></td>
        </tr>
    <?php endif; ?>
    </tbody>
    </table>
    </div>     
  </div>
 </div>
</div>
</body>
</html>

<script type="text/javascript">
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
 
/*会员等级添加*/
$('.grade-add').click(function () {
    parent.layer.open({
        type:2,
        title:'添加等级',
        area:['800px','600px'],
        content:$(this).attr('href')
    });
    //阻止默认提交
    return false;
});

/*分类-编辑*/
$('#sample-table').on('click','.edit',function () {
    parent.layer.open({
        type:2,
        title:'编辑等级',
        area:['800px','600px'],
        content:$(this).attr('href')
    });
    //阻止默认提交
    return false;
});

/*删除等级*/
$('.delete').click(function () {
    var me = this;
    parent.layer.confirm('确认删除？',{icon:1,btn:['确认删除','取消'],title:'删除提示'},function (index) {
        $.get($(me).attr('href'),'',function (data) {
            parent.layer.close(index);
            if (data.status === 'ok'){
                $(me).closest('tr').detach();
                layer.msg(data.msg,{icon:0,time:1000,shade:[0.6]});
            }else {
                layer.msg(data.msg,{icon:5,time:2000,shade:[0.6]})
            }
        });
    });
    //阻止默认提交
    return false;
});

/*福利详情*/
function detail(id) {
    layer.open({
        type:1,
        title:'等级福利',
        area:['500px','300px'],
        content:$('#'+id)
    });
}

//面包屑返回值
var index = parent.layer.getFrameIndex(window.name);
parent.layer.iframeAuto(index);
$('.Order_form').on('click', function(){
	var cname = $(this).attr("title");
	var chref = $(this).attr("href");
	var cnames = parent.$('.Current_page').html();
	var herf = parent.$("#iframe").attr("src");
    parent.$('#parentIframe').html(cname);
    parent.$('#iframe').attr("src",chref).ready();;
	parent.$('#parentIframe').css("display","inline-block");
	parent.$('.Current_page').attr({"name":herf,"href":"javascript:void(0)"}).css({"color":"#4c8fbd","cursor":"pointer"});
    parent.layer.close(index);
	
});
</script>
