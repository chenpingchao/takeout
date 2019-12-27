@forelse($menu_comment as $v)
{{--    菜品评论-----}}
    <div class="shopcomment">
        <div class="Spname">
            <a href="{{route('home.menuDetail',['uid'=>$v->uid])}}" target="_blank" title="酸辣土豆丝">{{$v->menu_name}}</a>
        </div>
        <div class="C-content">
            <q>{{$v -> detail}}</q>
            <i>{{ date('Y-m-d H:i:s',$v ->add_time) }}</i>
        </div>
        <div class="username">
            用户： {{$v ->username}}
        </div>
    </div>
    <div class="shopcomment">
        <div class="Spname">
            &emsp;
        </div>
        <div class="username">
            {{$v ->reply_name}} 回复：
        </div>
        <div class="C-content">
            <q>{{$v -> reply}}</q>

        </div>
    </div>
@empty
    <div>暂时没有评论</div>
    @endforelse
<ul class="am-pagination am-pagination-right listpage" style="float:right;">
    {!!$show!!}
</ul>