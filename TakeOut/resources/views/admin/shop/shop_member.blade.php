<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/admin/css/style.css"/>
    <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/admin/assets/css/font-awesome.min.css" />
    <!--[if IE 7]>
    <link rel="stylesheet" href="/admin/assets/css/font-awesome-ie7.min.css" />
    <![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
    <![endif]-->
    <script src="/admin/assets/js/jquery.min.js"></script>
    <!-- <![endif]-->
    <!--[if IE]>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <![endif]-->
    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='/admin/assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
    </script>
    <!-- <![endif]-->
    <!--[if IE]>
    <script type="text/javascript">
        window.jQuery || document.write("<script src='/admin/assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
    </script>
    <![endif]-->

    <script type="text/javascript">
        if("ontouchend" in document) document.write("<script src='/admin/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <!-- page specific plugin scripts -->
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="/admin/js/H-ui.js"></script>
    <script type="text/javascript" src="/admin/js/H-ui.admin.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/js/layer/layer.js"></script>
    <script src="/js/laydate/laydate.js"></script>
    <title>用户列表</title>
</head>

<body>
<div class="page-content clearfix">
    <div id="Member_Ratings">
        <div class="d_Confirm_Order_style">
            <div class="search_style">
                <form action="">
                    <ul class="search_content clearfix">
                        <li>
                            <label class="l_f">会员名称</label>
                            <input name="username" type="text" value="{{old('username')}}" class="text_add" placeholder="输入会员名称"  style=" width:150px"/>
                        </li>
                        <li>
                            <label class="l_f">添加时间起始</label>
                            <input class="text_add" autocomplete="off" value="{{old('start_time')}}" id="start_time" name="start_time" style=" margin-left:10px;width: 200px;height: 28px;font-size: 14px">
                        </li>
                        <li>
                            <label class="l_f">添加时间结束</label>
                            <input class="text_add" autocomplete="off" value="{{old('end_time')}}" id="end_time" name="end_time" style=" margin-left:10px;width: 200px;height: 28px;font-size: 14px">
                        </li>
                        <li>
                            <label class="l_f">状态&nbsp;</label>
                            <select name="active" class="text_add" style="width: 100px" >
                                <option value="3" {{ old('active')==3 ? 'selected' : '' }}>全部</option>
                                <option value="1" {{ old('active')==1 ? 'selected' : '' }}>激活</option>
                                <option value="2" {{ old('active')==2 ? 'selected' : '' }}>禁用</option>
                            </select>
                        </li>
                        <li style="width:90px;"><button type="submit" class="btn_search"><i class="icon-search"></i>查询</button></li>
                    </ul>
                </form>
            </div>
            <!---->
            <!---->
            <div class="table_menu_list">
                <table class="table table-striped table-bordered table-hover" id="sample-table">
                    <thead>
                    <tr>
                        <th width="80">编号</th>
                        <th width="100">用户名</th>
                        <th width="120">手机</th>
                        <th width="180">注册时间</th>
                        <th width="70">状态</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($shop_member as $k => $v)
                        <tr>
                            <td>{{$v -> id}}</td>
                            <td>{{$v -> shop_member_name}}</td>
                            <td>{{$v -> mobile}}</td>
                            <td>{{date('Y-m-d H:i:s',$v -> add_time) }}</td>
                            <td><a class='shop-member-active2' href="{{route('bg.shop.member.active2',['id'=>$v->id,'active'=>$v->active])}}">{{$v -> active == 1? '激活' : '禁用'}}</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9"><h3>暂时没有符合条件的数据</h3></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div>共&nbsp;{{$shop_member->total()}}&nbsp;条数据 当前第&nbsp;{{$shop_member->currentPage()}}&nbsp;页</div>
                <div style="float: right">{{$shop_member -> appends(['shop_member_name'=>$shop_member_name,'active'=>$active]) -> links()}}</div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
<script>
    jQuery(function($) {
        var oTable1 = $('#sample-table').dataTable( {
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
            ] } );

        $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function(){
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });
        });


        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table');
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }
    });

    //激活/禁用
    $('.shop-member-active2').click(function(){
        me = this;
        //异步提交
        $.get($(this).attr('href'),'',function(data){
            if(data.status === 'ok'){
                //激活成功
                $(me).text(data.text).attr('href',data.href);
                layer.tips(data.msg,me,{tips:[4,'#084']});
            }else{
                //激活失败
                layer.tips(data.msg,me,{tips:[4,'#800']})
            }
        },'json');
        //阻止超链接的默认行为
        return false;
    });


    laydate.render({
        elem:'#start_time',
        type:'datetime'
    });

    laydate.render({
        elem:'#end_time',
        type:'datetime'
    });

</script>