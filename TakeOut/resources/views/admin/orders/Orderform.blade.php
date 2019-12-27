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
    <link rel="stylesheet" href="/css/public.css">
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />

    <![endif]-->
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/admin/js/H-ui.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/assets/js/jquery.easy-pie-chart.min.js"></script>
    <script src="/admin/js/lrtk.js" type="text/javascript" ></script>


<title>订单管理</title>
</head>

<body>
<div class="margin clearfix">
 <div class="cover_style" id="cover_style">
    <!--内容-->
    {{--  搜索  --}}
    <div class="search_style">
        <form action="" method="post">
            {{csrf_field()}}
            <ul class="search_content clearfix">
                <li>
                    <label class="l_f">订单编号</label>
                    <input name="orders_num" value="{{$orders_num}}" type="text" class="text_add" placeholder="订单订单编号" style=" width:250px">
                </li>
                <li>
                    <label class="l_f">开始时间</label>
                    <input name="start_time" value="{{$start_time}}" autocomplete="off" class="inline laydate-icon" id="start_time" style=" margin-left:10px;">
                </li>
                <li>
                    <label class="l_f">结束时间</label>
                    <input name="end_time" value="{{$end_time}}"  autocomplete="off" class="inline laydate-icon" id="end_time" style=" margin-left:10px;">
                </li>
                <li>
                    <label class="l_f">状态</label>
                    <select name="active" id="active">
                        <option value="7" >全部</option>
                        <option value="1" {{$active==1 ? 'selected' : ''}}>未付款</option>
                        <option value="2" {{$active==2 ? 'selected' : ''}}>已付款</option>
                        <option value="3" {{$active==3 ? 'selected' : ''}}>已发货</option>
                        <option value="4" {{$active==4 ? 'selected' : ''}}>已签收</option>
                        <option value="5" {{$active==5 ? 'selected' : ''}}>已评论</option>
                        <option value="6" {{$active==6 ? 'selected' : ''}}>退货</option>
                    </select>
                </li>
                <li style="width:90px;">
                    <button type="submit" class="btn_search">
                        <i class="fa fa-search"></i>查询
                    </button>
                </li>
            </ul>
        </form>
    </div>
      <!--订单列表展示-->
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				<th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
				<th width="120px">订单编号</th>
				<th width="100px">总价</th>
                <th width="100px">订单时间</th>
                <th width="80px">商品种类</th>
				<th width="70px">状态</th>                
				<th width="200px">操作</th>
			</tr>
		</thead>
	    <tbody>
        @forelse($data as $v)
            <tr>
             <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
             <td>{{$v -> orders_num}}</td>
             <td>{{$v -> orders_price}}</td>
             <td>{{date("Y-m-d H:i:s",$v -> add_time)}}</td>
             <td>{{$v -> orders_menu_num}}</td>
             <td class="td-status">
                 @switch($v ->active)
                     @case(1)
                        <span class="label label-success radius">未付款</span>
                        @break
                     @case(2)
                         <span class="label label-success radius">已付款</span>
                         @break
                     @case(3)
                         <span class="label label-success radius">已发货</span>
                         @break
                     @case(4)
                         <span class="label label-success radius">已签收</span>
                         @break
                     @case(5)
                         <span class="label label-success radius">已评论</span>
                         @break
                     @case(6)
                         <span class="label label-success radius">待退货</span>
                         @break
                     @case(7)
                     <span class="label label-success radius">已退货</span>
                     @break
                 @endswitch
             </td>
             <td>
                 <a title="订单详细"  href="{{route("bg.orders.detail",[ 'id' => $v->id ])}}"  class="btn btn-xs btn-info order_detailed" ><i class="fa fa-list bigger-120"></i></a>
                 <a title="删除" href="javascript:;" onclick="Order_form_del(this,'{{route('bg.orders.delete',['id' => $v -> id])}}')" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
             </td>
            </tr>
        @empty
            <tr><td colspan="7"><h3>暂时没有订单</h3></td></tr>
        @endforelse
    </tbody>
     </table>
     <div class="page_div">
         <span >共{{empty($data) ? 0 : $data -> total()}}条记录,当前页为第{{empty($data) ? 1 : $data -> currentPage()}}页</span>
{{--         分页--}}
         {{empty($data) ? '' : $data ->appends([
            'orders_num' => $orders_num ,
            'start_time' => $start_time ,
            'end_time' => $end_time ,
            'active' => $active
            ]) -> links()}}
     </div>

     </div>
   </div>
 </div>
</div>

 {{--<!--发货-->
<form action="">
 <div id="Delivery_stop" style=" display:none">
  <div class="">
    <div class="content_style">
  <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">快递公司 </label>
       <div class="col-sm-9">
           <select class="form-control" id="form-field-select-1">
                <option value="">--选择快递--</option>
                <option value="1">天天快递</option>
                <option value="2">圆通快递</option>
                <option value="3">中通快递</option>
                <option value="4">顺丰快递</option>
                <option value="5">申通快递</option>
                <option value="6">邮政EMS</option>
                <option value="7">邮政小包</option>
                <option value="8">韵达快递</option>
           </select>
       </div>
	</div>
   <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 快递号 </label>
    <div class="col-sm-9"><input type="text" id="form-field-1" placeholder="快递号" class="col-xs-10 col-sm-5" style="margin-left:0px;"></div>
	</div>
    <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">货到付款 </label>
     <div class="col-sm-9"><label><input name="checkbox" type="checkbox" class="ace" id="checkbox"><span class="lbl"></span></label></div>
	</div>
 </div>
  </div>
 </div>
</form>--}}
</body>
</html>
<script>
 $(function() { 
	$("#cover_style").fix({
		float : 'top',
		minStatue : false,
		skin : 'green',	
		durationTime :false,
		window_height:30,//设置浏览器与div的高度值差
		spacingw:0,//
		spacingh:0,//
		close_btn:'.yingchan_btn',
		show_btn:'.xianshi_btn',
		side_list:'.hide_style',
		widgetbox:'.top_style',
		close_btn_width:60,	
		da_height:'#centent_style,.left_Treeview,.list_right_style',	
		side_title:'.b_n_btn',		
		content:null,
		left_css:'.left_Treeview,.list_right_style'
		
		
	});
});
//左侧显示隐藏
$(function() { 
	$("#covar_list").fix({
		float : 'left',
		minStatue : false,
		skin:false,	
		//durationTime :false,
		spacingw:50,//设置隐藏时的距离
	    spacingh:270,//设置显示时间距
		stylewidth:'220',
		close_btn:'.close_btn',
		show_btn:'.show_btn',
		side_list:'.side_list',
		content:'.side_content',
		widgetbox:'.widget-box',
		da_height:null,
		table_menu:'.list_right_style'
	});
});
//开始时间选择
 laydate({
    elem: '#start_time',
    event: 'focus' 
});
 //结束时间选择
 laydate({
     elem: '#end_time',
     event: 'focus'
 });
/*订单-删除*/
function Order_form_del(obj,url){
	layer.confirm('确认要删除吗？',{icon:3,shade:[0.6],title:'删除提示',btn:['删除','取消']},
        function(){
            $.get(url,'',function(data){
                if(data.stats === 'ok'){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:6,time:1000});
                }else{
                    layer.msg('删除失败!',{icon:5,time:1000});
                }
            })
        }
	);
}
/**发货按钮只有在active = 2 时才出现**/
// $('')
/**发货**/
/**function Delivery_stop(obj,id){
	layer.open({
        type: 1,
        title: '发货',
		maxmin: true, 
		shadeClose:false,
        area : ['500px' , ''],
        content:$('#Delivery_stop'),
		btn:['确定','取消'],
		yes: function(index, layero){		
		if($('#form-field-1').val()==""){
			layer.alert('快递号不能为空！',{
               title: '提示框',				
			  icon:0,		
			  }) 
			
			}else{
			 layer.confirm('提交成功！',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style=" display:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="已发货"><i class="fa fa-cubes bigger-120"></i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发货</span>');
		$(obj).remove();
		layer.msg('已发货!',{icon: 6,time:1000});
			});  
			layer.close(index);    		  
		  }
		
		}
	})
};**/

$(".shipments").click(function(){
    var me = this;
   parent.layer.confirm("请确认发货",{icon:3,btn:['确认','取消'],title:"发货提醒",shade:[0.6]},
       function(){
           $.get($(me).attr('href'),'',function(data){
               if(data.stats === "ok" ){
                   $(me).parents("tr").find(".td-manage").prepend('<a style=" display:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="已发货"><i class="fa fa-cubes bigger-120"></i></a>');
                   $(me).parents("tr").find(".td-status").html('<span class="label label-success radius">已发货</span>');
                   $(me).remove();
                   parent.layer.msg(data.msg , {icon:6,shade:[0.6],time:1500});
               }else{
                   parent.layer.msg(data.msg , {icon:5,shade:[0.6],time:1500});
               }
           })
       }
   )
    return false;
});
//面包屑返回值
var index = parent.layer.getFrameIndex(window.name);
parent.layer.iframeAuto(index);
$('.Order_form,.order_detailed').on('click', function(){
	var cname = $(this).attr("title");
	var chref = $(this).attr("href");
	var cnames = parent.$('.Current_page').html();
	var herf = parent.$("#iframe").attr("src");
    parent.$('#parentIframe').html(cname);
    parent.$('#iframe').attr("src",chref).ready();;
	parent.$('#parentIframe').css("display","inline-block");
	parent.$('.Current_page').attr({"name":herf,"href":"javascript:void(0)"}).css({"color":"#4c8fbd","cursor":"pointer"});
	//parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+" class='iframeurl'>" + cnames + "</a>");
    parent.layer.close(index);
	
});

//初始化宽度、高度  
  var heights=$(".top_style").outerHeight()+47; 
 $(".centent_style").height($(window).height()-heights); 
 $(".page_right_style").width($(window).width()-220);
 $(".left_Treeview,.list_right_style").height($(window).height()-heights-2); 
 $(".list_right_style").width($(window).width()-250);
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	$(".centent_style").height($(window).height()-heights); 
	 $(".page_right_style").width($(window).width()-220);
	 $(".left_Treeview,.list_right_style").height($(window).height()-heights-2);  
	 $(".list_right_style").width($(window).width()-250);
	}) 
//比例
var oldie = /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase());
			$('.easy-pie-chart.percentage').each(function(){
				$(this).easyPieChart({
					barColor: $(this).data('color'),
					trackColor: '#EEEEEE',
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: 10,
					animate: oldie ? false : 1000,
					size:103
				}).css('color', $(this).data('color'));
			});
		
			$('[data-rel=tooltip]').tooltip();
			$('[data-rel=popover]').popover({html:true});
</script>
<script>
//订单列表
jQuery(function($) {
		var oTable1 = $('#sample-table').dataTable( {
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,1,2,3,4,5,6,7,8,9]}// 制定列不参与排序
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