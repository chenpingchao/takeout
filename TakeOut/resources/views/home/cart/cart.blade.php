@extends('home.public.public')

@section('header')
<head>
<meta charset="utf-8" />
<title>DeathGhost-我的购物车</title>
<meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
<meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
<meta name="author" content="DeathGhost"/>
<link href="/home/style/style.css" rel="stylesheet" type="text/css" />
    <link rel="Shortcut Icon" href="/image/title.ico">
    <script type="text/javascript" src="/home/js/public.js"></script>
    <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
    <script type="text/javascript" src="/home/js/jqpublic.js"></script>

    <style>
        .subtotal{
            text-align: center;
            font-size: 25px;
            color:#ff5500;
        }
    </style>
{{--<script type="text/javascript" src="/home/js/cart.js"></script>--}}
<!--
Author: DeathGhost
Author URI: http://www.deathghost.cn
-->
</head>
@endsection


@section('main')
<!--Start content-->
<form action="#">
 <div class="gwc" style=" margin:auto;">
  <table cellpadding="0" cellspacing="0" class="gwc_tb1">
    <tr>
      <td colspan="2">&nbsp;&nbsp;</td>
      <td class="tb1_td3">商品</td>
      <td class="tb1_td4">原价</td>
      <td class="tb1_td5">数量</td>  
      <td class="tb1_td6">单价</td>
      <td class="tb1_td6">小计</td>
      <td class="tb1_td7">操作</td>
    </tr>
  </table>
    @if( !empty($cart_shop) )
        <form action="" id="form" method="post">
            {{csrf_field()}}
        @forelse($cart_shop as $v)
            <table cellpadding="0" cellspacing="0" class="gwc_tb2" id="table1">
                <tr>
                  <td class="tb2_td1"><input href="{{route('home.menuCartActive',['uid'=>$v -> id ,'active'=>$v->active ])}}" type="checkbox" name="chk[]" value="{{$v -> id}}" {{ $v->active ==1 ?'checked' : '' }}  id="newslist-1" /></td>
                  <td class="tb2_td2"><a href="{{route('home.menuDetail',['uid' => $v -> id])}}" target="_blank"><img src="/home/upload/01.jpg"/></a></td>
                  <td class="tb2_td3"><a href="{{route('home.menuDetail',['uid' => $v -> id])}}" target="_blank">{{$v -> menu_name}}</a></td>
                  <td class="tb1_td4"><s>￥{{$v -> or_price }}</s></td>
                  <td class="tb1_td5">
                    <input  name="min"  href="{{route('home.menuCartMin',['uid'=> $v -> id ])}}" style="width:30px; height:30px;border:1px solid #ccc;" type="button" value="-" />
                    <input name="price" href="{{route('home.menuCartAssign',['uid'=> $v -> id ])}}" id="text_box1" type="text" value="{{$v -> buynum}}" style=" width:40px;height:28px; text-align:center; border:1px solid #ccc;" />
                    <input  name="add"  href="{{route('home.menuCartAdd',['uid'=> $v -> id ])}}" style="width:30px; height:30px;border:1px solid #ccc;" type="button" value="+" />
                  </td>
                  <td class="tb1_td6" >
                    <label id="total1" class="tot" style="color:#ff5500;font-size:25px; font-weight:bold;">{{$v -> price }}</label>
                  </td>
                  <td class="subtotal tb1_td6"></td>
                  <td class="tb1_td7"><a href="{{route('home.deleteCart',[ 'uid'=> $v->id ])}}" class="deleteCart" id="delcart1">删除</a></td>
                </tr>
            </table>
            @empty
                <table cellpadding="0" cellspacing="0" class="gwc_tb2" id="table1">
                    <tr>
                        <td style="font-size:30px;text-align:center;"><a href="{{route('/')}}">购物车中还没有商品呦！快去添加吧！</a></td>
                    </tr>
                </table>
         @endforelse
        </form>
    @else
     <table cellpadding="0" cellspacing="0" class="gwc_tb2" id="table1">
         <tr>
            <td style="font-size:30px;text-align:center;"><a href="{{route('/')}}">购物车中还没有商品呦！快去添加吧！</a></td>
         </tr>
     </table>
    @endif

  {{--<table cellpadding="0" cellspacing="0" class="gwc_tb2" id="table2">
    <tr>
      <td class="tb2_td1"><input type="checkbox" value="1" name="chk[]" id="newslist-2" /></td>
      <td class="tb2_td2"><a href="detailsp.html" target="_blank"><img src="/home/upload/02.jpg"/></a></td>
      <td class="tb2_td3"><a href="detailsp.html" target="_blank">酸辣土豆丝</a></td>
      <td class="tb1_td4"><s>￥59.00</s></td>
      <td class="tb1_td5">
        <input id="min2" name=""  style=" width:30px; height:30px;border:1px solid #ccc;" type="button" value="-" />
        <input id="text_box2" name="" class="price" type="text" value="1"  style=" width:40px;height:28px; text-align:center; border:1px solid #ccc;" />
        <input id="add2" name="" style=" width:30px; height:30px;border:1px solid #ccc;" type="button" value="+" />
      </td>
      <td class="tb1_td6">
        <label id="total2" class="tot" style="color:#ff5500;font-size:14px; font-weight:bold;"></label>
      </td>
      <td class="tb1_td7"><a href="#" id="delcart2">删除</a></td>
    </tr>
  </table>--}}


  <table cellpadding="0" cellspacing="0" class="gwc_tb3">
    <tr>
      <td class="tb1_td1">
        <input id="checkAll"  class="allselect" type="checkbox" />
      </td>
      <td class="tb1_td1">全选</td>
      <td class="tb3_td1">
        <input id="invert" type="checkbox" />反选
        <input id="cancel" type="checkbox" />取消
      </td>
      <td class="tb3_td2 GoBack_Buy Font14">
        <a href="{{route('/')}}" target="_blank">继续购物</a>
      </td>
      <td class="tb3_td2">已选商品
        <label id="shuliang" style="color:#ff5500;font-size:14px; font-weight:bold;">0</label>件
      </td>
      <td class="tb3_td3">合计(不含运费):<span>￥</span><span style=" color:#ff5500;">
        <label id="zong1" style="color:#ff5500;font-size:14px; font-weight:bold;">0.00</label>
        </span>
      </td>
      <td class="tb3_td4">
        <span id="jz1">结算</span>
        <a href="{{route('home.orderPage')}}" style=" display:none;"  class="jz2" id="jz2">结算</a>
      </td>
    </tr>
  </table>
</div>
</form>
<!--End content-->
@endsection
@section('script')
<script>
    //全选全不选
    $('#checkAll').click(function(){
        //发送请求更改购物车数据
        allActive = '';
        me = $(this);
        //判断状态
        if( Boolean($(this).attr('checked') ) ){
            allActive = 1;
        }else{
            allActive = 2;
        }
        $.get('{{route("home.menuCartAll")}}'+'/'+allActive,'',function(data){
            if( data.stats === 'ok'){
                input = $("input[ name='chk[]' ]")
                //成功更改页面的选项
                input.attr( 'checked', Boolean( me.attr('checked') ) ).attr('href', input.attr('href').replace( /(1|2){1}$/ , allActive ) );
                active();
            }else{
                //不成功更改自己
                me.attr('checked', ! Boolean( me.attr('checked') ))
            }
        });

    });

    //取消
    $('#cancel').click(function(){
        //取消
        $.get('{{route("home.menuCartAll",['active'=> 2 ])}}','',function(data){
            if( data.stats === 'ok') {
                input = $("input[ name='chk[]' ]")
               input.attr('checked',false).attr('href', input.attr('href').replace( /(1|2){1}$/ ,2 ) );
                active();
            }
        });

    });

    //反选
    $('#invert').click(function(){
        return false;
        //异步请求反选
        $.post('{{route('home.menuCartAdverse')}}',$('form').serialize(),function(data){
             if(data.stats === 'ok'){
                 $("input[ name='chk[]' ]").not( $("input[ name='chk[]' ]:checked ").attr('checked',false) ).attr('checked',true)
             }else{
                 layer.msg('反选失败');
             }
        });
        active();
    });

    //开局全选判定
    $('.allselect').attr('checked', ! $("input[ name='chk[]' ]:not(:checked)").length );

    //更改商品状态
    $("input[ name='chk[]' ]").click(function(){
        //单选影响全选
        $('#checkAll').attr('checked', ! $("input[ name='chk[]' ]:not(:checked)").length );
        //更改商品状态
        me = $(this);
        $.get(me.attr('href'), '' , function(data){
            if(data.stats === 'ok'){
                me.attr('href',data.url)
            }else{
                me.attr('checked', ! Boolean( me.attr('checked') ) )
            }
        });
        active();
    });

    //结算按钮的禁用
    function active(){

        if( $( 'input[ name="chk[]" ]:checked').length ){
            //启用
            $("#jz1").css('display','none');
            $("#jz2").show();

        }else{
            //禁用
            $("#jz1").show();
            $("#jz2").css('display','none');
        }
        allPrice()
    }
    active()
    //结算购物车总价
    function allPrice(){
        var subtotal = 0 ; //小计
        var all_price = 0; // 总价
        var all_num = 0 ; //总数
        var price = 0; //单价
        var num = 0; //数量
        var table = $('.gwc_tb2');
        // console.log(table);
        for( var i=0 ; i<table.length ; i++ ){
            num = table.eq(i).find("input").eq(2).val();
            price = table.eq(i).find('label').text();
            subtotal = num*price;  //小计
            //将小计价格写入文档中
            table.eq(i).find('.subtotal').text(subtotal);
            //判断商品是否被选择(被选中将加入总价)
            if(table.eq(i).find('[ name="chk[]" ]').attr('checked')){
                all_price += subtotal; //总计
                all_num += parseInt(num) ;
            }
          /* console.log(num)
        console.log(price)
        console.log(subtotal)
        console.log(all_price)*/
        }
        //将总计价格和总数写入页面
        $("#zong1").text(all_price);
        $("#shuliang").text(all_num);

    }

    //加的处理
    $('input[name="add"]').click(function(){
        me = $(this)
        if(me.prev().val() > 0){
            $.get(me.attr('href'),'',function(data){
                if(data.stats === 'ok'){
                    me.prev().val( parseInt( me.prev().val() )+1 )
                    allPrice();
                }
            });
        }

    });

    //减的处理
    $('input[name="min"]').click(function(){
        me = $(this);
        if(me.next().val() > 1) {
            $.get(me.attr('href'), '', function (data) {
                if (data.stats === 'ok') {
                    me.next().val(me.next().val() - 1)
                    allPrice()
                }
            })
        }
    });

    //直接修改商品的个数
    $('input[name="price"]').blur(function(){
        me = $(this);
        if(isNaN( parseInt(me.val()))){
            num = 1;
            me.val(1);
        }else{
            num = parseInt(me.val());
            me.val(num);
        }
        $.get(me.attr('href')+'/'+num ,'' , function(data){
            if(data.stats === 'ok'){
                allPrice();
            }else{
                me.val(1);
            }
        })
        // console.log(me.attr('href')+'/'+num);
    });

// layer.msg('aa')
    //删除购物车的商品
    $('.deleteCart').click(function(){
        me = $(this);
        layer.confirm('确认在购物车删除该商品?', {icon:3,shade:[0.6]} ,
            function(){
                $.get(me.attr('href'), '' , function(data){
                    if(data.stats === 'ok' ){
                        me.parent('table').remove();
                        layer.msg('删除成功');
                    }else{
                        layer.msg('删除失败');
                    }
                });
            });
        return false
    });

    //结算的限制
    $("#jz2").click(function(){
        if('{{session('mid')}}'){
            location = $(this).attr('href')
        }else{
            layer.open({
                type:2,
                title:'用户登录',
                area: ['700px', '400px'],
                content:['{{route('home.loginT')}}']
            });

        }
        return false;
    })

</script>
@endsection
