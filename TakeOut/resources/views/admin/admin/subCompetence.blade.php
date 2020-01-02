@foreach($permissions as $k=>$v)
    @php
        //级别
         $display_name = str_repeat('&emsp;&emsp;', count ( explode(',',$v -> path) )-1 ) . $v->display_name;
    @endphp

    <tr title="{{$v->path}}">
        <td></td>
        <td>
            {{$display_name}}
            <span title="{{route('bg.admin.ad_Permission_son',['pid'=>$v->id])}}" class="extend">{{$v->child_num>0?'+' : ''}}</span>
        </td>
        <td>{{$v->name}}</td>
        <td>{{$v->parent_name}}</td>

        <td>
            <a href="{{route('bg.admin.ad_Permission_add',['id'=>$v->id])}}" class="admin_Permission_add">添加子分类</a>
            <a href="{{route('bg.admin.ad_Permission_edit',['id'=>$v->id])}}" class="admin_Permission_edit">编辑</a>
            <a href="{{route('bg.admin.ad_Permission_del',['id'=>$v->id])}}" class="admin_Permission_del">删除</a>
        </td>
    </tr>
@endforeach

<script type="text/javascript">
    /*管理员角色添加*/
    $('.admin_Permission_add').on('click', function(){
        parent.layer.open({
            type: 2,
            title:'分类添加',
            area: ['420px','300px'],
            shadeClose: false,
            content: [$(this).attr('href'),'no'] ,
        });
        //阻止超链接的默认行为
        return false;
    })
    /*管理员角色添加*/
    $('.admin_Permission_edit').on('click', function(){
        parent.layer.open({
            type: 2,
            title:'分类添加',
            area: ['420px','300px'],
            shadeClose: false,
            content: [$(this).attr('href'),'no'] ,
        });
        //阻止超链接的默认行为
        return false;
    })
    //删除权限
    $('.admin_Permission_del').click(function(){
        var me = this;
        parent.layer.confirm('确定要删除吗?',{icon:3,title:'删除提示'},function(){
            $.get($(me).attr('href'),'',function(data){
                if (data.status==='ok'){
                    parent.layer.msg(data.msg,{icon:6,shade:[0.6],time:1000},function () {
                        $(me).closest('tr').detach();
                        //最近的 tr      分离
                        location = data.url;
                    });
                } else{
                    parent.layer.msg(data.msg,{icon:5,shade:[0.6]})
                }
            },'json');
        });
        //阻止超链接的默认行为
        return false;
    });
</script>