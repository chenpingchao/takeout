@extends('home.public.public')


@section('header')
<head>
<meta charset="utf-8" />
<title>确认订单-DeathGhost</title>
<meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
<meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
<meta name="author" content="DeathGhost"/>
<link href="/home/style/style.css" rel="stylesheet" type="text/css" />
    <link rel="Shortcut Icon" href="/image/title.ico">
<script type="text/javascript" src="/home/js/geo.js"></script>
<script type="text/javascript" src="/home/js/public.js"></script>
<script type="text/javascript" src="/home/js/jquery.js"></script>
<script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
<script type="text/javascript" src="/js/layer/layer.js"></script>
<script type="text/javascript" src="/home/js/jqpublic.js"></script>
    <style type=text/css>
        input.error { border: 1px solid #EA5200;background: #ffdbb3;}

        div.error {
            background:url("/image/error.png") no-repeat 5px 2px;
            padding-left: 22px;
            padding-bottom: 2px;
            font-weight: bold;
            color: #EA5200;
            vertical-align: middle
        }
        div.ok {
            background:url("/image/ok.png") no-repeat 5px 2px;
            color: #6aea4c;
        }
    </style>
<!--
Author: DeathGhost
Author URI: http://www.deathghost.cn
-->
</head>
@endsection

@section('main')
{{session('mid')}}
<section class="Psection MT20" id="Cflow">
<!--如果用户未添加收货地址，则显示如下-->
 <div class="confirm_addr_f">
  <span class="flow_title">收货地址：</span>
  <!--已保存的地址列表-->

   <ul class="address">
     @forelse($member_msg as $k =>$v)
        <li id="style{{$k+1}}">
          <input type="radio" value="" {{$v->active ==1?'checked':'' }} id="{{ $v->id }}" name="rdColor" onclick="changeColor('{{$k+1}}',this)"/>
          <label for="1"> {{ $v->location }}&emsp;{{$v -> site}}（{{$v->name}}）
            <span class="fontcolor">{{$v -> mobile}}</span>
          </label>
        </li>
      @empty
     <li id="style1">
      <label for="1"> 你还没有收货地址，快去添加吧</label>
     @endforelse
    <li>
       <a href ="javascript:show('light')" >
          <img src="/home/images/newaddress.png" title="添加地址"/>
       </a>
    </li>
   </ul>

{{--   添加收货地址--}}
    <form action="{{route('hm.mem.UserAddress_add')}}" method="post" id="add_site">
        {{csrf_field()}}
        <div id="light" class="O-L-content">
            <ul>
            <li>
                <span><label for="">选择所在地：</label></span>
                <p><em>*</em>
                    <select name="province" id="s1"></select>
                    <select name="city" id="s2"></select>
                    <select name="town" id="s3"></select>
                </p>
            </li>
            <li>
                <span><label for="">邮政编码：</label></span>
                <p><em>*</em>
                    <input name="Postcode" type="text"  class="Y_N"  pattern="[0-9]{6}" required>
                </p>
                <div class="image Postcode"></div>
            </li>
            <li>
                <span><label for="">街道地址：</label></span>
                <p>
                    <em>*</em><textarea name="site" cols="80" rows="5"></textarea>
                </p>
                <div class="image site"></div>
            </li>
            <li>
                <span><label for="">收件人姓名：</label></span>
                <p><em>*</em><input name="name" type="text"></p>
                <div class="image name"></div>
            </li>
            <li>
                <span><label for="">手机号码：</label></span>
                <p><em>*</em><input name="mobile" type="text" pattern="[0-9]{11}" required></p>
                <div class="image mobile"></div>
            </li>
            <div class="button-a">
                <input type="button" value="确 定" class="C-button submit" />
                <a href = "javascript:none('light')" >
                    <span>
                        <input name="" type="button" value="取 消"  class="Cancel-b"/>
                    </span>
                </a>
            </div>
        <div id="fade" class="overlay"></div>
    </ul>
   </div>
   </form>
   <!--End add new address-->

<!--配送方式及支付，则显示如下-->
<!--check order or add other information-->
 <div class="pay_delivery">
  <span class="flow_title">配送方式：</span>
  <table>
   <th width="30%">配送方式</th>
   <th width="30%">运费</th>
   <th width="40%">说明</th>
   <tr>
    <td>送货上门</td>
    <td>￥0.00</td>
    <td>配送说明信息...</td>
   </tr>
  </table>
  <span class="flow_title">在线支付方式：</span>
   <form action="#">
    <ul>
    <li>
     <input type="radio" name="pay" id="alipay" value="alipay" />
     <label for="alipay"><i class="alipay"></i></label>
    </li>
    </ul>
   </form>
  </div>

  <div class="inforlist">
   <span class="flow_title">商品清单</span>
   <table>
    <th>名称</th>
    <th>数量</th>
    <th>价格</th>
    <th>小计</th>
    @foreach($menu as $v)
    <tr class="tr">
      <td>{{ $v -> menu_name }}</td>
      <td>{{ $v -> buynum }}</td>
      <td>￥<i>{{ $v -> price }}</i></td>
      <td>￥<i>118</i></td>
     </tr>
    @endforeach
   </table>

   <form action="{{route('home.orderCreate')}}" method='post' id="form1">
    {{csrf_field()}}
    {{--地址隐藏域（地址ID）--}}
    <input type="hidden" name="siteId" id="siteId" value="">

      <div class="Order_M">
       <p><em>订单附言:</em><input name="mssage" value=""  type="text"></p>
       <p><em>优惠券:</em>
       <select name="redpacket" id="redpacket">
           <option value="0">不用红包</option>
           @forelse($redpacket as $v )
               <option value="{{$v -> id }}" num="{{$v->value}}" {{$v->type ==1? '':($orders_price >= $v->value*3 ? '':'disabled') }}>￥{{$v->value}}元{{$v->type==1?'无门槛':'满'.$v->value*3 }}优惠券</option>
           @empty
               <option value="0">没有可用红包</option>
           @endforelse
       </select>
       </p>
      </div>
      <div class="Sum_infor">
      <p class="p1">配送费用：￥<i id="pei">0.00</i>+商品费用：￥<i id="fei">{{$orders_price}}</i>-优惠券：￥<i id="you">0.00</i></p>
      <p class="p2">合计：￥<span id="allPrice">0.00</span></p>
      <input type="submit" value="提交订单"  class="p3button">
      </div>
   </form>
   </div>
 </div>
</section>
<script>
//Test code,You can delete this script /2014-9-21DeathGhost/
$(document).ready(function(){
 var submitorder =$.noConflict();
 submitorder(".p3button").click(function(){
	 submitorder("#Cflow").hide();
	 submitorder("#Aflow").show();
	 });
});
</script>
<!--End content-->
@endsection
@section('script')
<script>
   function changeColor(arg,obj){
     var rdCount = document.getElementsByName("rdColor").length;
     for(i=1;i<=rdCount;i++){
     document.getElementById("style"+i).style.fontWeight = "normal";
     document.getElementById("style"+i).style.backgroundColor = "";
     document.getElementById("style"+i).style.boxShadow = "none";
     document.getElementById("style"+i).style.border = "none";
     }
     document.getElementById("style"+arg).style.backgroundColor = "#fff5cc";
     document.getElementById("style"+arg).style.fontWeight = "bold";
     document.getElementById("style"+arg).style.boxShadow = "3px 2px 10px #dedede";
     document.getElementById("style"+arg).style.border = "1px #ffe580 solid";
   //地址
   //  console.log(obj.id);
    $('#siteId').val(obj.id);
   }

   //页面进入选择地址
   $('#siteId').val( $('input[name="rdColor"]:checked').attr('id') );

    //获取红包的价格
   $red_price = 0;
   $('#redpacket').change(function(){
       $all_price = parseInt( $('#fei').text() );
       $red_price =  parseInt( $("#redpacket option:selected").attr('num') );
       $red_price = isNaN($red_price) ? 0 : $red_price;
       $('#you').text($red_price);
       $all_price = $all_price - $red_price>=0 ? $all_price - $red_price : 0;
       $('#allPrice').text( $all_price);
   })

   //计算总价

   $all_price = parseInt( $('#fei').text() );
   $('#allPrice').text($all_price);

   //添加地址显示
    function show(id){
       $('#'+id).show();
    }

    //隐藏添加地址
    function none(id){
        $('#'+id).css('display','none');
    }

   //省市县三级联动
   setup();
   preselect('河南省');
   document.getElementById('s2').value='郑州市';
   document.getElementById('s2').onchange();
   document.getElementById('s3').value='中原区';


   //添加地址
    $('.submit').click(function(){
        me = $('#add_site')
       $.ajax({
           url:me.attr('action'),
           type:'post',
           data:me.serialize() ,
           success:function(data){
                   if(data.status === 'ok'){
                       layer.msg(data.msg,{icon:6,shade:[0.6],time:2500},function(){
                           location.reload()
                       });
                       $('#light').css('display','none');
                   }else{
                       layer.msg(data.msg,{icon:6,shade:[0.6],time:2500})
                   }
               },
           error:function (xhr) {
                   var errors = JSON.parse(xhr.responseText).errors;
                   //清空前台表单验证
                   $('div.image').html('');

                   //将错误信息写入表单
                   for(var i in errors){
                       $('.'+i).text(errors[i][0]).addClass('error')

                   }
               }

       })
    });
</script>

@endsection

