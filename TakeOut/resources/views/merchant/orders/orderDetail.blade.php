@extends('merchant.public.public')
@section('header')

    <link href="/merchant/style/css/style.css" type="text/css" rel="stylesheet">
    <link href="/merchant/style/css/external.min.css" type="text/css" rel="stylesheet">
    <link href="/merchant/style/css/popup.css" type="text/css" rel="stylesheet">
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/admin/css/style.css"/>
    <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
    <![endif]-->
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script type="text/javascript" src="/admin/js/H-ui.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/assets/js/jquery.easy-pie-chart.min.js"></script>
    <script src="/admin/js/lrtk.js" type="text/javascript" ></script>
    <title>订单详细</title>
    <style>
        div.product_info a{
            color:#CC40C4;
            font-size: 19px;
            text-decoration:none;
        }
        div.width{
            width:1024px;
        }
    </style>
@endsection


@section('orders')
    <li ><a href="{{route('merchant.orders.index',['sid'=> session('sid') ] )}}" rel="nofollow">订单</a></li>
@endsection


@section('main')<div id="container">

<div class="Order_Details_style">
<div class="Numbering">订单编号:<b>{{$orders_msg[0] -> orders_num}}</b></div></div>
 <div class="detailed_style">
 <!--收件人信息-->
    <span class="Receiver_style">
     <div class="title_name">收件人信息</div>
     <span class="Info_style clearfix">
        <span style="float:left;margin:10px;">
         <label class="label_name" for="form-field-2"> 收件人姓名： </label>
         <span class="o_content">{{$orders_msg[0] -> name}}</span>
        </span>
        <span style="float:left;margin:10px;">
         <label class="label_name" for="form-field-2"> 收件人电话： </label>
         <span class="o_content">{{$orders_msg[0] -> moble}}</span>
        </span>
         <span style="float:left;margin:10px;">
         <label class="label_name" for="form-field-2"> 收件地址： </label>
         <span class="o_content">{{$orders_msg[0] -> site}}{{$orders_msg[0] -> location}}</span>
        </span>
    </span>
    </span>
    <!--订单信息-->
    <div class="product_style">
        <div class="title_name">产品信息</div>
         <div class="Info_style clearfix">
                @forelse( $menu_msg as $k => $v )
                    <div class="product_info clearfix">
                        <a href="{{$v -> id}}" class="img_link"><img src="/{{$v -> image_dir.$v->image}}" /></a>
                        <span>
                            <a href="{{$v -> id}}" class="name_link">{{ $v -> menu_name }}</a><br>
                            <p>数量：{{ $v -> num }}</p>
                            <p>价格：<b class="price"><i>￥</i>{{ $v -> price }}</b></p>

                        </span>
              </div>

                @empty
                    <h1>该订单商品被删除</h1>
                @endforelse
            </div>
        </div>
    <!--总价-->
    <div class="Total_style">
        <div class="Info_style clearfix">
            <div class="col-xs-3"  style="float:left;margin:10px;width:300px;"  >
                <label class="label_name"  for="form-field-2"> 支付方式： </label>
                <div class="o_content">在线支付</div>
            </div>
            <div class="col-xs-3"   style="float:left;margin:10px;width:300px;">
                <label class="label_name" for="form-field-2" > 支付状态： </label>
                <div class="o_content">
                    @switch($menu_msg[0] -> active )
                        @case(1)
                            <span class="label label-success radius">未付款</span>
                            @break
                        @case(2)
                            <span class="label label-success radius">已付款</span>
                            @break
                        @case(3)
                            <span class="label label-success radius">已发货</span>
                            @break
                        @case(4)
                            <span class="label label-success radius">已签收</span>
                            @break
                        @case(5)
                            <span class="label label-success radius">已评论</span>
                            @break
                        @case(6)
                            <span class="label label-success radius">退货</span>
                            @break
                    @endswitch
                </div>
            </div>
            <div class="col-xs-3"  style=" float:left;margin:10px;width:300px;">
                <label class="label_name" for="form-field-2" > 订单生成日期： </label>
                <div class="o_content" style="width:300px;">{{ date("Y-m-d H:i:s",$menu_msg[0] -> add_time )}}</div>
            </div>
        </div>
        <div class="Total_m_style">
            <span class="Total" style="margin-left:45px;">总数：<b>10</b></span>
            <span class="Total_price">总价：<b>{{ $menu_msg[0] -> orders_price }}</b>元</span>
        </div>
    </div>


{{--    <!--物流信息-->
    <div class="Logistics_style clearfix">
     <div class="title_name">物流信息</div>
      <!--<div class="prompt"><img src="/admin/iamges/meiyou.png" /><p>暂无物流信息！</p></div>-->
       <div data-mohe-type="kuaidi_new" class="g-mohe " id="mohe-kuaidi_new">
        <div id="mohe-kuaidi_new_nucom">
            <div class="mohe-wrap mh-wrap">
                <div class="mh-cont mh-list-wrap mh-unfold">
                    <div class="mh-list">
                        <ul>
                            <li class="first">
                                <p>2015-04-28 11:23:28</p>
                                <p>妥投投递并签收，签收人：他人收 他人收</p>
                                <span class="before"></span><span class="after"></span><i class="mh-icon mh-icon-new"></i></li>
                            <li>
                                <p>2015-04-28 07:38:44</p>
                                <p>深圳市南油速递营销部安排投递（投递员姓名：蔡远发<a href="tel:18718860573">18718860573</a>;联系电话：）</p>
                                <span class="before"></span><span class="after"></span></li>
                            <li>
                                <p>2015-04-28 05:08:00</p>
                                <p>到达广东省邮政速递物流有限公司深圳航空邮件处理中心处理中心（经转）</p>
                                <span class="before"></span><span class="after"></span></li>
                            <li>
                                <p>2015-04-28 00:00:00</p>
                                <p>离开中山市 发往深圳市（经转）</p>
                                <span class="before"></span><span class="after"></span></li>
                            <li>
                                <p>2015-04-27 15:00:00</p>
                                <p>到达广东省邮政速递物流有限公司中山三角邮件处理中心处理中心（经转）</p>
                                <span class="before"></span><span class="after"></span></li>
                            <li>
                                <p>2015-04-27 08:46:00</p>
                                <p>离开泉州市 发往中山市</p>
                                <span class="before"></span><span class="after"></span></li>
                            <li>
                                <p>2015-04-26 17:12:00</p>
                                <p>泉州市速递物流分公司南区电子商务业务部已收件，（揽投员姓名：王晨光;联系电话：<a href="tel:13774826403">13774826403</a>）</p>
                                <span class="before"></span><span class="after"></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>--}}
<div class="Button_operation">
    <button  class="back_page btn btn-primary radius" id="back"><i class="icon-save "></i>返回上一步</button>
    <button onclick="layer_close();" class=" btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
</div>
 </div>
</div>
@endsection

@section('script')
<script>
    //后退一步操作
    $('#back').click(function(){
        history.back();
    })
    //返会订单页面
    function layer_close(){
        location = "{{route('merchant.orders.index',['sid'=>session('sid')])}}";
    }

</script>
@endsection
