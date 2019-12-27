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

    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/assets/dist/echarts.js"></script>
<title>交易金额</title>
</head>

<body>
<div class="margin clearfix">
 <div class="amounts_style">
   <div class="transaction_Money clearfix">
      <div class="Money"><span >成交总额：{{$sum_price}}元</span><p>最新统计时间:{{date("Y-m-d",time())}}</p></div>
       <div class="Money"><span ><em>￥</em>{{$day_price}}元</span><p>当天成交额</p></div>
       <div class="l_f Statistics_btn"> 
       <a href="javascript:ovid()" title="当月统计" onclick="Statistics_btn()" class="btn  btn-info btn-sm no-radius"><i class="bigger fa fa-bar-chart "></i><h5 class="margin-top">当月统计</h5></a>
     </div>
    </div>
    <div class="border clearfix">
      <span class="l_f">
          <a href="{{route("bg.orders.price" , [ 'time' =>1 ])}}" class="btn btn-info">全部订单</a>
          <a href="{{route("bg.orders.price" , [ 'time' =>2 ])}}" class="btn btn-danger">当天订单</a>
          <a href="{{route("bg.orders.price" , [ 'time' =>3 ])}}" class="btn btn-danger">当月订单</a>
      </span>
      <span class="r_f">共：<b>{{$orders_num}}</b>笔</span>
     </div>
   <div class="Record_list">
    <table class="table table-striped table-bordered table-hover" id="sample-table">
        <thead>
		    <tr>
                <th width="100px">序号</th>
                <th width="200px">订单编号</th>
                <th width="180px">成交时间</th>
                <th width="120px">成交金额(元)</th>
                <th width="180px">状态</th>

			</tr>
        </thead>
        <tbody>
            @forelse($data as $v)
            <tr>
                 <td>{{$loop -> iteration}}</td>
                 <td>{{$v -> orders_num}}</td>
                 <td>{{date("Y-m-d H:i:s",$v -> add_time)}}</td>
                 <td>{{$v -> orders_price}}</td>
                @switch($v ->active)
                    @case(1)    <td>未付款</td>        @break
                    @case(2)    <td>已付款</td>        @break
                    @case(3)    <td>已发货</td>        @break
                    @case(4)    <td>已签收</td>        @break
                    @case(5)    <td >已评论</td>       @break
                    @case(6)    <td>待退货</td>          @break
                    @case(7)    <td>已退货</td>          @break
                @endswitch
            </tr>
            @empty
                <p>暂无交易信息</p>
            @endforelse
        </tbody>
        </table>
       <div class="page_div">
           <span >共{{$data -> total() }}条记录,当前页为第{{$data -> currentPage()}}页</span>
           {{--         分页--}}
           {{$data ->appends([
              'time' => $time
              ]) -> links()}}
       </div>
    
   </div>
 </div>
</div>
<div id="Statistics" style="display:none">
 <div id="main" style="height:400px; overflow:hidden; width:1000px; overflow:auto" ></div>
</div>
</body>
</html>
<script>
/*$(function() {
		var oTable1 = $('#sample-table').dataTable( {
		"aaSorting": [],//默认第几个排序
		"bStateSave": false,//状态保存
		//"dom": 't',
		"bFilter":false,
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,1,2,3,4]}// 制定列不参与排序
		] } );
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
})*/
//当月统计
function Statistics_btn(){	
	var index = layer.open({
        type: 1,
        title: '当月销售统计',
		maxmin: true, 
		shadeClose:false,
        area : ['1000px' , ''],
        content:$('#Statistics'),
		btn:['确定','取消'],		
	})
	//layer.full(index);
	}
	//统计
	        require.config({
            paths: {
                echarts: "/admin/assets/dist"
            }
        });
        require(
            [
                'echarts',
				'echarts/theme/macarons',
                'echarts/chart/line',   // 按需加载所需图表，如需动态类型切换功能，别忘了同时加载相应图表
                'echarts/chart/bar'
            ],
            function (ec,theme) {
                var myChart = ec.init(document.getElementById('main'),theme);
				option = {
    tooltip : {
        trigger: 'axis'
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType: {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    legend: {
        data:['成交订单','失败订单','成交金额']
    },
    xAxis : [
        {
            type : 'category',
            data : ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','125','26','27','28','29','30','31']
        }
    ],
    yAxis : [
        {
            type : 'value',
            name : '订单',
            axisLabel : {
                formatter: '{value} 单'
            }
        },
        {
            type : 'value',
            name : '金额',
            axisLabel : {
                formatter: '{value} 元'
            }
        }
    ],
    series : [

        {
            name:'成交订单',
            type:'bar',
            data:[@foreach($accOrders as $v )
                {{$v.','}}
                @endforeach]
        },
        {
            name:'失败订单',
            type:'bar',
            data:[@foreach($lostOrder as $v )
                {{$v.','}}
                @endforeach]
        },
        {
            name:'成交金额',
            type:'line',
            yAxisIndex: 1,
            data:[@foreach($all_price as $v )
                {{$v.','}}
                @endforeach]
        }
    ]
};
				myChart.setOption(option);
			})
</script>
