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
    <title>产品列表</title>
    <style>
        .extend{
            background-color: #ccc;
            cursor: pointer;
            text-indent: 1em;
            font-weight: bold;
        }
        .active{
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class=" page-content clearfix">
 <div id="products_style">
    <div class="search_style">
        <form action="">
          <ul class="search_content clearfix">
           <li>
               <label class="l_f">分类名称</label>
               <input name="cate_name" type="text" value="<?php echo e(old('cate_name')); ?>" class="text_add" placeholder="输入分类名称"  style=" width:250px"/>
           </li>
          <li>
              <label class="l_f">状态&nbsp;</label>
              <select name="active" class="text_add" style="width: 100px" >
                  <option value="3" <?php echo e(old('active')==3 ? 'selected' : ''); ?>>全部</option>
                  <option value="1" <?php echo e(old('active')==1 ? 'selected' : ''); ?>>激活</option>
                  <option value="2" <?php echo e(old('active')==2 ? 'selected' : ''); ?>>停用</option>
              </select>
          </li>
           <li style="width:90px;">
               <button type="submit" class="btn_search"><i class="icon-search"></i>查询</button>
           </li>
          </ul>
        </form>
    </div>
     <div class="border clearfix">
       <span class="l_f">
        <a href="<?php echo e(route('admin.category.add')); ?>" title="添加分类" class="cate-add btn btn-warning "><i class="icon-plus"></i>添加顶级分类</a>
       </span>
     </div>
     <!--产品列表展示-->
     <div class="table_menu_list" id="testIframe">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				<th width="80px">编号</th>
				<th width="250px">分类名称</th>
				<th width="100px">上级分类</th>
				<th width="70px">状态</th>                
				<th width="200px">操作</th>
			</tr>
		</thead>
	<tbody>
    <?php $__empty_1 = true; $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
     <tr path="<?php echo e($v -> path); ?>">
        <td width="80px" ><?php echo e($category -> firstItem() + $k); ?></td>
        <td width="250px" style="text-align: left"><?php echo e($v -> cate_name); ?>

            <?php if($v -> child_num > 0): ?>
                <span class="extend" url="<?php echo e(route('admin.category.childList',['pid'=>$v->id])); ?>">+</span>
            <?php endif; ?>
        </td>
        <td width="250px"><?php echo e(isset($v -> parent_name) ? $v -> parent_name : '顶级分类'); ?></td>
        <td class="td-status">
            <span url="<?php echo e(route('admin.category.active',['path'=> $v -> path,'active'=> $v -> active])); ?>" class="label <?php echo e($v -> active == 1 ? 'label-success' : 'label-defaunt'); ?>  radius<?php echo e($v->id); ?> active">
                <?php echo e($v -> active == 1 ? '激活' : '停用'); ?>

            </span>
        </td>
        <td class="td-manage">
        <a title="编辑"  href="<?php echo e(route('admin.category.edit',['id' => $v -> id])); ?>"  class="btn btn-xs btn-info edit" ><i class="icon-edit bigger-120"></i></a>
        <a title="添加子分类" href="<?php echo e(route('admin.category.add',['pid' => $v -> id])); ?>"  class="btn btn-xs btn-warning child-add" ><i class="icon-plus bigger-120"></i></a>
       </td>
	  </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="5"><h3>暂未找到符合条件的数据</h3></td>
        </tr>
    <?php endif; ?>
    </tbody>
    </table>
         <div style="float: right"><?php echo e($category -> appends(['cate_name' => $cate_name,'active' => $active]) -> links()); ?></div>
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
 
/*产品添加*/
//顶级分类添加
$('#products_style').on('click','.cate-add',function () {
    parent.layer.open({
       type:2,
       title:'添加分类',
       area:['500px','400px'],
       content:$(this).attr('href')
    });
    //阻止默认提交
    return false;
});

//子分类添加
$('#products_style').on('click','.child-add',function () {
    parent.layer.open({
        type:2,
        title:'添加分类',
        area:['500px','400px'],
        content:$(this).attr('href')
    });
    //阻止默认提交
    return false;
});

/*展开/收回子分类列表*/
$('#sample-table').on('click','.extend',function () {
    var me = this;
    if($(this).text() === '+'){
        //异步提交
        $.get($(this).attr('url'),'',function (data) {
            //更改符号
            $(me).text('-');
            $(me).closest('tr').after(data);
        },'html');
    }else {
        //更改符号
        $(me).text('+');
        //删除扩展的子分类列表
        var path = $(this).closest('tr').attr('path');
        // $('tr[title^="+path+"]').detach();
        $('tr[path^="'+path+',"]').detach();
    }


});

/*分类-停用/激活*/
$('#sample-table').on('click','.active',function () {
    var me = this;
    $.get($(this).attr('url'),'',function (data) {
        if (data.status === 'ok'){
            //更改子分类状态和url地址
            $('tr[path^="'+ data.path+',"]').each(function () {
                //拼接新的url地址
                var url = "<?php echo e(url('bg/category/active')); ?>"+'/'+$(this).attr('path')+'/'+data.active;
                //更改属性
                $(this).find('.active').text(data.text).attr('url',url).toggleClass('label-success').toggleClass('label-defaunt');
            });
            layer.tips(data.msg,$(me),{tips:[1,'#080'],time:1000});
            //更改本分类url属性
            $(me).attr('url',data.url).text(data.text).toggleClass('label-success').toggleClass('label-defaunt');
        } else {
            layer.tips(data.msg,$(me),{tips:[1,'#800'],time:2000});
        }
    },'json');
});


/*分类-编辑*/
$('#sample-table').on('click','.edit',function () {
    parent.layer.open({
        type:2,
        title:'编辑分类',
        area:['500px','400px'],
        content:$(this).attr('href')
    });
    //阻止默认提交
    return false;
});

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
