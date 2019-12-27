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
    <script src="/admin/js/lrtk.js" type="text/javascript" ></script>
{{--    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>--}}
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/js/H-ui.js" type="text/javascript"></script>
    <script src="/admin/js/displayPart.js" type="text/javascript"></script>
    <title>店铺列表</title>

</head>
<body>
<div class="clearfix">
    <div class="article_style" id="article_style">
        <div class="Ads_list" style="margin-left:0px; ">
            <!--搜索-->
            <div class="search_style">
                <form action="">
                    <ul class="search_content clearfix">
                        <li><label class="l_f">店铺名称:</label><input name="shop_name" value="{{old('shop_name')}}" type="text" class="text_add" placeholder="店铺名称" style=" width:150px"></li>
                        <li><label class="l_f">持有人姓名:</label><input name="sm_name" value="{{old('sm_name')}}" type="text" class="text_add" placeholder="持有人姓名" style=" width:150px"></li>
                        <li><label class="l_f">所属分类:</label><input name="sc_name" value="{{old('sc_name')}}" type="text" class="text_add" placeholder="所属分类" style=" width:200px">
                        <li>
                            <label class="l_f">状态&nbsp;</label>
                            <select name="active" class="text_add" style="width: 100px" >
                                <option value="3" {{ old('active')==3 ? 'selected' : '' }}>全部</option>
                                <option value="1" {{ old('active')==1 ? 'selected' : '' }}>激活</option>
                                <option value="2" {{ old('active')==2 ? 'selected' : '' }}>停用</option>
                            </select>
                        </li>
                    </ul>
                    <ul class="search_content clearfix" style="margin-top: 15px">
                        <li><div>添加时间查询：</div></li>
                        <li><label class="l_f">起始时间</label><input autocomplete="off" class="inline laydate-icon" name="start_time" value="{{old('start_time')}}" placeholder="起始时间" id="start" style=" margin-left:10px;"></li>
                        <li><label class="l_f">结束时间</label><input autocomplete="off" class="inline laydate-icon" name="end_time" value="{{old('end_time')}}" placeholder="结束时间" id="end" style=" margin-left:10px;"></li>
                        <li style="width:90px;"><button type="submit" class="btn_search"><i class="fa fa-search"></i>查询</button></li>
                        <li style="width:90px;"><button type="button" id="reset" class="btn btn-success" style="background:#ff6e00">重置</button></li>
                    </ul>
                </form>
            </div>
            {{--搜索结束--}}
            <div class="border clearfix"><span class="l_f"><a href="{{route('bg.shop.deletes')}}" class="btn btn-danger shop-deletes"><i class="fa fa-trash"></i> 批量删除</a></span>
                <span class="r_f">共:&nbsp;<b>{{$shop_num}}</b>&nbsp;家店铺</span>
            </div>
            <div class="article_list" style="width: 1300px">
                <form action="">
                {{csrf_field()}}
                <table class="table table-striped table-bordered table-hover" id="sample-table" width="985">
                    <thead>
                    <tr>
                        <th width="25px"><label><input type="checkbox" name="chkAll"  class="ace"><span class="lbl"></span></label></th>
                        <th width="60px">排序</th>
                        <th width="90px">店铺名称</th>
                        <th width="90px">持有人姓名</th>
                        <th width="80px">所属分类</th>
                        <th width="40px">店铺评分</th>
                        <th width="40px">平均消费</th>
                        <th width="100px">简介</th>
                        <th width="100px">店铺电话</th>
                        <th width="120px">店铺地址</th>
                        <th width="50px">添加时间</th>
                        <th width="60px">状态</th>
                        <th width="100px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($shop_list as $k=>$v)
                    <tr>
                        <td><label><input type="checkbox" name="chk[]" value="{{$v -> id}}"  class="ace"><span class="lbl"></span></label></td>
                        <td>{{$k+$shop_list->firstItem()}}</td>
                        <td>{{$v -> shop_name}}</td>
                        <td>{{$v -> sm_name}}</td>
                        <td>{{$v -> sc_name}}</td>
                        <td>{{$v -> grade}}</td>
                        <td>{{$v -> avg_price}}</td>
                        <td>{{$v -> detail}}</td>
                        <td>{{$v -> shop_mobile}}</td>
                        <td>{{$v -> site}}</td>
                        <td>{{date('Y-m-d H:i:s',$v -> add_time)}}</td>
                        <td>
                            @switch($v -> active)
                                @case(1)
                                工作中
                                @break
                                @case(2)
                                打烊了
                                @break
                                @case(3)
                            <a href="{{route('bg.shop.detail',['id'=>$v->id])}}">
                                审核中</a>
                                @break
                                @default
                                禁用
                            @endswitch
                        </td>
                        <td class="td-manage">
                            <a title="禁用" href="{{route('bg.shop.stop',['id'=>$v->id,'active'=>$v->active])}}" class="btn btn-xs shop-stop btn-success" >{{$v->active == 4?'激活':'禁用' }}</a>
                            <a title="删除" href="{{route('bg.shop.delete',['id'=>$v->id])}}" class="btn shop-delete btn-danger" ><i class="fa fa-trash  bigger-120"></i></a>
                        </td>
                    </tr>
                    @empty
                        <td colspan="11">
                            <h3>没有找到相关内容</h3>
                        </td>
                    @endforelse
                    </tbody>
                </table>
                </form>
                <div style="margin-top: -17px">
                    <div style="float: left;font-size: 16px;">共{{ceil($shop_list->total()/$shop_list->count())}}页 当前第{{$shop_list->currentPage()}}页</div>
                    <div style="float: right">{{$shop_list -> appends(['sc_name' => $sc_name,'active' => $active,'shop_name'=>$shop_name]) -> links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    $(function () {
        $(".displayPart").displayPart();
    });
    laydate({
        elem: '#start',
        event: 'focus'
    });
    $(function () {
        $(".displayPart").displayPart();
    });
    laydate({
        elem: '#end',
        event: 'focus'
    });
    //面包屑返回值
    var index = parent.layer.getFrameIndex(window.name);
    parent.layer.iframeAuto(index);
    $('#add_page').on('click', function(){
        var cname = $(this).attr("title");
        var chref = $(this).attr("href");
        var cnames = parent.$('.Current_page').html();
        var herf = parent.$("#iframe").attr("src");
        parent.$('#parentIframe').html(cname);
        parent.$('#iframe').attr("src",chref).ready();
        parent.$('#parentIframe').css("display","inline-block");
        parent.$('.Current_page').attr({"name":herf,"href":"javascript:void(0)"}).css({"color":"#4c8fbd","cursor":"pointer"});
        parent.layer.close(index);
    });
    $(function() {
        var oTable1 = $('#sample-table').dataTable( {
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,1,2,5,6,7,9,10]}// 制定列不参与排序
            ] } );
    });

    $('.shop-stop').click(function(){
        me = this;
        //异步提交
        $.get($(this).attr('href'),'',function(data){
            if(data.status === 'ok'){
                //激活成功
                $(me).text(data.text).attr('href',data.href);
                $(me).closest('td').prev('td').text(data.active);
                layer.tips(data.msg,me,{tips:[2,'#084']});
            }else{
                //激活失败
                layer.tips(data.msg,me,{tips:[2,'#800']})
            }
        },'json');
        //阻止超链接的默认行为
        return false;
    });

    //删除
    $('.shop-delete').click(function () {
        me = this;
        layer.confirm('真的要删除吗？', {icon: 3, title: '删除提示'}, function () {
            $.get($(me).attr('href'), '', function (data) {
                if (data.status === 'ok') {
                    layer.msg(data.msg, {icon: 6, shade: [0.5], time: 2000}, function () {
                        $(me).closest('tr').detach();
                    })
                } else {
                    layer.msg(data.msg, {icon: 5, shade: [0.5], time: 2000})
                }
            }, 'json');
        });
        //阻止超链接的默认行为
        return false;
    });

    //批量删除
    $('.shop-deletes').click(function(){
        me = this;
        layer.confirm('确认都要删除吗？',{icon:3,title:'删除提示'},function(){
            $.post($(me).attr('href'),$('form').serialize(),function(data){
                if(data.status === 'ok'){
                    layer.msg(data.msg,{icon:6,shade:[0.5],time:2000},function(){
                        $('input[name="chk[]"]:checked').closest('tr').detach();
                    })
                }else{
                    layer.msg(data.msg,{icon:5,shade:[0.5],time:2000})
                }
            })
        });
        //阻止默认的超链接行为
        return false;
    });


    //清空搜索条件
    $('#reset').click(function () {
        $('.search_style').find('input').val('');
    })

</script>