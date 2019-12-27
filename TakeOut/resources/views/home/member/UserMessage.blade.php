@extends('home.public.public')
{{--截取头部--}}
@section('header')
<head>
<meta charset="utf-8" />
<title>DeathGhost-用户中心</title>
<meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
<meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
<meta name="author" content="DeathGhost"/>
    <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/home/js/public.js"></script>
    <script type="text/javascript" src="/home/js/jquery.js"></script>
    <script type="text/javascript" src="/home/js/jqpublic.js"></script>
    <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript"></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
<!--
Author: DeathGhost
Author URI: http://www.deathghost.cn
-->
    <script type="text/javascript">
        $(function(){
            $("#right ul li:first span").css("color","black");
            $("#right ul li:last span").css("color","black");
        })
    </script>
    <style>
        #right{
            float:right;
        }
        #right ul li{
            display:inline;
            font-weight: bold;
            margin-left:10px;
        }
        #right ul li span{
            color: red;
        }
    </style>
</head>
@endsection
{{--截取主体--}}
@section('main')
<!--Start content-->
<section class="Psection MT20">
<nav class="U-nav Font14 FontW">
  <ul>
      <li><i></i><a href="{{route('hm.mem.UserCenter')}}">用户中心首页</a></li>
      <li><i></i><a href="{{route('hm.mem.UserOrder')}}">我的订单</a></li>
      <li><i></i><a href="{{route('hm.mem.UserAddress')}}">收货地址</a></li>
      <li><i></i><a href="{{route('hm.mem.UserMessage')}}">我的留言</a></li>
      <li><i></i><a href="{{route('hm.mem.UserCoupon')}}">我的优惠券</a></li>
      <li><i></i><a href="{{route('hm.mem.UserFavorites')}}">我的收藏</a></li>
      <li><i></i><a href="{{route('hm.mem.UserAccount')}}">账户管理</a></li>
      <li><i></i><a href="{{route('home.logout')}}">安全退出</a></li>
  </ul>
 </nav>
 <article class="U-article Overflow">
  <!--user message-->
  <section class="Mymessage Overflow">
      <div>
      <span class="Mmtitle Block Font14 FontW Lineheight35">我的店铺留言</span>

      <table class="Myorder">
          <thead>
          <tr>
              <th width="100px">留言时间</th>
              <th>留言内容</th>
              <th width="100px">店铺名</th>
              <th>回复内容</th>
              <th width="100px">操作</th>
          </tr>
          </thead>
          <tbody>
          @forelse($Guestbook as $k=>$v)
          <tr>
              <td class="FontW">{{date('Y-m-d H:i:s',$v->add_time)}}</td>
              <td class="FontW">
                  {{$v->content}}
              </td>
              <td>
                  <span>{{$v->shop_name}}：</span>
              </td>
              <td class="CorRed">
                   {{$v->reply}}
              </td>
              <td><a class="UserMessage-delete" href="{{route('hm.mem.UserMessage_del',['id'=>$v->id])}}" style="background-color:#84AF9B; border-radius:3px;height:20px;width:25px;color:#F0FFFF;">删除留言</a></td>
          </tr>
          </tbody>
          @empty
              <tr>
                  <td colspan="5">
                      <h3>没找到满足条件的数据</h3>
                  </td>
              </tr>
          @endforelse
      </table>
      <div style="font-weight: bold;">当前页共{{$Guestbook->count()}}条记录,为第{{$Guestbook->currentPage()}}页</div>
      <div align="rignt" id="right">
          {{$Guestbook->links()}}
      </div>
      </div>
      <br><hr>
      <div>
      <span class="Mmtitle Block Font14 FontW Lineheight35">我的菜品评论</span>
      <table class="Myorder">
          <thead>
          <tr>
              <th width="100px">评论时间</th>
              <th>评论内容</th>
              <th width="100px">菜品名</th>
              <th width="100px">店铺名</th>
              <th>回复内容</th>
              <th width="50px">评分</th>
              <th width="100px">操作</th>
          </tr>
          </thead>
          <tbody>
          @forelse($MenuComment as $k=>$v)
              <tr>
                  <td class="FontW">{{date('Y-m-d H:i:s',$v->add_time)}}</td>
                  <td class="FontW">{{$v->detail}}</td>
                  <td class="FontW">{{$v->menu_name}}</td>
                  <td class="FontW">{{$v->shop_name}}</td>
                  <td class="FontW">{{$v->reply}}</td>
                  <td class="FontW">{{$v->fenshu}}分</td>
                 <td><a class="UserMessage-deleteMC" href="{{route('hm.mem.UserMessage_delMC',['id'=>$v->id])}}" style="background-color:#84AF9B; border-radius:3px;height:20px;width:25px;color:#F0FFFF;">删除留言</a></td>
              </tr>
          </tbody>
          @empty
              <tr>
                  <td colspan="6">
                      <h3>没找到满足条件的数据</h3>
                  </td>
              </tr>
          @endforelse
      </table>
          <div style="font-weight: bold;">当前页共{{$MenuComment->count()}}条记录,为第{{$MenuComment->currentPage()}}页</div>
          <div align="rignt" id="right">
              {{$MenuComment->links()}}
          </div>
      </div>
  </section>
 </article>
</section>
<!--End content-->
@endsection
<!--另起炉灶 js-->
@section('script')
<script>
    //删除
    $('.UserMessage-delete').click(function () {
        var me=this;
        layer.confirm('确认要删除吗?',{icon:3,title:'删除提示'},function () {
            $.get($(me).attr('href'),'',function (data) {
                if (data.status==='ok'){
                    layer.msg(data.msg,{icon:6,shade:[0.6],time:1000},function () {
                        $(me).closest('tr').detach();
                        //     最近的  tr      分离
                        location = '{{route("hm.mem.UserMessage")}}';
                    })
                } else{
                    layer.msg(data.msg,{icon:5,shade:[0.6]})
                }
            },'json')
        });
        //阻止超链接默认行为
        return false;
    });

    //删除MC
    $('.UserMessage-deleteMC').click(function () {
        var me=this;
        layer.confirm('确认要删除吗?',{icon:3,title:'删除提示'},function () {
            $.get($(me).attr('href'),'',function (data) {
                if (data.status==='ok'){
                    layer.msg(data.msg,{icon:6,shade:[0.6],time:1000},function () {
                        $(me).closest('tr').detach();
                        //     最近的  tr      分离
                        location = '{{route("hm.mem.UserMessage")}}';
                    })
                } else{
                    layer.msg(data.msg,{icon:5,shade:[0.6]})
                }
            },'json')
        });
        //阻止超链接默认行为
        return false;
    });
</script>
@endsection