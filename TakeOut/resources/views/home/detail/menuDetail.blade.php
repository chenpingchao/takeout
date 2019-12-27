@extends("home.public.public")
@section('header')
<head>
    <meta charset="utf-8" />
    <title>菜品详情</title>
    <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
    <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
    <meta name="author" content="DeathGhost"/>
    <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
    <link rel="Shortcut Icon" href="/image/title.ico">
    <script type="text/javascript" src="/home/js/public.js"></script>
    <script type="text/javascript" src="/home/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
    <script type="text/javascript" src="/home/js/jqpublic.js"></script>
    <script src="/home/KPS/js/starScore.js"></script>
    <style>
        body,li,p,ul {
            margin: 0;
            padding: 0;
            font: 12px/1 Tahoma, Helvetica, Arial, "\5b8b\4f53", sans-serif;
        }
        ul, li, ol { list-style: none; }

        /* 重置文本格式元素 */
        a {
            text-decoration: none;
            cursor: pointer;
            color:#333333;
            font-size:14px;
        }
        a:hover {
            text-decoration: none;
        }
        .clearfix::after{
            display:block;
            content:'';
            height:0;
            overflow:hidden;
            clear:both;
        }

        /*星星样式*/
        .content{
            width:600px;
            margin:0 auto;
            padding-top:20px;
        }
        .title{
            font-size:14px;
            background:#dfdfdf;
            padding:10px;
            margin-bottom:10px;
        }
        .block{
            width:100%;
            margin:0 0 20px 0;
            padding-top:10px;
            padding-left:50px;
            line-height:21px;
        }
        .block .star_score{
            float:left;
        }
        .star_list{
            height:21px;
            margin:50px;
            line-height:21px;
        }
        .block p,.block .attitude{
            padding-left:20px;
            line-height:21px;
            display:inline-block;
        }
        .block p span{
            color:#C00;
            font-size:16px;
            font-family:Georgia, "Times New Roman", Times, serif;
        }

        .star_score {
            background:url(/home/KPS/images/stark2.png);
            width:160px;
            height:21px;
            position:relative;
        }

        .star_score a{
            height:21px;
            display:block;
            text-indent:-999em;
            position:absolute;
            left:0;
        }

        .star_score a:hover{
            background:url(/home/KPS/images/stars2.png);
            left:0;
        }

        .star_score a.clibg{
            background:url(/home/KPS/images/stars2.png);
            left:0;
        }

        #starttwo .star_score {
            background:url(/home/KPS/images/starky.png);
        }

        #starttwo .star_score a:hover{
            background:url(/home/KPS/images/starsy.png);
            left:0;
        }

        #starttwo .star_score a.clibg{
            background:url(/home/KPS/images/starsy.png);
            left:0;
        }

        /*星星样式*/

        .show_number{
            padding-left:50px;
            padding-top:20px;
        }

        .show_number li{
            width:240px;
            border:1px solid #ccc;
            padding:10px;
            margin-right:5px;
            margin-bottom:20px;
        }

        .atar_Show{
            background:url(/home/KPS/images/stark2.png);
            width:160px; height:21px;
            position:relative;
            float:left;
        }

        .atar_Show p{
            background:url(/home/KPS/images/stars2.png);
            left:0;
            height:21px;
            width:134px;
        }

        .show_number li span{
            display:inline-block;
            line-height:21px;
        }

    </style>
    <style>
        ul.listpage{float: right;margin-bottom:10px; }
        .listpage a,.listpage span{ padding:5px 10px;  text-align:center; border:solid 1px #CCCCCC;}
        .listpage a:hover{background-color: #C91623;color:#fff;font-weight: bold;}
        .listpage a.current,.listpage span.current{background-color: #C91623;color:#fff;font-weight: bold;}
        .listpage span{ margin:0 10px;}

        ul.smallpic li{
            border: 1px solid #ccc;
            margin-left: 5px;
            cursor: pointer;
        }
        #showimg{
            border: 1px solid #ccd0d2;
        }
    </style>
    <script>
        $(function(){
            $('.title-list li').click(function(){
                var liindex = $('.title-list li').index(this);
                $(this).addClass('on').siblings().removeClass('on');
                $('.menutab-wrap div.menutab').eq(liindex).fadeIn(150).siblings('div.menutab').hide();
                var liWidth = $('.title-list li').width();
                $('.shopcontent .title-list p').stop(false,true).animate({'left' : liindex * liWidth + 'px'},300);
            });

            $('.menutab-wrap .menutab li').hover(function(){
                $(this).css("border-color","#ff6600");
                $(this).find('p > a').css('color','#ff6600');
            },function(){
                $(this).css("border-color","#fafafa");
                $(this).find('p > a').css('color','#666666');
            });
        });
    </script>
</head>
@endsection

@section('main')
<!--Start content-->
<section class="slp">
 <section class="food-hd">
  <div class="foodpic">
   <img src="/{{$menu_msg -> image_dir}}350_{{$menu_msg -> image}}" id="showimg">
    <ul class="smallpic">
     <li><img src="/{{$menu_msg -> image_dir}}100_{{$menu_msg -> image}}" onclick="show('/{{$menu_msg -> image_dir}}350_{{$menu_msg -> image}}')"></li>
        @forelse($menu_image as $v)
    <li><img src="/{{$v -> image_dir}}100_{{$v -> image}}" onclick="show('/{{$v -> image_dir}}350_{{$v -> image}}')" ></li>
            @empty
            @endforelse
    </ul>
  </div>
  <div class="foodtext">
   <div class="foodname_a"  style="margin:10px;">
    <h1>{{$menu_msg -> menu_name}}</h1>
   </div>
   <div class="price_a">
    <p class="price01">促销：￥<span>{{$menu_msg -> price }}</span></p>
    <p class="price02">价格：￥<s>{{ $menu_msg -> or_price }}</s></p>
   </div>
   <div class="Freight">
   </div>
   <ul class="Tran_infor" style="margin-top:20px;">
     <li>
      <p class="Numerical">{{$month_num}}</p>
      <p style="height: 1.2em">月销量</p>
     </li>
     <li class="line">
      <p class="Numerical">{{ $menu_msg -> eval_num }}</p>
         <p style="height: 1.2em;">累计评价</p>
     </li>
       <li>
           <div style="margin-left:10px;display: inline-block" class="atar_Show">
               <p tip="{{$fenshus}}"></p>
           </div>
       </li>

   </ul>
   <form action="" method="post" id="form1">
       {{csrf_field()}}
       <div class="BuyNo">
        <span>我要买：
            <input type="number" name="Number" required autofocus min="1" value="1"/>份
        </span>
        <div class="Buybutton">
            <input name="" type="submit" value="加入购物车" class="BuyB">
            <a href="{{route('home.shopDetail',['sid' => $menu_msg->sid ])}}"><span class="Backhome">进入店铺首页</span></a>
        </div>
       </div>
   </form>
  </div>

  <div class="viewhistory">
   <span class="VHtitle">看了又看</span>
   <ul class="Fsulist">
    <li>
     <a href="detailsp.html" target="_blank" title="酱爆茄子"><img src="/home/upload/03.jpg"></a>
     <p>酱爆茄子</p>
     <p>￥12.80</p>
    </li>
    <li>
     <a href="detailsp.html" target="_blank" title="酱爆茄子"><img src="/home/upload/02.jpg"></a>
     <p>酱爆茄子</p>
     <p>￥12.80</p>
    </li>
   </ul>
  </div>
 </section>
 <!--bottom content-->
 <section class="Bcontent">
  <article>
   <div class="shopcontent">
      <div class="title2 cf">
        <ul class="title-list fr cf">
          <li class="on">详细说明</li>
          <li>评价详情（{{$menu_msg -> eval_num}}）</li>
        </ul>
      </div>
      <div class="menutab-wrap">
        <!--case1-->
        <div class="menutab show">
          <div class="cont_padding">
          {!! $menu_msg -> detail !!}
          </div>
        </div>
        <!--case2-->
        <div class="menutab" id="menus-comments-list">
         <div class="cont_padding">
          <table class="Dcomment">
           <th width="80%">评价内容</th>
           <th width="20%" style="text-align:right">评价人</th>
           @forelse($menu_eval as $v)
           <tr>
           <td>
           <span style="color: #333;font-size: 18px;font-weight: bold">
               {{$v -> detail}}
           </span>
            <time >{{date('Y-m-d H:i:s')}}</time>
            <span style="color: #0f0f0f;font-size: 12px">商家回复:{{empty($v -> reply) ? '(未回复)' : $v->reply}}</span>
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
                {!! $show !!}
            </ul>
        </div>
       </div>
   </div>
  </article>
  <!--ad&other infor-->
  <aside>
   <!--广告位或推荐位-->
   <a href="#" title="广告位占位图片" target="_blank"><img src="/home/upload/2014912.jpg"></a>
  </aside>
 </section>
</section>
<!--End content-->
@endsection
@section('script')
    <script>
        //显示分数
        $(".show_number li p").each(function(index, element) {
            var num=$(this).attr("tip");
            var www=num*2*16;//
            $(this).css("width",www);
            $(this).parent(".atar_Show").siblings("span").text(num+"分");
        });


        $("#form1").submit(function(){
            me = $(this);
            $.post('{{route('home.joinCart',['uid' =>  $menu_msg->id ])}}',me.serialize(),function(data){
                if( data.stats === 'ok' ){
                    layer.confirm(data.msg ,{icon:3,btn:['前往购物车','留在本页'],shade:[0.6]},
                        function(){
                            location = "{{route('home.cart')}}"
                        }
                    );
                }else{
                    layer.msg( data.msg, { icon:5,shade:[0.6] } )
                }
            });
            return false;
        });

        //分页
        function search(page,url){
            var page=page?page:1;

            $.get(url,{"page":page},function(res){
                $('#menus-comments-list').html(res);
            })
        }

        //显示图
        function show(src) {
            $('#showimg').attr('src',src);
        }
    </script>
@endsection
