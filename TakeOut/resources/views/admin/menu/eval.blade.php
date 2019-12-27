<table>
    <th width="80%">评价内容</th>
    <th width="20%" style="text-align:right">评价人</th>
    @forelse($menu_eval as $v)
        <tr>
            <td>
       <span>
           <a href="javascript:;" onclick="Guestbook_iew('{{$v->username}}','{{$v->detail}}')" style="color: #ff2f2f;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:3;">
            {{mb_substr($v -> detail , 0 ,150)}}{{strlen($v -> detail) > 150 ? '...' : ''}}
           </a>
       </span>
                <time>{{date('Y-m-d H:i:s')}}</time>
            </td>
            <td align="right"><span style="color: #a31;">{{$v -> username}}</span></td>
        </tr>
    @empty
        <tr>
            <td colspan="2">还没有人评论</td>
        </tr>
    @endforelse
</table>
