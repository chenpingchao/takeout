@extends("home/public/public")

@section('main')
 <!--Start content-->
 <section class="Cfn">
  <aside class="C-left">
   <div class="S-time">服务时间：周一~周六<time>09:00</time>-<time>23:00</time></div>
   <div class="C-time">
    @if($Leftindexad)
     <a href="" title="">
      <img width="293" src="{{$Leftindexad->img_dir}}{{$Leftindexad->image}}" alt="广告">
     </a>
    @endif
   </div>
  </aside>
  <div class="F-middle">
   @if($indexad)
   <ul class="rslides f426x240">
    <li><a href="javascript:"><img width="600" src="{{$indexad->img_dir}}{{$indexad->image}}"/></a></li>
    <li><a href="javascript:"><img width="600" src="{{$indexad->img_dir}}{{$indexad->image}}"/></a></li>
    <li><a href="javascript:"><img width="600" src="{{$indexad->img_dir}}{{$indexad->image}}"/></a></li>
   </ul>
   @endif
  </div>
  <aside class="N-right">
   <div class="N-title">网站新闻<i>COMPANY NEWS</i></div>

   <select style="display:none;" name="town" id="s3"></select>
   {{--地区列表--}}
   <script>
    setup();
    preselect('河南省');
    document.getElementById('s2').value='郑州市';
    document.getElementById('s2').onchange();
    // console.log($('#s3').find('option:gt(0)'))  地区列表
    site();
    $('#s2').change(function(){site()});
    function site(){
     $('.site').remove();
     var qu = $('#s3').find('option:gt(0)');
     var str = '';
     for(var i=0 ; i<qu.length;i++){
      str += '<dd class="site"><a href="javascript:">'+qu.eq(i).text()+'</a></dd>';
     }
     $('#select1').append(str);

    }
   </script>

   <ul class="Orderlist">
    @forelse($orders as $k=>$v)
    <li>
     <p>订单编号：{{$v->orders_num}}</p>
     <p>收件人：{{$v->username}}</p>
     <p>订单状态：<i class="State01">
       @switch($v->active)
        @case(1)
        未付款
        @break
        @case(2)
        已付款
        @break
        @case(3)
        已发货
        @break
        @case(4)
        已签收
        @break
        @case(5)
        已评论
        @break
        @default
       @endswitch
      </i></p>
    </li>
    @empty
     <li class="Orderlist">
      <p>∑(っ°Д°;)っ卧槽，不见了</p>
     </li>
    @endforelse
   </ul>
   <script>
    var UpRoll = document.getElementById('UpRoll');
    var lis = UpRoll.getElementsByTagName('li');
    var ml = 0;
    var timer1 = setInterval(function(){
     var liHeight = lis[0].offsetHeight;
     var timer2 = setInterval(function(){
      UpRoll.scrollTop = (++ml);
      if(ml ==1){
       clearInterval(timer2);
       UpRoll.scrollTop = 0;
       ml = 0;
       lis[0].parentNode.appendChild(lis[0]);
      }
     },10);
    },5000);
   </script>
  </aside>
 </section>
 <section class="Sfainfor">
  <article class="Sflist">
   <div id="Indexouter">
    <ul id="Indextab">
     <li class="current">点菜</li>
     <li>餐馆</li>

     <p class="class_B">
      {{--菜品分类--}}
      @forelse($scName as $sc)
      <a href="{{route('H_list_shop',['shop_name'=>$sc->sc_name])}}">{{$sc->sc_name}}</a>
      @empty
      <h2>暂无店铺菜品信息</h2>
      @endforelse
      <span><a><<&nbsp;&nbsp;&nbsp;&nbsp;店铺分类</a></span>
     </p>

    </ul>
    <div id="Indexcontent">
     <ul style="display:block;">
      <li>
       {{--按销量推荐菜品--}}
       <div class="SCcontent">
         @forelse($menu as $u)
           <a href="{{route('home.menuDetail',['uid' => $u->id ])}}" target="_blank" title="{{ $u -> menu_name }}">
             <figure>
               <img src="{{$u->image_dir}}{{$u->image}}">
               <figcaption>
                <span class="title">{{ $u -> menu_name }}</span>
                <span class="price"><i>￥</i>{{ $u -> price }}</span>
               </figcaption>
             </figure>
           </a>
         @empty
          <h2>暂无好吃的菜品信息</h2>
        @endforelse
       </div>
      </li>
     </ul>
     <ul>
      <li>
       <div class="DCcontent">
        {{--按评分推荐店铺--}}
        <div class="bestshop">
         @forelse($shop as $s)
          <a href="{{route('home.shopDetail',['sid' => $s->id ])}}" target="_blank" title="{{$s -> name}}">
           <figure>
            <img src="{{$s -> logo}}">
           </figure>
          </a>
         @empty
          <h2>暂无达到要求的店铺</h2>
         @endforelse
        </div>
       </div>
      </li>
     </ul>
    </div>
   </div>
  </article>
  <aside class="A-infor">
{{--   广告小1--}}
   <img src="/home/upload/2014911.jpg">
   <div class="usercomment">
    <span>用户店铺点评</span>
    @forelse($Guestbooks as $k=>$v)
    <ul>
     <li>
      <img src="{{$v->logo}}" style="width:75px;height:75px;padding:2px;border:1px #cccccc solid;border-radius:50%;float:left;margin-right:5px;">
      用户“{{$v->username}}”对[ {{$v->shop_name}}]留言说：{{$v->content}}...
     </li>
    </ul>
    @empty
     <h2>∑(っ°Д°;)っ卧槽，不见了</h2>
    @endforelse
    <span>用户菜品点评</span>

    <ul>
     @forelse($Gcomment as $k=>$v)
     <li>
      <img src="/{{$v->image_dir}}{{$v->image}}" style="width:75px;height:75px;padding:2px;border:1px #cccccc solid;border-radius:50%;float:left;margin-right:5px;">
      用户“{{$v->username}}”对[ {{$v->shop_name}} ]“{{$v->menu_name}}”评论说：{{$v->detail}}...
     </li>
    </ul>
    @empty
     <h2>∑(っ°Д°;)っ卧槽，不见了</h2>
    @endforelse
   </div>
  </aside>
 </section>
 <!--End content-->
@endsection