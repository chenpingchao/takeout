@extends("home/public/public")
@section('header')
<head>
  <meta charset="utf-8" />
  <title>店铺详情</title>
  <meta name="author" content="DeathGhost"/>
    <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
    <link href="/css/public.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/home/js/public.js"></script>
    <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
{{--    <script type="text/javascript" src="/home/js/jquery.js"></script>--}}
    <script type="text/javascript" src="/home/js/jqpublic.js"></script>
    <script type="text/javascript" src="/home/js/cart.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
    <script type="text/javascript" src="/home/js/jquery.easyui.min.js"></script>
  <script>
  var mt = 0;
  window.onload = function () {
   var Topcart = document.getElementById("Topcart");
   var mt = Topcart.offsetTop;
   window.onscroll = function () {
    var t = document.documentElement.scrollTop || document.body.scrollTop;
    if (t > mt) {
     Topcart.style.position = "fixed";
     Topcart.style.margin = "";
     Topcart.style.top = "200px";
     Topcart.style.right = "191px";
     Topcart.style.boxShadow ="0px 0px 20px 5px #cccccc";
     Topcart.style.top="0";
     Topcart.style.border="1px #636363 solid";
    }
    else {
     Topcart.style.position = "static";
     Topcart.style.boxShadow ="none";
     Topcart.style.border="";
    }
   }
  }
 </script>
    <style>
        .display{
            display: none;
        }
        .regRight div.current{
            display: block;
        }
        .title-list li.active{
            color: #ff6600;
            font-weight: bold;
            width: 146px;
            line-height: 40px;
            text-align: center;
            float: left;
            display: inline;
            cursor: pointer;
            /*font-weight: bold;*/
            /*color: #333333;*/
            font-size: 15px;
        }
    </style>
</head>
@endsection

@section('main')
<!--Start content-->
<section class="Shop-index">
 <article>
  <div class="shopinfor">
   <div class="title">
    <img src="{{$shop_msg -> logo}}" class="shop-ico">
    <span>{{ $shop_msg -> shop_name }}</span>
    <span>
     <img src="/home/images/star-on.png">
     <img src="/home/images/star-on.png">
     <img src="/home/images/star-on.png">
     <img src="/home/images/star-on.png">
     <img src="/home/images/star-off.png">
    </span>
    <span>{{ $shop_msg->grade }}</span>
   </div>
   <div class="imginfor">
    <div class="shopimg">
     <img src="/home/upload/cc.jpg" id="showimg">
      <ul class="smallpic">
       <li><img src="/home/upload/cc.jpg" onmouseover="show(this)" onmouseout="hide()"></li>
      </ul>
    </div>
    <div class="shoptext">
     <p><span>地址：</span>{{ $shop_msg->site }}</p>
     <p><span>电话：</span>{{ $shop_msg -> shop_mobile }}</p>
     <p><span>特色菜品：</span>毛肚、牛丸、滑虾、羊肉、香辣虾...</p>
     <p><span>优惠活动：</span>暂无信息</p>
     <p><span>停车位：</span>4个停车位（免费）</p>
     <p><span>营业时间：</span>09:00~22:00</p>
     <p><span>价格：</span>{{ $shop_msg-> avg_price }}元</p>
     <div class="Button">
      <a href="#ydwm"><span class="DCbutton">查看菜谱点菜</span></a>
     </div>
     <div class="otherinfor">

     <a href="{{route('home.shop_Collection',['sid'=>$sid])}}" id="collection-add-del" class="icoa">
         <img src="/home/images/collect.png">
         收藏店铺（{{$Collection}}）
     </a>

     <div class="bshare-custom"><a title="分享" class="bshare-more bshare-more-icon more-style-addthis">分享</a></div>
	 <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=1&amp;lang=zh"></script><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
     </div>
   </div>
  </div>
  <div class="shopcontent">
  <div class="regRight">

  <div class="title2 cf">
    <ul class="title-list fr cf ">

      <li class="active">菜谱</li>

      <li onclick="comment(1,'{{route('home.shopDetail',['sid'=>$shop_msg->id])}}')">累计评论（{{$menu_comment_num}}）</li>

      <li>商家详情</li>

      <li onclick="guestbook(1,'{{route('home.shopDetail',['sid'=>$shop_msg->id])}}')">店铺留言</li>
    </ul>
  </div>
  <div class="menutab-wrap">
   <a name="ydwm"></a>
    <!--case0-->{{--菜谱--}}
    <div class="current menutab show" style="display:block;" id="menutabs0">
            <ul class="products" >
                @forelse($shop_menu as $v)
                    <li>
                        <a href="{{route('home.menuDetail',['uid'=> $v ->id ] ) }}" target="_blank" title="{{ $v -> menu_name }}">
                            <img src="/{{$v->image_dir.$v -> image}}" class="foodsimgsize">
                        </a>
                        <a href="#" class="item">
                            <div>
                                <p>{{ $v -> menu_name }}</p>
                                <p class="AButton">拖至购物车:￥{{ $v -> price }}</p>
                            </div>
                        </a>
                    </li>
                @empty
                    <li>
                        <p style="text-align:center;font-size:30px;font-weight: bold">该商家没有菜哦！</p>
                    </li>
                @endforelse
            </ul>
            <ul class="am-pagination am-pagination-right listpage" style="float:right;margin-right: 10px">

            </ul>
    </div>
    <!--case1-->{{--评论--}}
    <div id="menutabs1" style="display:none" class="current menutab">
            <h2>还没有评论</h2>
    </div>
    <!--case2-->{{--详细信息--}}
    <div id="menutabs2" style="display: none" class="current menutab">
     <div class="shopdetails">
     <div class="shopmaparea">
      <img src="/home/upload/testimg.jpg"><!--此处占位图调用动态地图后将其删除即可-->
     </div>
     <div class="shopdetailsT">
      <p><span>店铺：{{$shop_msg -> shop_name}}</span></p>
      <p><span>地址：</span>{{$shop_msg -> site}}</p>
      <p><span>电话：</span>{{$shop_msg -> shop_mobile}}</p>
      <p><span>乘车路线：</span>300路、115路、14路、800路到西辛庄站下车往东100米</p>
      <p><span>店铺介绍：</span>{{$shop_msg ->detail}}</p>
     </div>
    </div>
    </div>
    <!--case3-->{{--店铺留言--}}
    <div id="menutabs3" style="display: none" class="current menutab" >
        <div id="guestbook">
        </div>
     <form class="A-Message" id="form_adds" action="">
         {{csrf_field()}}
         <p><i>问题补充：</i>
             <textarea name="guestbook" id="guestbook" cols="" rows=""  required placeholder="请详细说明您的问题..." style="width: 512px;height:111px" onkeyup="checkLength(this);"></textarea>
         </p>
         <p>
             <input type="button" id="guestbook_add" class="Abutt" value="提交" />
             <span class="wordage" style="float:right;">剩余字数：<span id="sy" style="color:Red;">200</span>字</span>
         </p>
     </form>
    </div>

  </div>
  </div>
</div>
</div>
 </article>
 <aside>
  <div class="cart" id="Topcart">
	<span class="Ctitle Block FontW Font14"><a href="{{route("home.cart")}}" target="_blank">我的购物车</a></span>
	<table id="cartcontent" fitColumns="true">
	<thead>
	<tr>
	<th width="33%" align="center" field="name">商品</th>
	<th width="33%" align="center" field="quantity">数量</th>
	<th width="33%" align="center" field="price">价格</th>
	</tr>
	</thead>
	</table>
	<p class="Ptc"><span class="Cbutton"><a href="{{route('home.cart')}}" target="进入购物车">进入购物车</a></span><span class="total">共计金额: ￥0</span></p>
  </div>
  
  <div class="Nearshop">
   <span class="Nstitle">附近其他店铺</span>
   <ul>
    <li>
     <img src="/home/upload/cc.jpg">
     <p>
     <span class="shopname" title="动态调用完整标题"><a href="detailsp.html" target="_blank" title="肯德基">肯德基</a></span>
     <span class="Discolor">距离：1.2KM</span>
     <span title="完整地址title">地址：西安市雁塔区2000号...</span>
     </p>
    </li>
   </ul>
  </div>
  
  <div class="History">
   <span class="Htitle">浏览历史</span>
   <ul>
    <li>
    <a href="detailsp.html" target="_blank" title="清真川菜馆"><img src="/home/upload/cc.jpg"></a>
    <p>
     <span class="shopname" title="动态调用完整标题"><a href="detailsp.html" target="_blank" title="正宗陕北小吃城">正宗陕北小吃城</a></span>
     <span>西安市莲湖区土门十西安市莲湖区土门十字西安市莲湖区土门十字.</span>
    </p>
    </li>
    <span>[ <a href="#">清空历史记录</a> ]</span>
   </ul>
  </div>
 </aside>
 
</section>
<!--End content-->
@endsection

@section('script')
  <script>
        //选项卡
        $('.title-list li').click(function(){
            //划过哪个选项，哪个选项高亮显示 ，而其它的选项取消高亮显示
            $(this).addClass('active').siblings('li').removeClass('active');
            //取出划过选项卡的下标
            var i=$(this).index();
            // console.log($('#menutabs'+i));
            //通过下标找到对应的商品
            $('#menutabs'+i).css('display','block').siblings('div').css('display','none');
        });
  </script>

 <script>
     /*字数限制*/
     function checkLength(which) {
         var maxChars = 200; //
         if(which.value.length > maxChars){
             layer.open({
                 icon:2,
                 title:'提示框',
                 content:'您输入的字数超过限制!',
             });
             // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
             which.value = which.value.substring(0,maxChars);
             return false;
         }else{
             var curr = maxChars - which.value.length; //250 减去 当前输入的
             document.getElementById("sy").innerHTML = curr.toString();
             return true;
         }
     };

   $('#guestbook_add').click(function(){
       if ('{{session('mid')}}'){
           $.post('{{route('home.guestbook',['sid'=>$shop_msg->id])}}', $('#form_adds').serialize(), function (data) {
               //判断是否登录成功
               if (data.status === 'ok') {
                   layer.msg(data.msg, {time: 1000},function () {
                       location = '{{route("home.shopDetail",['sid'=>$sid])}}';
                   });
               } else {
                   layer.msg(data.msg,{time: 1000,},function () {
                       location = '{{route("home.shopDetail",['sid'=>$sid])}}';
                   });
               }
           }, 'json')
       } else{
           layer.open({
               type:2,
               title:'用户登录',
               area: ['700px', '400px'],
               content:['{{route('home.loginT')}}']
           });
       }
       return false;
   });

   //评论分页
   function comment(page,url){
       var page=page?page:1;
       $.get(url,{"page":page,'type':'comment'},function(res){
           $('#menutabs1').html(res);
       })
   }
   //留言分页
   function guestbook(page,url){
       var page=page?page:1;
       $.get(url,{"page":page,'type':'guestbook'},function(res){
           $('#guestbook').html(res);
       })
   }

   //菜品分页
   function menu(page,url){
       var page=page?page:1;
       $.get(url,{"page":page,'type':'menu'},function(res){
           $('#menutabs0').html(res);
       })
   }


   //删除--添加--店铺收藏
   $('#collection-add-del').click(function () {
       var me=this;
       $.get($(me).attr('href'),function(data){
           if(data.stats === 'add'){
               layer.msg(data.msg,{time:1000},function () {
                   {{--location = '{{route("home.shopDetail",['sid'=>$sid])}}';--}}
                   layer.closeAll();
               });
           }else{
               layer.msg(data.msg,{time:1000},function () {
                   {{--location = '{{route("home.shopDetail",['sid'=>$sid])}}';--}}
                   layer.closeAll();
               });
           }
       });
       //阻止超链接默认行为
       return false;
   });
 </script>
 @endsection