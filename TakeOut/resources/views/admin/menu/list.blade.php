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
	    <script src="/js/jquery-3.3.1.min.js"></script>
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
<title>菜品列表</title>
</head>
<body>
<div class=" page-content clearfix">
 <div id="products_style">
    <div class="search_style">
        <form action="">
            <ul class="search_content clearfix">
                <li>
                    <label class="l_f">菜品名称</label>
                    <input name="menu_name" type="text" value="{{old('menu_name')}}" class="text_add" placeholder="输入分类名称"  style=" width:150px"/>
                </li>
                <li>
                    <label class="l_f">关键字</label>
                    <input name="key_words" type="text" value="{{old('key_words')}}" class="text_add" placeholder="输入搜索关键字"  style=" width:150px"/>
                </li>
                <li>
                    <label class="l_f">店铺名称</label>
                    <input name="shop_name" type="text" value="{{old('shop_name')}}" class="text_add" placeholder="输入店铺名称"  style=" width:150px"/>
                </li>
                <li>
                    <label class="l_f">状态&nbsp;</label>
                    <select name="active" class="text_add" style="width: 100px" >
                        <option value="3" {{ old('active')==3 ? 'selected' : '' }}>全部</option>
                        <option value="1" {{ old('active')==1 ? 'selected' : '' }}>激活</option>
                        <option value="2" {{ old('active')==2 ? 'selected' : '' }}>停用</option>
                    </select>
                </li>
                <li style="width:90px;">
                    <button type="submit" class="btn_search"><i class="icon-search"></i>查询</button>
                </li>
                <li>
                    <span class="r_f">共：<b>{{$data['menu_num'] }}</b>&ensp;件商品</span>
                </li>
            </ul>

        </form>
    </div>
{{--     <div class="border clearfix">--}}
{{--       <span class="l_f">--}}
{{--        <a href="{{route('admin.menu.add')}}" title="添加商品" class="btn btn-warning Order_form"><i class="icon-plus"></i>添加商品</a>--}}
{{--       </span>--}}
{{--     </div>--}}
     <!--产品列表展示-->
     <div class="table_menu_list" id="testIframe">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		     <tr>
				<th width="25px"></th>
				<th width="80px">菜品ID</th>
				<th width="150px">菜品名称</th>
                <th width="100px">店铺名称</th>
                <th width="80px">销售数量</th>
                <th width="80px">评论数量</th>
				<th width="100px">原价格</th>
				<th width="100px">现价</th>
				<th width="180px">添加时间</th>
				<th width="70px">状态</th>                
				<th width="200px">操作</th>
			</tr>
		</thead>
        <tbody id="tbody">
            <form action="" id="form1">
                {{csrf_field()}}
                @forelse($menu as $k => $v )
                 <tr>
                    <td width="25px"><label><input type="checkbox" class="ace" name="chk[]"value="{{$v -> id}}"><span class="lbl"></span></label></td>
                    <td width="80px">{{ $v -> id }}</td>
                    <td width="250px">
                        <a href="javascript:detail('{{$v -> id}}');" class="text-primary">{{ $v -> menu_name }}</a>
                    </td>
                     <td width="100px">{{ $v -> shop_name }}</td>
                     <td width="50px"><a href="{{route('admin.menu.salde',['id' => $v -> id])}}" class="salde">{{$v -> salde_num}}</a></td>
                     <td width="50px">{{$v -> eval_num}}</td>
                    <td width="100px">{{ $v -> or_price }}</td>
                    <td width="100px">{{ $v -> price }}</td>
                    <td width="180px">{{ date( "Y-m-d H:i:s", $v -> add_time ) }}</td>
                    <td class="td-status">
                         <a href="{{route('admin.menu.active',['id'=>$v->id , 'active'=>$v->active])}}" class="active_change" >
                             <span class="label {{$v -> active == 1 ? 'label-success' : 'label-defaunt'}}  radius{{$v->id}}">{{$v -> active == 1 ? '激活' : '停用'}}</span>
                         </a>
                    </td>
                    <td class="td-manage">
                        <a title="编辑" href="{{route('admin.menu.edit',['id' => $v -> id])}}"  class="btn btn-xs btn-info" ><i class="icon-edit bigger-120"></i></a>
                        <a title="删除" href="{{route('admin.menu.delete',['id' => $v -> id])}}" class="btn btn-xs btn-warning delete" ><i class="icon-trash  bigger-120"></i></a>
                   </td>
                  </tr>
                    @empty
                    <tr>
                        <td></td>
                        <td colspan="9"><h2>没有找到菜品信息</h2></td>
                    </tr>
                @endforelse
                <tr>
                    <td width="25px"><label><input type="checkbox" class="ace" name="chkAll" id="chkAll"><span class="lbl"></span></label></td>
                    <td colspan="10" style="text-align: left"><a href="{{route('admin.menu.delete',['id' => 0])}}" class="delAll">批量删除</a></td>
                </tr>
            </form>
        </tbody>
    </table>
             <div style="float: right">{{$menu -> appends(['menu_name' => $menu_name,'active' => $active]) -> links()}}</div>
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

//激活和禁用
//产品的上架和下架
$('#tbody').on('click',".active_change",function(){
    var me = this;
    $.get($(this).attr('href'),'',function (data) {
        if (data.status === 'ok'){
            //更改属性
            layer.tips(data.msg,$(me),{tips:[1,'#080'],time:1000});
            //更改本分类url属性
            $(me).attr('href',data.href);
            $(data.class).text(data.text).toggleClass('label-success').toggleClass('label-defaunt');
        } else {
            layer.tips(data.msg,$(me),{tips:[1,'#800'],time:2000});
        }
    },'json');
    return false;
});

/*产品-删除*/
$('.delete').click(function () {
    var me = this;
   layer.confirm('确认删除?',{btn:['确认删除','取消']},function () {
       $.get($(me).attr('href'),'',function (data) {
           layer.closeAll();
           if (data.status === 'ok'){
               layer.msg(data.msg,{icon:0,time:2000});
               $(me).closest('tr').detach();
           } else {
               layer.msg(data.msg,{icon:6,time:3000});
           }
       },'json');
   });
    return false;
});

/*批量删除*/
$('.delAll').click(function () {
    var me = this;
    layer.confirm('确认删除选中项?',{btn:['确认删除','取消']},function () {
        // console.log($(me).attr('href'));
        $.post($(me).attr('href'),$('#form1').serialize(),function (data) {
            if (data.status === 'ok'){
                layer.msg(data.msg,{icon:0,time:2000});
                $("input[name='chk[]']:checked").closest('tr').detach();
            } else {
                layer.msg(data.msg,{icon:6,time:3000});
            }
        },'json');
    });
    return false;
});

/*全选全不选*/
$('#chkAll').click(function () {
    $("input[name='chk[]']").prop('checked',$(this).prop('checked'));
});

$("input[name='chk[]']").click(function () {
    $('#chkAll').prop('checked',!$("input[name='chk[]']:not(:checked)").length);
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
	//parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+" class='iframeurl'>" + cnames + "</a>");
    parent.layer.close(index);
});

/*订单展示*/
$('.salde').click(function () {
   parent.layer.open({
       type:2,
       title:'订单展示',
       area:['1200px','600px'],
       content:[$(this).attr('href')]
   })
    return false;
});

/*商品图片*/
function detail(id){
    parent.layer.open({
        type: 2,
        title:'商品图片',
        area:['600px','600px'],
        content:'{{route('admin.menu.image')}}?id='+id
    })
}

</script>
