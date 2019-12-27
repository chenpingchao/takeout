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
{{--{{$cate_name}}{{$active}}--}}
<div class=" page-content clearfix">
 <div id="products_style">
    <div class="search_style">
        <form action="">
          <ul class="search_content clearfix">
           <li>
               <label class="l_f">分类名称</label>
               <input name="sc_name" type="text" value="{{old('sc_name')}}" class="text_add" placeholder="输入分类名称"  style=" width:250px"/>
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
          </ul>
        </form>
    </div>
     <div class="border clearfix">
       <span class="l_f">
        <a href="{{route('admin.shopcate.add')}}" title="添加分类" class="cate-add btn btn-warning "><i class="icon-plus"></i>添加分类</a>
       </span>
     </div>
     <!--产品列表展示-->
     <div class="table_menu_list" id="testIframe">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
            <th width="80px">编号</th>
            <th width="80px">分类名称</th>
            <th width="70px">状态</th>
        </tr>
		</thead>
	<tbody>
    @forelse($category as $k => $v)
      <tr path="{{$v -> path}}">
        <td width="50px"  >{{$category -> firstItem() + $k}}</td>
        <td width="80px" class="sc_name" style="text-align: center" href="{{$v -> id}}" >{{$v -> sc_name}} <span class="errors errors-cate_name">{{ $errors -> first('sc_name')}}</span></td>
        <td class="td-status">
            <span url="{{route('admin.shopcate.active',['id'=> $v -> id,'active'=> $v -> active]) }}" class="label {{$v -> active == 1 ? 'label-success' : 'label-defaunt'}}  radius{{$v->id}} active">
                {{$v -> active == 1 ? '激活' : '停用' }}
            </span>
        </td>
  {{--      <td class="td-manage">
        <a title="编辑"   class="btn btn-xs btn-info edit" ><i class="icon-edit bigger-120"></i></a>
       </td>--}}
	  </tr>
        @empty
        <tr>
            <td colspan="5"><h3>暂未找到符合条件的数据</h3></td>
        </tr>
    @endforelse
    </tbody>
    </table>
         <div style="float: right">{{$category -> appends(['cate_name' => $cate_name,'active' => $active]) -> links()}}</div>
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

//分类添加
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

/*分类-停用/激活*/
$('#sample-table').on('click','.active',function () {
    var me = this;
    // alert($(me).attr('url'));
    $.get($(this).attr('url'),'',function (data) {
        if (data.status === 'ok'){
            //更改本分类url属性
            $(me).attr('url',data.url).text(data.text).toggleClass('label-success').toggleClass('label-defaunt');
            layer.tips(data.msg,$(me),{tips:[1,'#080'],time:1000});
        } else {
            layer.tips(data.msg,$(me),{tips:[1,'#800'],time:2000});
        }
    },'json');
});

/*分类-编辑*/
//修改分类名
$('.sc_name').dblclick(function(){
    var this_td = this;
    //准备input元素
    var sc_name_input = $('<input type="text" >');
    //旧用户名
    var old_sc_name = $(this).text();
    //将input框插入到单元格中
    $(this).empty().append(sc_name_input);

    //将input的值设为旧用户名,并自获取光标
    sc_name_input.val(old_sc_name).css({width:'150px',height:'25px',font_size:'15px',background:'#cef5ff'}).focus();

    //input框失去光标异步提交新的用户名
    sc_name_input.blur(function(){
        //获取用户名新值
        var new_sc_name = $(this).val();
        //判断用户名有没有改变
        if(old_sc_name === new_sc_name){
            $(this_td).text(old_sc_name);
        }else{
            //异步提交
            $.ajax({
                url: '{{route('admin.shopcate.edit')}}',
                type: 'post',
                data: {id:$(this_td).attr('href'),sc_name:new_sc_name,_token:'{{csrf_token()}}'},
                dataType: 'json',
                success:function(data){
                    if (data.status === 'ok') {
                        layer.tips(data.msg, sc_name_input, {
                            tips: [1, '#090'],
                            time: 2000,
                            end: function () {
                                $(this_td).text(new_sc_name)
                            }
                        })
                    }
                },
                error:function(xhr){
                    var errors = JSON.parse(xhr.responseText).errors;
                    //console.log(errors.username);
                    layer.tips(errors.sc_name, sc_name_input, {
                        tips: [1, '#900'],
                        time: 2000,
                        end: function () {
                            $(this_td).text(old_sc_name)
                        }
                    })
                }
            })

        }
    })
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
