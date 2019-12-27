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
<!--
Author: DeathGhost
Author URI: http://www.deathghost.cn
-->
</head>
@endsection

@section('main')
<!--Start content-->
<section class="Psection">

    <div>
        <section class="fslist_navtree">
            <ul class="select">
                <li class="select-list">
                    <dl id="select1">
                        <dt>分类：</dt>
                        <dd class="select-all selected"><a href="javascript:">全部</a></dd>
                        @forelse($ShopCate as $sc)
                            <dd><a href="javascript:" id="sc{{$sc->id}}">{{$sc->sc_name}}</a></dd>
                        @empty
                            <h2>暂无店铺分类信息</h2>
                        @endforelse
                    </dl>
                </li>
                <li class="select-list">
                    <dl id="select2">
                        <dt>位置：</dt>
                        <dd class="select-all selected "><a href="javascript:">全部</a></dd>
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
                        $('#select2').append(str);
                    }
                </script>
                <li class="select-list">
                    <dl id="select3">
                        <dt>价位区间：</dt>
                        <dd class="select-all selected"><a href="javascript:">全部</a></dd>
                        <dd><a href="javascript:" id="q1">20元以下</a></dd>
                        <dd><a href="javascript:" id="q2">20-40元</a></dd>
                        <dd><a href="javascript:" id="q3">40-60元</a></dd>
                        <dd><a href="javascript:" id="q4">60-80元</a></dd>
                        <dd><a href="javascript:" id="q5">80-100元</a></dd>
                        <dd><a href="javascript:" id="q6">100元以上</a></dd>
                    </dl>
                </li>
                <li class="select-result">
                    <dl class="select_xx"><dd class="select-no">已选择：</dd></dl>
                </li>
            </ul>
        </section>
    </div>

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
 <ul style="width: 100%;" id="search_shop">
  @forelse($ShopName as $s)
  <li style="width:398px;">
      <a href="{{route('home.shopDetail',['sid' => $s->id ])}}" target="_blank" title="{{$s -> sc_name}}/{{$s -> shop_name}}">
          <img style="width:385px;" src="{{$s->image}}">
      </a>
   <hgroup>
   <h3>{{$s->shop_name}}</h3>
   <h4></h4>
   </hgroup>
   <p>店铺类别：{{$s->sc_name}}</p>
   <p>地址：{{$s->site}}{{$s->location}}</p>
   <p>人均：{{$s->avg_price}}元</p>
   <p style="">
    <span class="Score-l" style="width:220px;">
    @for ($i = 0; $i <ceil(!empty($s->grade)?$s->grade:5); $i++)
            <img src="/home/images/star-on.png">
        @endfor
        @for ($i = 0; $i <floor(5-(!empty($s->grade)?$s->grade:5)); $i++)
            <img src="/home/images/star-off.png">
        @endfor
    <span class="Score-v">{{!empty($s->grade)?$s->grade:5}}</span>
    </span>
    <span class="DSBUTTON">
        <a href="{{route('home.shopDetail',['sid' => $s->id ])}}" target="_blank" class="Fontfff">进店</a>
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
    $('.fslist_navtree').live('click',function(){
        var scName=$('#selectA').find("a").text();
        var site=$('#selectB').find("a").text();
        var money=$('#selectC').find("a").text();
        var ab = {};
        ab.scName='';
        ab.site='';
        ab.money='';
        if (scName){
            ab.scName = scName
        }
        if (site){
            ab.site = site
        }
        if (money){
            ab.money = money
        }
        console.log(ab);
        $.post('{{route('H_list_shop',($shop_name?$shop_name:'') )}}',{ab:ab,_token:'{{csrf_token()}}'},function(data){
            $('#search_shop').html(data);//模板替换
        },'html');
    })
 </script>
@endsection