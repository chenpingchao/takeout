@extends('home.public.public')
@section('head')
<head>
<meta charset="utf-8" />
<title>DeathGhost-产品分类页面</title>
<meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
<meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
<meta name="author" content="DeathGhost"/>
<link href="/home/style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/home/js/public.js"></script>
    <script type="text/javascript" src="/home/js/jQuery.1.8.2.min.js"></script>
<script type="text/javascript" src="/home/js/jqpublic.js"></script>
    <script src="/home/KPS/js/starScore.js"></script>
<!--
Author: DeathGhost
Author URI: http://www.deathghost.cn
-->
</head>
@endsection

@section('main')
<!--Start content-->
<section class="Psection">

 <section class="fslist_navtree">
  <ul class="select">
      <li class="select-list">
			<dl id="select1">
				<dt>位置：</dt>
				<dd class="select-all selected"><a href="javascript:">全部</a></dd>
			</dl>
		</li>
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
      <li class="select-list">
			<dl id="select2">
				<dt>价位区间：</dt>
				<dd class="select-all selected"><a href="javascript:">全部</a></dd>
				<dd><a href="javascript:">20元以下</a></dd>
                <dd><a href="javascript:">20-40元</a></dd>
                <dd><a href="javascript:">40-60元</a></dd>
                <dd><a href="javascript:">60-80元</a></dd>
                <dd><a href="javascript:">80-100元</a></dd>
                <dd><a href="javascript:">100元以上</a></dd>
			</dl>
		</li>
      <li class="select-result">
          <dl class="select_xx"><dd class="select-no">已选择：</dd></dl>
      </li>
	</ul>
 </section>
<section class="Fslmenu">
 <a href="#" title="默认排序">
  <span>
  <span>默认排序</span>
  <span></span>
  </span>
 </a>
 <a href="#" title="评价">
  <span>
  <span>评价</span>
  <span class="s-up"></span>
  </span>
 </a>
 <a href="#" title="销量">
  <span>
  <span>销量</span>
  <span class="s-up"></span>
  </span>
 </a>
 <a href="#" title="价格排序">
  <span>
  <span>价格</span>
  <span class="s-down"></span>
  </span>
 </a>
 <a href="#" title="发布时间排序">
  <span>
  <span>发布时间</span>
  <span class="s-up"></span>
  </span>
 </a>
</section>
<section class="Fsl">
 <ul style="width: 100%;" id="search_menu">
     @forelse($MenuName as $m)
      <li style="width: 398px">
       <a href="{{route('home.menuDetail',['uid' => $m->id ])}}" title="{{$m->menu_name}}"><img style="width:385px;"  src="/{{$m->image_dir}}{{$m->image}}"></a>
       <hgroup>
       <h3>{{$m->menu_name}}</h3>
       <h4></h4>
       </hgroup>
       <p>地址：{{$m->site}}</p>
       <p>原价：{{$m->or_price}}元</p>
       <p>现价：{{$m->price}}元</p>
       <p>
        <span class="Score-l" style="width:220px;">
            @for ($i = 0; $i <ceil(!empty($m->fenshu)?$m->fenshu:5); $i++)
                <img src="/home/images/star-on.png">
            @endfor
            @for ($i = 0; $i <floor(5-(!empty($m->fenshu)?$m->fenshu:5)); $i++)
                <img src="/home/images/star-off.png">
            @endfor
        <span class="Score-v">{{!empty($m->fenshu)?$m->fenshu:5}}</span>
        </span>
        <span class="DSBUTTON">
            <a href="{{route('home.menuDetail',['uid' => $m->id ])}}" class="Fontfff">购物</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{route('home.shopDetail',['sid' => $m->sid ])}}" target="_blank" class="Fontfff">店铺</a>
        </span>
       </p>
      </li>
     @empty
         <h2>暂无好吃的菜品信息</h2>
     @endforelse
 </ul>
 <div class="TurnPage">
  <a href="#">
  <span class="Prev"><i></i>首页</span>
  </a>
  <a href="#"><span class="PNumber">1</span></a>
  <a href="#"><span class="PNumber">2</span></a>
  <a href="#">
  <span class="Next">最后一页<i></i></span>
  </a>
 </div>
</section>
</section>
<!--End content-->
@endsection
@section('script')
 <script>
    //获取搜索条件
     $('.fslist_navtree').live('click',function () {
         var site=$('#selectA').find("a").text();
         var money=$('#selectB').find("a").text();
         var ab={};
         ab.site='';
         ab.money='';
         if (site){
             ab.site = site
         }
         if (money){
             ab.money = money
         }
         console.log(ab);
         $.post('{{route('H_list_menu',($menu_name?$menu_name:'') )}}',{ab:ab,_token:'{{csrf_token()}}'},function(data){
             $('#search_menu').html(data);//模板替换
         },'html');
     })
 </script>
@endsection