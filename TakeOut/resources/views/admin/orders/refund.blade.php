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
    <script src="/admin/js/H-ui.js" type="text/javascript"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/js/laydate/laydate.js" type="text/javascript"></script>

    <script src="/admin/js/lrtk.js" type="text/javascript" ></script>
    <script src="/js/layer/layer.js" type="text/javascript" ></script>

<title>退款管理</title>
</head>

<body>
<div class="margin clearfix">
 <div id="refund_style">
   <div class="search_style">
       <form action="" method="post">
           {{csrf_field()}}
           <ul class="search_content clearfix">
               <li>
                   <label class="l_f">订单编号</label>
                   <input name="menu_name" value="{{$orders_num}}" type="text" class="text_add" placeholder="输入订单编号" style=" width:250px">
               </li>
               <li>
                   <label class="l_f">起始时间</label>
                   <input name="start_time" value="{{date(" Y-m-d ",$start_time ? $start_time : time())}}" class="inline laydate-icon" id="start_time" style=" margin-left:10px;">
               </li>
               <li>
                   <label class="l_f">结束时间</label>
                   <input name="end_time" value="{{date(" Y-m-d ",$end_time ? $end_time : time() )}}" class="inline laydate-icon" id="end_time" style=" margin-left:10px;">
               </li>
               <select name="active" id="">
                   <option value="" {{$active != 6 && $active == !7 ? 'selected' : ''}}>全部</option>
                   <option value="6" {{$active == 6 ? 'selected' : ''}}>未退款</option>
                   <option value="7" {{$active == 7 ? 'selected' : ''}}>已退款</option>
               </select>
               <li style="width:90px;"><button type="submit" class="btn_search"><i class="fa fa-search"></i>查询</button></li>
           </ul>
       </form>
   </div>
 <div class="border clearfix">
       <span class="l_f">
        <a href="{{route('bg.orders.returns',['active' => 7 ])}}" class="btn btn-success Order_form"><i class="fa fa-check-square-o"></i>&nbsp;已退款订单</a>
        <a href="{{route('bg.orders.returns',['active' => 6 ])}}" class="btn btn-warning Order_form"><i class="fa fa-close"></i>&nbsp;未退款订单</a>
        <a href="javascript:;" name="deletes"  class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;批量删除</a>
       </span>
       <span class="r_f">共：<b>2334</b>笔</span>
     </div>
     <!--退款列表-->

     <div class="refund_list">
        <table class="table table-striped table-bordered table-hover" id="sample-table">
            <thead>
                <tr>
                    <th width="25px"><label><input type="checkbox" name="chkAll" class="ace"><span class="lbl"></span></label></th>
                    <th width="120px">订单编号</th>
                    <th width="250px">产品名称</th>
                    <th width="100px">交易金额</th>
                    <th width="100px">交易时间</th>
                    <th width="100px">退款金额</th>
                    <th width="80px">退款数量</th>
                    <th width="70px">状态</th>
                    <th width="200px">说明</th>
                    <th width="200px">操作</th>
                </tr>
            </thead>
            <form action="" id="form_deletes">
                {{csrf_field()}}
            <tbody>
                @forelse( $data as $k => $v )

                    <tr class=".tr_delete">
                        <td><label><input type="checkbox" name="chk[]" value="{{$v->id}}" class="chk ace"><span class="lbl"></span></label></td>
                        <td>{{$v -> orders_num}}</td>
                        <td class="order_product_name">
                            <a href="{{$v-> orders_menu_id }}">
                                {{$v-> orders_menu_name }}
                            </a>
                        </td>
                        <td>{{$v -> orders_price}}</td>
                        <td>{{date( 'Y-m-d H:i:s', $v -> add_time )}}</td>
                        <td>{{$v -> orders_price }}</td>
                        <td>{{$v -> orders_num }}</td>
                        <td class="td-status">

                            @if($v->active == 6 )
                                <span class="label label-success radius"> 待退款</span>
                            @elseif($v->active == 7 )
                                <span class="label label-defaunt  radius">已退款</span>
                            @endif

                        </td>
                        <td>{{$v -> detail}}</td>
                        <td>
                            @if($v->active == 6 )
                            <a  href="{{route("bg.orders.return_operation",[ 'id' => $v -> id] ) }}" title="退款"  class="returns btn btn-xs btn-success">退款</a>
                            @endif
                            <a title="退款订单详细"  href="{{route('bg.orders.return_detail',[ 'id' => $v -> id] )}}"  class="btn btn-xs btn-info Refund_detailed" >详细</a>
                            <a href="{{route("bg.orders.delete",[ 'id' => $v -> id] ) }}"  title="删除" class="delete btn btn-xs btn-warning" >删除</a>
                        </td>
                    </tr>
                @empty

                @endforelse

            </tbody>
            </form>
        </table>
         <div class="page_div">
             <span >共{{$data -> total() }}条记录,当前页为第{{$data -> currentPage()}}页</span>
             {{--         分页--}}
             {{$data ->appends([
                'orders_num' => $orders_num ,
                'start_time' => $start_time ,
                'end_time' => $end_time ,
                'active' => $active
                ]) -> links()}}
         </div>
     </div>

 </div>
</div>
</body>
</html>
<script>
 //订单列表
 {{--jQuery(function($) {
		var oTable1 = $('#sample-table').dataTable( {
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,3,4,5,6,8,9]}// 制定列不参与排序
		] } );
                 //全选操作
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});

				});
			});--}}
//退货操作
$(".returns").click(function(){
    me = $(this);
    layer.confirm('是否退款当前商品价格！', {icon:3,shade:[0.6],btn:["退款",'取消']} ,
        function(){
            //确认退款 开始异步
            $.get(me.attr("href"),'',function(data){
                if(data.stats === "ok"){
                    me.parents("tr").find(".td-manage").prepend('<a style=" display:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="已退款">退款</a>');
                    me.parents("tr").find(".td-status").html('<span class="label label-defaunt  radius">已退款</span>');
                    me.remove();
                    layer.msg(data.msg,{icon: 6,time:1000})
                }else{
                    layer.msg(data.msg,{icon: 5,time:2000})
                }
            });
        });
    return false;
});
//删除操作
 $(".delete").click(function(){
     me = $(this);
     layer.confirm('确认要删除该订单' , {icon:3,shade:[0.6],title:'删除提醒',btn:['删除','取消']} ,
         function(){
             //确认删除 开始异步
             $.get(me.attr("href"),'',function(data){
                 if(data.stats === "ok"){
                     me.parents("tr").remove();
                     layer.msg(data.msg,{icon: 6,time:1000})
                 }else{
                     layer.msg(data.msg,{icon: 5,time:2000})
                 }
             });
         });
     return false;
 })
//面包屑返回值
var index = parent.layer.getFrameIndex(window.name);
parent.layer.iframeAuto(index);
$('.Refund_detailed').on('click', function(){
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

    //日历时间插件
    laydate.render({
        elem:"#start_time",
        theme:'#4060E0'
    })
 laydate.render({
     elem:"#end_time",
     theme:'#4060E0'
 })

    //全选按钮的改变
    $('.chk').click(function(){
        $("input[name='chkAll']").prop('checked' , !$( ".chk:not(:checked)" ).length )
    })
    //批量删除
    $("a[name='deletes']").click(function(){
        parent.layer.confirm("是否进行批量删除？",{title:'警告',icon:3,btn:['批量删除','取消'],shade:[0.6],skin:'demo-class'},
            function(){
                $.post('{{route('bg.orders.return_deletes')}}',$("#form_deletes").serialize(),function(data){
                    if( data.stats == "ok" ){
                        $(".tr_delete").remove();
                        parent.layer.msg(data.msg,{icon:6,time:1500})
                    }else{
                        parent.layer.msg(data.msg,{icon:5,time:2000})
                    }

                })
            }
        )
    })
</script>