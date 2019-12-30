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
                        {!!$show!!}
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
