<!DOCTYPE html>
<html>
@section('header')
<head>
    <meta charset="utf-8" />
    <title>外卖订餐</title>
    <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
    <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
    <meta name="author" content="DeathGhost"/>
    <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
    <link rel="Shortcut Icon" href="/image/title.ico">
    <script type="text/javascript" src="/home/js/public.js"></script>
    <script type="text/javascript" src="/home/js/jquery.js"></script>
    <script type="text/javascript" src="/home/js/layer/layer.js"></script>
    <script type="text/javascript" src="/home/js/jqpublic.js"></script>
    <script src="/home/js/geo.js"></script>
    <!--
    Author: DeathGhost
    Author URI: http://www.deathghost.cn
    -->
<style>
    .display{
        display: none;
    }

    .regRight form.current{
        display: block;
    }

    table td{
        position: relative;
        height:40px;
    }
</style>
</head>
@show

<body>
<header>
    <section class="Topmenubg">
        <div class="Topnav">
            <div class="LeftNav">
                @if(session('mid'))
                    <span>{{session('mGrade')}}</span>
                    <img style="margin-top:6px;border-radius:5px;" width="40px" height="24px" src="{{session('mavatar')?'/'.session('mavatar_dir').session('mavatar'):'/home/images/mao.jpg'}}" class="avatar" />
                    <span>{{session('mname')}}欢迎登录</span>
                    @endif
                @if(!session('mid'))
                        <a href="{{route('home.register')}}">注册</a>/
                        <a href="{{route('home.login')}}">登录</a>
                    @endif
                {{--<a href="#">QQ客服</a>
                <a href="#">微信客服</a>
                <a href="#">手机客户端</a>--}}
            </div>
            <div class="RightNav">
                <a href="{{route('home.activity.index')}}">活动中心</a>
                <a href="{{route('hm.mem.UserCenter')}}">用户中心</a>
                <a href="{{route('hm.mem.UserOrder')}}" target="_blank" title="我的订单">我的订单</a>
                <a href="{{route('home.cart')}}">购物车（<?php cart_a()?>）</a>
                <a href="{{route('hm.mem.UserFavorites')}}" target="_blank" title="我的收藏">我的收藏</a>
                <a href="{{route('merchant.login')}}">商家入驻</a>
            </div>
        </div>
    </section>
    <div class="Logo_search">
        <div class="Logo">
            <a href="{{route('/')}}"><img src="/image/logo.png" title="外卖商城" alt="外卖商城"></a>
            <i></i>
            <select style="height:30px;font-size:15px;border:0;font-weight:700;appearance:none;background:transparent;-moz-appearance: none;-webkit-appearance: none;" name="province" id="s1"></select>
            <select style="height:30px;font-size:15px;border:0;font-weight:700;appearance:none;background:transparent;-moz-appearance: none;-webkit-appearance: none;" name="city" id="s2"></select>
        </div>
        <div class="Search">
            {{--主页搜索--}}
            <div class="regArea">
                <div class="regRight" >
                    <div class="tab Search_nav" id="selectsearch">
                        <a href="javascript:;" onClick="selectsearch(this,'restaurant_name')" class="choose active">餐厅</a>
                        <a href="javascript:;" onClick="selectsearch(this,'food_name')">食物名</a>
                    </div>
                    <form action="" method="post"  id="fom0" class="current">
                        {{csrf_field()}}
                        <div class="Search_area">
                            <input type="search" name="shop_name" value="{{!empty($shop_name)?$shop_name:''}}" placeholder="请输入您所需查找的餐厅名称..." class="searchbox" />
                            <input type="button" id="0" class="searchbutton loginBtn" value="搜 索" />
                        </div>
                    </form>
                    <form action="" method="post"  id="fom1" class="current" style="display: none">
                        {{csrf_field()}}
                        <div class="Search_area">
                            <input type="search" name="menu_name" value="{{!empty($menu_name)?$menu_name:''}}" placeholder="请输入您所需查找的食物名称..." class="searchbox" />
                            <input type="button" id="1" class="searchbutton loginBtn" value="搜 索" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <nav class="menu_bg">
        <ul class="menu">
            <li>
                <a  href="{{'/'}}">首页</a>
            </li>
            <li>
                <a href="{{route('hunt_list')}}">订餐</a>
            </li>
            <li>
                <a href="{{route('hm.mem.UserCoupon')}}">积分兑换</a>
            </li>
            <li>
                <a href="article_read.html">关于我们</a>
            </li>
        </ul>
    </nav>
</header>
<script>
    //选项卡
    $('.tab a').click(function(){
        //划过哪个选项，哪个选项高亮显示 ，而其它的选项取消高亮显示
        $(this).addClass('active').siblings('a').removeClass('active');
        //取出划过选项卡的下标
        var i=$(this).index();
        // console.log($('#form'+i));
        //通过下标找到对应的商品
        $('#fom'+i).css('display','block').siblings('form').css('display','none');
    });

    //提交表单
    $('.loginBtn').click(function(){   //submit按钮方式提交
        var id=$(this).attr('id');  //商品搜索 hunt_list
            $.post('{{route("hunt_list")}}',$('#fom'+id).serialize(),function (data) {
                location = data.url;
            },'json')
    });
</script>
@yield('main')

<footer>
    <section class="Otherlink">
        <aside>
            <div class="ewm-left">
                <p>手机扫描二维码：</p>
                <img src="/home/images/Android_ico_d.gif">
                <img src="/home/images/iphone_ico_d.gif">
            </div>
            <div class="tips">
                <p>客服热线</p>
                <p><i>1830927**73</i></p>
                <p>配送时间</p>
                <p><time>09：00</time>~<time>22:00</time></p>
                <p>网站公告</p>
            </div>
        </aside>
        <section>
            <div>
                <span><i class="i1"></i>配送支付</span>
                <ul>
                    <li><a href="{{route('bg.article.detail')}}" target="_blank" title="标题">支付方式</a></li>
                    <li><a href="" target="_blank" title="标题">配送方式</a></li>
                    <li><a href="article_read.html" target="_blank" title="标题">配送效率</a></li>
                    <li><a href="article_read.html" target="_blank" title="标题">服务费用</a></li>
                </ul>
            </div>
            <div>
                <span><i class="i2"></i>关于我们</span>
                <ul>
                    <li><a href="article_read.html" target="_blank" title="标题">招贤纳士</a></li>
                    <li><a href="article_read.html" target="_blank" title="标题">网站介绍</a></li>
                    <li><a href="article_read.html" target="_blank" title="标题">配送效率</a></li>
                    <li><a href="article_read.html" target="_blank" title="标题">商家加盟</a></li>
                </ul>
            </div>
            <div>
                <span><i class="i3"></i>帮助中心</span>
                <ul>
                    <li><a href="article_read.html" target="_blank" title="标题">服务内容</a></li>
                    <li><a href="article_read.html" target="_blank" title="标题">服务介绍</a></li>
                    <li><a href="article_read.html" target="_blank" title="标题">常见问题</a></li>
                    <li><a href="article_read.html" target="_blank" title="标题">网站地图</a></li>
                </ul>
            </div>
        </section>
    </section>
    <div class="copyright">© 版权所有 2016 DeathGhost 技术支持：<a href="http://www.deathghost.cn" title="DeathGhost">DeathGhost</a></div>
</footer>
</body>

@yield('script')

</html>