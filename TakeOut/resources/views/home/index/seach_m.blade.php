@forelse($MenuName as $m)
    <li style="width: 398px">
        <a href="{{route('home.menuDetail',['uid' => $m->id ])}}" title="调用产品名/店铺名"><img style="width:385px;"  src="/{{$m->image_dir}}{{$m->image}}"></a>
        <hgroup>
            <h3>{{$m->menu_name}}</h3>
            <h4></h4>
        </hgroup>
        <p>地址：{{$m->site}}</p>
        <p>原价：{{$m->or_price}}元</p>
        <p>现价：{{$m->price}}元</p>
        <p>
        <span class="Score-l" style="width:220px;">
            @for ($i = 0; $i <ceil(!empty($m->fenshu)?$m->fenshu:5); $i++)
                <img src="/home/images/star-on.png">
            @endfor
            @for ($i = 0; $i <floor(5-(!empty($m->fenshu)?$m->fenshu:5)); $i++)
                <img src="/home/images/star-off.png">
            @endfor
        <span class="Score-v">{{!empty($m->fenshu)?$m->fenshu:5}}</span>
        </span>
            <span class="DSBUTTON">
            <a href="{{route('home.menuDetail',['uid' => $m->id ])}}" class="Fontfff">购物</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{route('home.shopDetail',['sid' => $m->sid ])}}" target="_blank" class="Fontfff">店铺</a>
        </span>
        </p>
    </li>
@empty
    <h2>暂无好吃的菜品信息</h2>
@endforelse