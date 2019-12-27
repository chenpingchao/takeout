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
    <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/colorbox.css">
    <!--图片相册-->
    <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />

    <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
    <![endif]-->

    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/admin/assets/js/jquery.colorbox-min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script type="text/javascript" src="/admin/Widget/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="/admin/Widget/swfupload/swfupload.queue.js"></script>
    <script type="text/javascript" src="/admin/Widget/swfupload/swfupload.speed.js"></script>
    <script type="text/javascript" src="/admin/Widget/swfupload/handlers.js"></script>
    <title>广告位列表</title>
</head>

<body>
<div class="page-content clearfix">
    <div class="sort_adsadd_style">
        <div class="search_style">
            <!-- 搜索 -->
            <form action="{{route('bg.advertis.index')}}" style="height: 50px">
                <ul class="search_content clearfix" style=>
                    <li>
                        <label class="l_f">广告位名称</label>
                        <input name="advertisp_name" type="text" value="{{old('advertisp_name')}}" class="text_add" placeholder="输入广告位名称"  style=" width:150px"/>
                    </li>
                    <li>
                        <label class="l_f">状态&nbsp;</label>
                        <select name="active" class="text_add" style="width: 100px" >
                            <option value="3" {{ old('active')==3 ? 'selected' : '' }}>全部</option>
                            <option value="1" {{ old('active')==1 ? 'selected' : '' }}>显示</option>
                            <option value="2" {{ old('active')==2 ? 'selected' : '' }}>不显示</option>
                        </select>
                    </li>
                    <li style="width:90px;">
                        <button type="submit" class="btn_search"><i class="icon-search"></i>查询</button>
                    </li>
                </ul>
            </form>
            <div class="border clearfix">
            <span class="l_f">
                <a href="{{route('bg.advertis.add')}}"  id="ads_add" title="添加品牌" class="btn advertisP-add btn-warning Order_form"><i class="fa fa-plus"></i> 添加广告位</a>
                <a href="{{route('bg.advertis.deletes')}}" class="btn advertisP-deletes btn-danger"><i class="fa fa-trash"></i> 批量删除</a>
                <a href="javascript:ovid()" onClick="javascript :history.back(-1);" class="btn btn-info"><i class="fa fa-reply"></i> 返回上一步</a>
            </span>
            <span class="r_f">共：<b>{{$advertis_index_num}}</b>个广告位</span>
            </div>
        </div>
            <!--列表样式-->
        <div class="sort_Ads_list">
            <form action="">
            {{csrf_field()}}
            <table class="table table-striped table-bordered table-hover" id="sample-table">
                <thead>
                <tr>
                    <th width="25"><label><input type="checkbox" name="chkAll" checked="checked" class="ace"><span class="lbl"></span></label></th>
                    <th width="80px">编号</th>
                    <th width="100">广告位名称</th>
                    <th width="50px">序号</th>
                    <th width="70px">尺寸高度</th>
                    <th width="70px">尺寸宽度</th>
                    <th width="150px">描述</th>
                    <th width="120">加入时间</th>
                    <th width="70">状态</th>
                    <th width="150">操作</th>
                </tr>
                </thead>
                <tbody>
                @forelse($advertis_index as $k => $v)
                <tr>
                    <td><label><input type="checkbox" name="chk[]" value="{{$v->id}}" class="ace"><span class="lbl"></span></label></td>
                    <td>{{$k+$advertis_index->firstItem()}}</td>
                    <td>{{$v->advertisP_name}}</td>
                    <td>{{$v->id}}</td>
                    <td>{{$v->height}}</td>
                    <td>{{$v->width}}</td>
                    <td><a>{{$v->description}}</a></td>
                    <td>{{date('Y-m-d H:i:s',$v -> add_time)}}</td>
                    <td class="td-status">
                        <a href="{{route('bg.advertis.active',['id'=>$v->id,'active'=>$v->active])}}" class="advertis_active">
                            {{$v->active == 1 ? '显示':'不显示'}}
                        </a>
                    </td>
                    <td class="td-manage">
                        <a href="{{route('bg.advertis.details',['id'=>$v->id])}}" title="详情" class="btn btn-xs btn-success"><i class="fa fa-check bigger-120"></i></a>
                        <a href="{{route('bg.advertis.edit',['id'=>$v->id])}}" title="编辑" class="btn btn-xs advertisP-edit btn-info" ><i class="fa fa-edit bigger-120"></i></a>
                        <a href="{{route('bg.advertis.delete',['id'=>$v->id])}}" title="删除" class="btn advertisP-delete btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10">
                        <h1>没有找到满足条件的记录</h1>
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
            </form>
            <div class="page_div">
                <div class="message">共<i class="blue">{{$advertis_index->total()}}</i>条记录，当前显示第&nbsp;<i class="blue">{{$advertis_index->currentPage()}}&nbsp;</i>页</div>
                {{$advertis_index->links()}}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //激活与禁用
    $('.advertis_active').click(function(){
        me = this;
        //异步提交
        $.get($(this).attr('href'),'',function(data){
            if(data.status === 'ok'){
                //激活成功
                $(me).text(data.text).attr('href',data.href);
                layer.tips(data.msg,me,{tips:[2,'#084']});
            }else{
                //激活失败
                layer.tips(data.msg,me,{tips:[2,'#800']})
            }
        },'json');
        //阻止超链接的默认行为
        return false;
    });
    //全选全不选
    $('input[name="chkAll"]').click(function(){
        $('input[name="chk[]"]').prop( 'checked' , $(this).prop('checked') );
    });
    $('input[name="chk[]"]').click(function(){
        $('input[name="chkAll"]').prop( 'checked' , !$('input[name="chk[]"]:not(:checked)').length );
    });
    //删除
    $('.advertisP-delete').click(function(){
        me = this;
        layer.confirm('确认要删除吗？',{icon:3,title:'删除提示'},function(){
            $.get($(me).attr('href'),'',function(data){
                if(data.status === 'ok'){
                    layer.msg(data.msg,{icon:6,shade:[0.5],time:2000},function(){
                        $(me).closest('tr').detach();
                    })
                }else{
                    layer.msg(data.msg,{icon:5,shade:[0.5],time:2000})
                }
            },'json')
        });
        //阻止默认的提交行为
        return false;
    });
    //批量删除
    $('.advertisP-deletes').click(function(){
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
    $('.advertisP-add').click(function(){
        parent.layer.open({
            type:2,
            title:'添加广告位',
            area:['800px','450px'],
            content:[$(this).attr('href'),'no']
        });
        //阻止超链接的默认行为
        return false;
    });

    //弹出编辑广告位窗口
    $('.advertisP-edit').click(function(){
        parent.layer.open({
            type:2,
            title:'编辑广告位',
            area:['800px','500px'],
            content:[$(this).attr('href'),'no']
        });
        //阻止超链接的默认行为
        return false;
    });
</script>
</html>