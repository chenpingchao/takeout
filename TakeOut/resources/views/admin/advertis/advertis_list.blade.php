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
    <script src="/js/layer/layer.js"></script>
    <title>广告列表</title>
</head>

<body>
<div class="page-content clearfix">
    <div class="sort_adsadd_style">
        <div class="search_style">
            <!-- 搜索 -->
            <form action="" style="height: 50px">
                <ul class="search_content clearfix" style=>
                    <li>
                        <label class="l_f">广告名称</label>
                        <input name="advertisp_name" type="text" value="{{old('advertis_name')}}" class="text_add" placeholder="输入广告名称"  style=" width:150px"/>
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
                <a href="{{route('bg.advertis.addad',['ap_id'=>$ap_id])}}"  id="ads_add" title="添加广告" class="btn advertis-add btn-warning Order_form"><i class="fa fa-plus"></i> 添加广告</a>
                <a href="javascript:ovid()" onClick="javascript :history.back(-1);" class="btn btn-info"><i class="fa fa-reply"></i> 返回上一步</a>
            </span>
            <span class="r_f">共：<b>{{$advertis_num}}</b>个广告</span>
            </div>
        </div>
        <!--列表样式-->
        <div class="sort_Ads_list">
            <table class="table table-striped table-bordered table-hover" id="sample-table">
                {{csrf_field()}}
                <thead>
                <tr>
                    <th>编号<i class="sort"></i></th>
                    <th>广告标题</th>
                    <th>广告图片</th>
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th>是否启用</th>
                    <th>操作</th>
                </tr>
                </thead>
                <form action="" method="post">
                    {{csrf_field()}}
                    <tbody>
                    @forelse( $advertis_list as $key=>$v)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$v->advertis_name}}</td>
                            <td><img src="/{{$v->img_dir}}{{$v->image}}" alt="" style="max-width:400px" height="70px"/></td>
                            <td>{{date('Y-m-d H:i:s',$v->start_time)}}</td>
                            <td>{{date('Y-m-d H:i:s',$v->end_time)}}</td>
                            <td>
                                <a href="{{route('bg.advertis.active1',['id'=>$v->id,'active'=>$v->active])}}" class="advertis_active1">
                                    {{$v->active == 1 ? '显示':'不显示'}}
                                </a>
                            </td>
                            <td>
                                <a href="{{route('bg.advertis.delete1',['id'=>$v->id])}}" class="btn advertis-delete1 btn-xs btn-warning">删除</a>
                                <a href="{{route('bg.advertis.editad',['id'=>$v->id])}}" class="btn btn-xs advertis-edit btn-info">编辑</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <h1>没有找到满足条件的记录</h1>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </form>
            </table>
            <div class="page_div">
                <div class="message">共<i class="blue">{{$advertis_list->total()}}</i>条记录，当前显示第&nbsp;<i class="blue">{{$advertis_list->currentPage()}}&nbsp;</i>页</div>
                {{$advertis_list->links()}}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //激活与禁用
    $('.advertis_active1').click(function(){
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
    //删除
    $('.advertis-delete1').click(function(){
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
    //弹出添加广告窗口
    $('.advertis-add').click(function(){
        parent.layer.open({
            type:2,
            title:'为当前广告位添加广告',
            area:['1000px','600px'],
            content:$(this).attr('href')
        });
        //阻止超链接的默认行为
        return false;
    });
    //弹出编辑广告窗口
    $('.advertis-edit').click(function(){
        parent.layer.open({
            type:2,
            title:'编辑广告',
            area:['1000px','600px'],
            content:$(this).attr('href')
        });
        //阻止超链接的默认行为
        return false;
    });
</script>
</body>
</html>