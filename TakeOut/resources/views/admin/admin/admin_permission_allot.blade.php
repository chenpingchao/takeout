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
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/admin/js/jquery.idTabs.min.js"></script>
    <script type="text/javascript" src="/admin/js/select-ui.min.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <title>添加权限</title>
</head>
<style>
    table{
        width:100%;
        border:1px solid #ccc;
    }

    table td{
        height: 25px;
        border:1px dotted #ccc;
        padding:10px;
    }

    table td input{
        vertical-align: middle;
    }

    table td li{
        margin:8px;
        float:left;
    }
</style>
<body>
<div class="Competence_add_style clearfix">
    <!--权限分配-->
    <div class="title_name">权限分配</div>
    <div class="formbody">
        <div id="usual1" class="usual">
            <div id="tab2" class="tabson" style="height:400px;overflow-y: scroll">
                <form action="" method="post" id="deletes_form">
                {{csrf_field()}}
                <!-- 列表 -->
                    <table>
                        @forelse($permissions as $v)
                            <tr>
                                <td width="110">
                                    <input class="top-permission" name="chk[]" id="{{$v->id}}" type="checkbox"  {{$v->is_permission or ''}}  value="{{$v->id}}" />
                                    <label for="{{$v->id}}"> {{$v->display_name}} </label>
                                </td>
                                <td>
                                    <ul>
                                        @foreach($v->child as $v2)
                                            <li>
                                                <input class="sub-permission" name="chk[]" id="{{$v2->id}}" type="checkbox"  {{$v2->is_permission or ''}}  value="{{$v2->id}}" />
                                                <label for="{{$v2->id}}"> {{$v2->display_name}} </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    <h1>没有找到相关的记录</h1>
                                </td>
                            </tr>
                        @endforelse
                        <tr>
                            <td>
                                <input type="checkbox" name="chkAll"  id="chkAll"/>
                                <label for="chkAll"> 全选</label>
                            </td>
                            <td>
                                <button class="btn assign-permission"  href="{{route('bg.admin.ad_Permission_allot',['roleId'=>$roleId])}}" >确认权限分配</button>
                                <a href="{{route('bg.admin.Power')}}" class="btn btn-secondary  btn-warning" type="button">返回上一步</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">

    //隔行换色
    $("#usual1 ul").idTabs();

    //点击全选按钮
    $('input[name="chkAll"]').on('change',function(){
        $('input[name="chk[]"]').prop("checked",$(this).prop("checked"));
    });

    //点击各个商品的复选按钮时
    $('input[name="chk[]"]').on('change',function(){
        $('input[name="chkAll"]').prop( 'checked' , !$('input[name="chk[]"]:not(:checked)').length );
    });

    //顶级权限全选全不选
    $('.top-permission').change(function(){
        $(this).closest('td').next('td').find('input').prop('checked',$(this).prop('checked'))
    });

    $('.sub-permission').change(function(){
        //未勾选的子权限数量
        var length = $(this).closest('td').find('input:not(:checked)').length;
        //上级权限勾选状态
        $(this).closest('td').prev('td').find('input').prop('checked',!length);
    });
    //权限分配
    $('.assign-permission').click(function(){
        var that=this;
        parent.layer.confirm('确认权限分配?',{icon:3,title:'权限分配提示'},function(){
            $.post($(that).attr('href'),$('form').serialize(),function(data){
                if(data.status === 'ok'){
                    parent.layer.msg(data.msg,{icon:1, time:1000, shade:[0.6,'#000000']},function(){
                        top.iframe.location.reload();
                        location = '{{route('bg.admin.Power')}}';
                    })
                }else{
                    parent.layer.msg(data.msg,{icon:2, time:2000, shade:[0.6,'#000000']})
                }

            })
        });
        return false;
    });
    //返回上一步
</script>
