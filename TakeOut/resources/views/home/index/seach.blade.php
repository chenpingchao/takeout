@forelse($ShopName as $s)
    <li style="width:398px;">
        <a href="{{route('home.shopDetail',['sid' => $s->id ])}}" target="_blank" title="{{$s -> sc_name}}/{{$s -> shop_name}}">
            <img style="width:385px;" src="{{$s->image}}">
        </a>
        <hgroup>
            <h3>{{$s->shop_name}}</h3>
            <h4></h4>
        </hgroup>
        <p>店铺类别：{{$s->sc_name}}</p>
        <p>地址：{{$s->site}}{{$s->location}}</p>
        <p>人均：{{$s->avg_price}}元</p>
        <p style="">
   <span class="Score-l" style="width:220px;">
    @for ($i = 0; $i <ceil(!empty($s->grade)?$s->grade:5); $i++)
           <img src="/home/images/star-on.png">
       @endfor
       @for ($i = 0; $i <floor(5-(!empty($s->grade)?$s->grade:5)); $i++)
           <img src="/home/images/star-off.png">
       @endfor
    <span class="Score-v">{{!empty($s->grade)?$s->grade:5}}</span>
    </span>
    </span>
            <span class="DSBUTTON">
                <a href="{{route('home.shopDetail',['sid' => $s->id ])}}" target="_blank" class="Fontfff">进店</a>
            </span>
        </p>
    </li>
@empty
    <h2>暂无好吃的菜品信息</h2>
@endforelse