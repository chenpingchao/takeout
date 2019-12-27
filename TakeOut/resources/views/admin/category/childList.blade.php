@foreach($category as $k => $v)
    <tr path="{{$v -> path}}">
        <td width="80px" ></td>
        <td width="250px" style="text-align: left">{{$v -> cate_name}}
            @if($v -> child_num > 0)
                <span class="extend" url="{{route('admin.category.childList',['pid'=>$v->id]) }}">+</span>
            @endif
        </td>
        <td width="250px">{{$v -> parent_name}}</td>
        <td class="td-status">
            <span url="{{route('admin.category.active',['path'=> $v -> path,'active'=> $v -> active]) }}" class="label label-success radius active">
                {{$v -> active == 1 ? '激活' : '停用' }}
            </span>
        </td>
        <td class="td-manage">
            <a title="编辑"  href="{{route('admin.category.edit',['id' => $v -> id])}}"  class="btn btn-xs btn-info edit" ><i class="icon-edit bigger-120"></i></a>
            <a title="添加子分类" href="{{route('admin.category.add',['pid' => $v -> id])}}"  class="btn btn-xs btn-warning child-add" ><i class="icon-plus bigger-120"></i></a>
        </td>
    </tr>
@endforeach
