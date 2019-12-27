@extends('home.public.public')
{{--截取头部--}}
@section('header')
<head>
<meta charset="utf-8" />
<title>用户中心-我的订单</title>
<meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
<meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
<meta name="author" content="DeathGhost"/>
    <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/home/js/public.js"></script>
    <script type="text/javascript" src="/home/js/jquery.js"></script>
    <script type="text/javascript" src="/home/js/jqpublic.js"></script>
    <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript"></script>
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
  <!--user order list-->
  <section>
    <table class="Myorder">
        <thead>
            <tr>
                <th class="Font14 FontW">订单编号</th>
                <th class="Font14 FontW">下单时间</th>
                <th class="Font14 FontW">收件人</th>
                <th class="Font14 FontW">订单总金额</th>
                <th class="Font14 FontW">订单状态</th>
                <th class="Font14 FontW">操作</th>
            </tr>
        </thead>
        @forelse($orders as $k=>$v)
        <tbody>
            <tr>
                <td class="FontW"><a href="#">{{$v->orders_num}}</a></td>
                <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->orders_price}}</td>
                <td>
                    @switch($v->active)
                        @case(1)
                        未付款
                        @break
                        @case(2)
                        待发货
                        @break
                        @case(3)
                        待签收
                        @break
                        @case(4)
                        待评论
                        @break
                        @case(5)
                        已评论
                        @break
                        @case(6)
                        待退款
                        @break
                        @case(7)
                        已退款
                        @break
                        @default
                    @endswitch
                </td>
                <td>
                    @if($v->active==1)
                        <a class="OrderAct1-delete" href="{{route('hm.mem.UserOrder_Act',['id'=>$v->id,'act'=>1])}}" style="background-color:#84AF9B; border-radius:3px;height:25px;width:30px;color:#F0FFFF;">取消订单</a>
                        <a href="{{route('home.cart')}}" style="background-color:#84AF9B; border-radius:3px;height:25px;width:30px;color:#F0FFFF;">付款</a>
                    @elseif($v->active==3)
                        <a class="OrderAct2-upd" href="{{route('hm.mem.UserOrder_Act',['id'=>$v->id,'act'=>2])}}" style="background-color:#84AF9B; border-radius:3px;height:25px;width:30px;color:#F0FFFF;">确认到货</a>
                    @elseif($v->active==4)
                        <a href="javascript:UserOrder_adds('{{$v->id}}')" style="background-color:#84AF9B; border-radius:3px;height:25px;width:30px;color:#F0FFFF;">发起评论</a>
{{--delete--}}
                    @elseif($v->active==7)
                        <a class="OrderAct7-delete" href="{{route('hm.mem.UserOrder_Act',['id'=>$v->id,'act'=>3])}}" style="background-color:#84AF9B; border-radius:3px;height:25px;width:30px;color:#F0FFFF;">退款成功,删除订单</a>
                    @endif
{{--select  route('hm.mem.UserOrder_Act',['id'=>$v->id,'act'=>5])--}}
                    @if($v->active > 4){{--发起一个弹窗 查看评论--}}
                        <a href="javascript:UserOrder_Acts('{{$v->id}}')" style="background-color:#84AF9B; border-radius:3px;height:25px;width:30px;color:#F0FFFF;">查看评论</a>
                    @endif
{{--退款->6--}}
                    @if($v->active > 1 and $v->active < 6)
                        <a class="OrderAct-upd" href="{{route('hm.mem.UserOrder_Act',['id'=>$v->id,'act'=>4])}}" style="background-color:#84AF9B; border-radius:3px;height:25px;width:30px;color:#F0FFFF;">退款申请</a>
                    @endif
                </td>
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
      <div style="font-weight: bold;">当前页共{{$orders->count()}}条记录,为第{{$orders->currentPage()}}页</div>
      <div align="rignt" id="right">
          {{$orders->links()}}
      </div>
  </section>
 </article>
</section>
<!--End content-->
@endsection
<!--另起炉灶 js-->
@section('script')
<script>
    //取消订单
    $('.OrderAct1-delete').click(function(){
        var me = this;
        $.get($(this).attr('href'),'',function(data){
            if (data.status==='ok'){
                //激活成功
                //成功应该干啥{----}
                layer.tips(data.msg,me,{tips:[1,'#090'],time:2000,success:function(){
                        $(me).closest('tr').detach();
                        // location.reload();
                }
                });
            } else{
                //激活失败
                layer.tips(data.msg,me,{tips:[1,'#900']});
            }
        },'json');
        //阻止超链接的默认行为
        return false;
    });
    //退款成功,删除订单
    $('.OrderAct7-delete').click(function(){
        var me = this;
        $.get($(this).attr('href'),'',function(data){
            if (data.status==='ok'){
                //激活成功
                //成功应该干啥{----}
                layer.tips(data.msg,me,{tips:[1,'#090'],time:2000,success:function(){
                        $(me).closest('tr').detach();
                        // location.reload();
                    }
                });
            } else{
                //激活失败
                layer.tips(data.msg,me,{tips:[1,'#900']});
            }
        },'json');
        //阻止超链接的默认行为
        return false;
    });
    //确认到货
    $('.OrderAct2-upd').click(function(){
        var me = this;
        $.get($(this).attr('href'),'',function(data){
            if (data.status==='ok'){
                //激活成功
                //成功应该干啥{----}
                layer.tips(data.msg,me,{tips:[1,'#090'],time:2000,success:function(){
                        // $(me).closest('tr').detach();
                        location.reload();
                    }
                });
            } else{
                //激活失败
                layer.tips(data.msg,me,{tips:[1,'#900']});
            }
        },'json');
        //阻止超链接的默认行为
        return false;
    });
    //申请退款
    $('.OrderAct-upd').click(function(){
        var me = this;
        $.get($(this).attr('href'),'',function(data){
            if (data.status==='ok'){
                //激活成功
                //成功应该干啥{----}
                layer.tips(data.msg,me,{tips:[1,'#090'],time:2000,success:function(){
                        // $(me).closest('tr').detach();
                        location.reload();
                    }
                });
            } else{
                //激活失败
                layer.tips(data.msg,me,{tips:[1,'#900']});
            }
        },'json');
        //阻止超链接的默认行为
        return false;
    });
    //弹窗--查看评论 修改
    function UserOrder_Acts(id){
        layer.open({
            type: 2,
            title:'评论详情', //标题
            area: ['420px', '380px'], //宽高
            // shadeClose: false,  //拼接可选参数
            content:['{{route('hm.mem.UserOrder_Det')}}'+'/'+id]//可以用jQuery选择器
        })
    };
    //弹窗--发起评论
    function UserOrder_adds(id){
        layer.open({
            type: 2,
            title:'发起评论', //标题
            area: ['417px', '290px'], //宽高
            // shadeClose: false,  //拼接可选参数
            content:['{{route('hm.mem.UserOrder_Add')}}'+'/'+id]//可以用jQuery选择器
        })
    };
</script>
@endsection