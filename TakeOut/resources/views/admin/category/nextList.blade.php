<option value="999" {{$cid == 999 ? 'selected' : ''}}>请选择</option>
@foreach($nextCate as $v)
    <option value="{{$v -> id}}" {{$cid == $v -> id ? 'selected' : ''}}>{{$v -> cate_name}}</option>
@endforeach
