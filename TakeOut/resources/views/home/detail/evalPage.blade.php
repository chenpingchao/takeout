<div class="cont_padding">
    <table class="Dcomment">
        <th width="80%">评价内容</th>
        <th width="20%" style="text-align:right">评价人</th>
        @forelse($menu_eval as $v)
            <tr>
                <td>
           <span style="color: #ff2f2f;font-size: 20px">
            {{--   <a href="javascript:;" onclick="Guestbook_iew('{{$v->username}}','{{$v->detail}}','{{$v->reply}}')" style="color: #ff2f2f;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:3;">
                {{mb_substr($v -> detail , 0 ,150)}}{{strlen($v -> detail) > 150 ? '...' : ''}}
               </a>--}}
               {{$v -> detail}}
           </span>
                    <time>{{date('Y-m-d H:i:s')}}</time><span>{{empty($v -> reply) ? '(未回复)' : $v->reply}}</span>
                </td>
                <td align="right"><span style="color: #a31;">{{$v -> username}}</span></td>
            </tr>
        @empty
            <tr>
                <td colspan="2">还没有人评论</td>
            </tr>
        @endforelse
    </table>
</div>
<ul class="am-pagination am-pagination-right listpage">
    {!!$show!!}
</ul>
