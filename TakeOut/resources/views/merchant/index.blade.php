@extends('merchant.public.public')
@section('header')

	<link rel="stylesheet" type="text/css" href="/merchant/style/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/merchant/style/css/external.min.css"/>
	<link rel="stylesheet" type="text/css" href="/merchant/style/css/popup.css"/>
	<link rel="stylesheet" type="text/css" href="/css/public.css"/>
	<script src="/merchant/style/js/jquery.1.10.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/merchant/style/js/jquery.lib.min.js"></script>
	<script src="/merchant/style/js/ajaxfileupload.js" type="text/javascript"></script>
	<script type="text/javascript" src="/merchant/style/js/additional-methods.js"></script>
	<!--[if lte IE 8]>
	<script type="text/javascript" src="/merchant/style/js/excanvas.js"></script>

	<script type="text/javascript" src="/merchant/style/js/conv.js"></script><![endif]-->

@endsection

@section('main')
	<div id="container">
		<div class="clearfix">
			<div class="content_l">
				<form id="companyListForm" name="companyListForm" method="get" action="h/c/companylist.html">
					<input type="hidden" id="city" name="city" value="全国" />
					<input type="hidden" id="fs" name="fs" value="" />
					<input type="hidden" id="ifs" name="ifs" value="" />
					<input type="hidden" id="ol" name="ol" value="" />

					<ul class="hc_list reset">
						@forelse( $shop as $v)
							<li style="position:relative;" >
								<a class="active " href="{{route('merchant.shop.shopActive',[ 'sid' => $v->id ,'active'=>$v->active])}} " style="position:absolute;top:5px;right:5px;{{$v -> active == 4 ? 'pointer-events:none' : $v -> active == 3 ? 'pointer-events:none':''}}">
									@switch($v->active)
										@case(1)
											工作中
										@break;
										@case(2)
											打烊中
										@break;
										@case(3)
										审核中
										@break;
										@case(4)
										禁用
										@break;
										@endswitch
								</a>

								<a href="{{route('merchant.shop.detail',[ 'sid' => $v->id ])}}" target="_blank" style="{{$v -> active == 4 ? 'pointer-events:none' : ''}}">
									<h3 title="CCIC">{{$v -> shop_name}}</h3>
									<div class="comLogo">
										<img src="{{$v -> logo }}" width="190" height="190" alt="CCIC" />
									</div>
								</a>
								<a href="{{route('merchant.shop.detail',[ 'sid' => $v->id ])}}" target="_blank" style="{{$v -> active ==  4 ? 'pointer-events:none' : ''}}"> 电话：{{$v -> shop_mobile}}</a>
								<span>简介</span>
								<a href="{{route('merchant.shop.detail',[ 'sid' => $v->id ])}}" target="_blank" style="{{$v -> active ==  4 ? 'pointer-events:none' : ''}}">{{mb_substr($v -> detail,0,26)}}</a>

							</li>
						@empty
							<li >
								<a href="{{route('merchant.shop.add')}}" target="_blank">
									<div class="comLogo">
										<img src="/image/add.jpg" width="190" height="326" alt="CCIC" />
									</div>
								</a>
							</li>
						@endforelse
					</ul>
					<div class="Pagination"></div>
				</form>
				{{$shop -> links()}}
			</div>
			<div class="content_r">
				<div class="subscribe_side">
					<a href="{{route('merchant.shop.add')}}" target="_blank">
						<div class="subpos"><span>创建</span> 店铺</div>
						<div class="c7">创建一个网路店铺，可以将你的名菜上传到店里，小伙伴们就可以点餐啦
						</div>
						<div class="count">已有
							@foreach($count_shop as $v)
							<em>{{$v}}</em>
							@endforeach
							家店铺
						</div>
						<i>我也要创建店铺</i>
					</a>
				</div>
				<div class="greybg qrcode mt20">
					<img src="/merchant/style/images/companylist_qr.png" width="242" height="242" alt="拉勾微信公众号二维码" />
					<span class="c7">扫描上方二维码，微信轻松点餐</span>
				</div>
				<!-- <a href="h/speed/speed3.html" target="_blank" class="adSpeed"></a> -->
				<a href="h/subject/jobguide.html" target="_blank" class="eventAd">
					<img src="/merchant/style/images/subject280.jpg" width="280" height="135" />
				</a>
				<a href="h/subject/risingPrice.html" target="_blank" class="eventAd">
					<img src="/merchant/style/images/rising280.png" width="280" height="135" />
				</a>
			</div>
		</div>
		<input type="hidden" value="" name="userid" id="userid" />

		<div class="clear"></div>
		<input type="hidden" id="resubmitToken" value="" />
		<a id="backtop" title="回到顶部" rel="nofollow"></a>
	</div><!-- end #container -->
@endsection

@section('script')
	<script>
		//店铺的激活
		$('.active').click(function(){
			me = $(this);
			$.get(me.attr('href'),'',function(data){
				if(data.stats ==='ok'){
					layer.msg(data.msg,{icon:6});
					me.text(data.act).attr('href',data.url)
				}else{
					layer.msg(data.msg,{icon:5})
				}
			});
			return false;
		})
	</script>
@endsection