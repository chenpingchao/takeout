<!DOCTYPE>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
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
		<script src="/admin/assets/js/typeahead-bs2.min.js"></script>   
        <script src="/admin/js/lrtk.js" type="text/javascript" ></script>		
		<script src="/admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="/admin/assets/dist/echarts.js"></script>
      
<title>会员等级</title>
</head>
<body>
<div class="grading_style"> 
    <div id="category">
        <div id="scrollsidebar" class="left_Treeview">
        <div class="show_btn" id="rightArrow"><span></span></div>
        <div class="widget-box side_content" >
        <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
         <div class="side_list">
          <div class="widget-header header-color-green2">
              <h4 class="lighter smaller">会员等级</h4>
          </div>
          <div class="widget-body">
             <ul class="b_P_Sort_list">
                 <li><i class="orange  fa fa-user-secret"></i><a href="?k=0">全部(<?php echo e($total); ?>)</a></li>
                 <?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <li><i class="fa fa-diamond pink "></i> <a href="<?php echo e(route('admin.member.memberGrade')); ?>?knum=<?php echo e($k+1); ?>"><?php echo e($v['grade_name']); ?>(<?php echo e($v['member_num']); ?>)</a></li>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
      </div>
      </div>
      </div>
      </div>
      <!--右侧样式-->
       <div class="page_right_style right_grading">
       <div class="Statistics_style" id="Statistic_pie">
         <div class="type_title">等级统计
         <span class="top_show_btn Statistic_btn">显示</span>
         <span class="Statistic_title Statistic_btn"><a title="隐藏" class="top_close_btn">隐藏</a></span>
         </div>
          <div id="Statistics" class="Statistics"></div>
          </div>
          <!--列表样式-->
           <div class="grading_list">
               <div class="type_title">会员等级列表</div>
               <div class="table_menu_list">
                   <table class="table table-striped table-bordered table-hover" id="sample-table">
                       <thead>
                       <tr>
                           <th width="80">编号</th>
                           <th width="100">用户名</th>
                           <th width="120">手机</th>
                           <th width="100">等级</th>
                           <th width="80">可用积分</th>
                           <th width="150">邮箱</th>
                           <th width="180">加入时间</th>
                           <th width="70">状态</th>
                       </tr>
                       </thead>
                   <tbody>
                   <?php $__empty_1 = true; $__currentLoopData = $member; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                       <tr>
                           <td><?php echo e($member -> firstItem() + $k); ?></td>
                           <td><?php echo e($v -> username); ?></td>
                           <td><?php echo e($v -> mobile); ?></td>
                           <td><?php echo e(getGrade($v -> grade)); ?></td>
                           <td><?php echo e($v -> score); ?></td>
                           <td><?php echo e($v -> email); ?></td>
                           <td><?php echo e(date('Y-m-d H:i:s',$v -> add_time)); ?></td>
                           <td><a  class='active'  href="<?php echo e(route('admin.member.active',['id'=>$v -> id,'active'=>$v -> active])); ?>"><?php echo e($v -> active == 1? '激活' : '禁用'); ?></a></td>
                       </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                       <tr>
                           <td colspan="8"><h3>暂时没有符合条件的数据</h3></td>
                       </tr>
                   <?php endif; ?>
                   </tbody>
               </table>
               <div>共&nbsp;<?php echo e($member->total()); ?>&nbsp;条数据 当前第&nbsp;<?php echo e($member->currentPage()); ?>&nbsp;页</div>
               <div style="float: right"><?php echo e($member -> appends(['knum' => $knum]) -> links()); ?></div>
           </div>
       </div>
      </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript"> 
$(function() { 
	$("#category").fix({
		float : 'left',
		//minStatue : true,
		skin : 'green',	
		durationTime :false,
		spacingw:20,
		spacingh:240,
		set_scrollsidebar:'.right_grading',
	});
});
$(function() { 
	$("#Statistic_pie").fix({
		float : 'top',
		//minStatue : true,
		skin : 'green',	
		durationTime :false,
		spacingw:0,
		spacingh:0,
		close_btn:'.top_close_btn',
		show_btn:'.top_show_btn',
		side_list:'.Statistics',
		close_btn_width:80,
		side_title:'.Statistic_title',
	});
});

/*用户-收货地址展示*/
$('.show').click(function () {
    //弹层并查询
    parent.layer.open({
        type: 2,
        title:'收货地址',
        area:['300px','500px'],
        content: $(this).attr('href')
    });
    //阻止默认提交操作
    return false;
});

/*用户-状态改变*/
$('.active').click(function () {
    me = this;
    //异步请求更改会员状态
    $.get($(this).attr('href'),'',function (data) {
        if (data.status === 'ok'){
            layer.tips(data.msg,me,{tips:[1,'#080'],time:1000});
            //更改href属性
            $(me).attr('href',data.href).text(data.text);
        } else {
            layer.tips(data.msg,me,{tips:[1,'#800'],time:2000});
        }
    },'json');

    //阻止默认操作
    return false;
});
</script>

<script type="text/javascript">
//初始化宽度、高度  
 $(".widget-box").height($(window).height()); 
 $(".page_right_style").width($(window).width()-220);
 //$(".table_menu_list").width($(window).width()-240);
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	$(".widget-box").height($(window).height());
	 $(".page_right_style").width($(window).width()-220);
	 //$(".table_menu_list").width($(window).width()-240);
	}) 
/**************/
     require.config({
            paths: {
                echarts: '/admin/assets/dist'
            }
        });
        require(
            [
                'echarts',
				'echarts/theme/macarons',
                'echarts/chart/pie',   // 按需加载所需图表，如需动态类型切换功能，别忘了同时加载相应图表
                'echarts/chart/funnel'
            ],
            function (ec,theme) {
                var myChart = ec.init(document.getElementById('Statistics'),theme);

                 $.get( '<?php echo e(route('admin.member.getChart')); ?>' ).done(function (data) {
                     myChart.setOption({
                        title : {
                            text: '用户等级统计',
                            subtext: '实时更新最新等级',
                            x:'center'
                        },
                        tooltip : {
                            trigger: 'item',
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                        },
                        legend: {

                            x : 'center',
                            y : 'bottom',
                            data:data.x,
                        },
                        toolbox: {
                            show : true,
                            feature : {
                                mark : {show: false},
                                dataView : {show: false, readOnly: true},
                                magicType : {
                                    show: true,
                                    type: ['pie'],
                                },
                                restore : {show: true},
                                saveAsImage : {show: true}
                            }
                        },
                        calculable : true,
                        series : [
                            {
                                name:'品牌数量',
                                type:'pie',
                                radius : '55%',
                                center: ['50%', '60%'],
                                data:data.y,
                            }
                        ]
                    });
            }
    )
});
</script>
