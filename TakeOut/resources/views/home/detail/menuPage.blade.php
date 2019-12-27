<ul class="products" >
@forelse($shop_menu as $v)
    <li>
        <a href="{{route('home.menuDetail',['uid'=> $v ->id ] ) }}" target="_blank" title="{{ $v -> menu_name }}">
            <img src="/{{$v->image_dir.$v -> image}}" class="foodsimgsize">
        </a>
        <a href="#" class="item">
            <div>
                <p>{{ $v -> menu_name }}</p>
                <p class="AButton">拖至购物车:￥{{ $v -> price }}</p>
            </div>
        </a>
    </li>
@empty
    <li>
        <p style="text-align:center;font-size:30px;font-weight: bold">该商家没有菜哦！</p>
    </li>
@endforelse
</ul>
<ul class="am-pagination am-pagination-right listpage" style="float:right;margin-right: 10px">
    {!!$show!!}
</ul>
