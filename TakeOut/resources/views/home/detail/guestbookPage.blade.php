@forelse($guestbook as $v)
    {{--店铺留言--}}
    <span class="Ask"><i>{{$v -> username}}</i>:{{$v -> content }}</span>
        @if($v -> reply)
            <span class="Answer"><i>{{$v -> reply_name}}回复</i>：{{$v -> reply}}</span>
        @else
            <span class="Answer">商家还没有回复呦！</span>
        @endif
    @empty
    <span>没有查询的数据</span>
@endforelse
<ul class="am-pagination am-pagination-right listpage" style="float:right;">
    {!!$show!!}
</ul>