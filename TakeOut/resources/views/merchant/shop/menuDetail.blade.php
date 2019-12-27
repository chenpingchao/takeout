@extends('merchant.public.public')

@section('header')
	
<link href="http://www.lagou.com/images/favicon.ico" rel="Shortcut Icon">
<link href="/merchant/style/css/style.css" type="text/css" rel="stylesheet">
<link href="/merchant/style/css/external.min.css" type="text/css" rel="stylesheet">
<link href="/merchant/style/css/popup.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="/merchant/style/css/preview.css">

<script type="text/javascript" src="/merchant/style/js/jquery.1.10.1.min.js"></script>
<script src="/merchant/style/js/jquery.lib.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/merchant/style/js/ajaxfileupload.js"></script>
<script src="/merchant/style/js/additional-methods.js" type="text/javascript"></script>
<script src="/js/layer/layer.js" type="text/javascript"></script>
<!--[if lte IE 8]-->
    <script type="text/javascript" src="/merchant/style/js/excanvas.js"></script>
<!--[endif]-->
<script src="/js/preview/preview.js"></script>
<style>
    .width{
       margin:10px;
    }
	.ul{
		margin:10px 0 30px 0;
		list-style-type: none;
	}
</style>
	
@endsection

@section('orders')
	<li ><a href="{{route('merchant.orders.index',['sid'=> session('sid') ] )}}" rel="nofollow">订单</a></li>
@endsection

@section('main')
    <div id="container">
        <!-- <script src="/merchant/style/js/swfobject_modified.js" type="text/javascript"></script> -->
        <div class="clearfix">
			{{--店铺信息--}}
            <div class="content_l">           
				<div class="c_detail">
					{{--菜品图片--}}
					<div style="background-color:#fff;" class="c_logo">
						<img width="196" src="/{{ $detail ->image_dir . $detail -> image }}" alt="菜品图片" >
					</div>
					{{--店铺详细信息--}}
					<div class="c_box companyName">
						<h2 >{{$detail -> menu_name}}</h2>
						<div class="clear"></div>
						<div class="clear oneword">
							<h1 title="关键词" class="fullname">关键字：{{$detail -> key_words}}</h1>
							<h1 title="分类" class="fullname">菜品分类：{{$detail -> mc_name}}</h1>
							<h1 title="销量" class="fullname">菜品销量：{{$detail -> salde_num}}</h1>
							<h1 title="评价数量" class="fullname">评价数量：{{$detail -> eval_num}}</h1>
					</div>
						<div class="clear"></div>
	                </div>
				<div class="c_breakline"></div>

				<div id="Profile" style="margin-top:60px;">
					<div class="profile_wrap">
						@if($detail -> detail)
						<!--有介绍-->
						<dl class="c_section">
							<dt>
								<h2><em></em>菜品介绍</h2>
							</dt>
							<dd>
								<div class="c_intro">{!! $detail -> detail  !!}</div>
							</dd>
						</dl>
						@else
							<dl class="c_section">
								<dt>
									<h2><em></em>菜品介绍</h2>
								</dt>
								<dd>
									<span style="font-size: 20px">这个菜品没有介绍哟</span>
								</dd>
							</dl>
						@endif
					</div>
					{{--评价--}}
					<dl class="c_section">
						<dt>
							<h2><em></em>评价</h2>
						</dt>
					</dl>
					<ul class="ul">

						@forelse( $comment as $v)

							<li class="width">
								<a href="{{route('merchant.shop.detail',[ 'sid' => $v->id ])}}" target="_blank">
									<img src="/{{$v -> avatar ?$v -> avatar : "image/timg.jpg"}}" width="40" height="40" alt="头像" />
									<span style="line-height:40px;font-size: 25px">{{$v -> username}}</span>
								</a>&emsp;&emsp;
								<span>{{date('Y-m-d H:i:s',$v-> price)}}</span><br>
								<span>{{$v -> detail}}</span>
							</li>
						@empty
							<li >
								<h1 style="text-align: center;">该菜品还没有评价</h1>
							</li>
						@endforelse
					</ul> <!-- end #Product -->

      	
      	<!--[if IE 7]> <br /> <![endif]-->
	    
	        	<!--无招聘职位-->
				<dl id="noJobs" class="c_section">
		                	<dt>
		                    	<h2><em></em>更改菜品信息</h2>
		                    </dt>
		                    <dd>
		                    	<div class="addnew">
		                        	更新菜品信息，让更多的人知道……<br>
		                            <a href="{{route('merchant.shop.menuChange',['uid'=> $detail->id])}}">更新菜品信息</a>
		                        </div>
		                    </dd>
		                </dl>
            </div>	<!-- end .content_l -->

   	</div>
{{--    <div class="content_r">
                <div id="Member">
                    <!--有创始团队-->
                    <dl class="c_section c_member">
                        <dt>
                            <h2><em></em>店铺负责人</h2>
                        </dt>
                        <dd>
                            <div class="member_wrap">
                                <!-- 显示创始人 -->
                                <div class="member_info">
                                    <a title="编辑负责人" class="c_edit member_edit" href="javascript:show()"></a>
                                    <div style="text-align: center;font-size: 30px;">

                                        <a target="_blank" class="weibo" href="http://weimob.weibo.com"></a>
                                    </div>
                                    <div class="m_position" style="margin-left: 60px;font-size: 18px;"></div>
                                    <div class="m_intro" style="text-align: center;font-size: 17px;"></div>
                                </div>
                            </div><!-- end .member_wrap -->
                        </dd>
                    </dl>
                </div> <!-- end #Member -->


            </div>--}}
<!-------------------------------------弹窗lightbox  ----------------------------------------->
<div style="display:none;">
	<div style="width:650px;height:470px;" class="popup" id="logoUploader">
		<object width="650" height="470" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="FlashID">
		  <param value="../../flash/avatar.swf?url=http://www.lagou.com/cd/saveProfileLogo.json" name="movie">
		  <param value="high" name="quality">
		  <param value="opaque" name="wmode">
		  <param value="111.0.0.0" name="swfversion">
		  <!-- 此 param 标签提示使用 Flash Player 6.0 r65 和更高版本的用户下载最新版本的 Flash Player。如果您不想让用户看到该提示，请将其删除。 -->
		  <param value="../../Scripts/expressInstall.swf" name="expressinstall">
		  <!-- 下一个对象标签用于非 IE 浏览器。所以使用 IECC 将其从 IE 隐藏。 -->
		  <!--[if !IE]>-->
		  <object width="650" height="470" data="../../flash/avatar.swf?url=http://www.lagou.com/cd/saveProfileLogo.json" type="application/x-shockwave-flash">
		    <!--<![endif]-->
		    <param value="high" name="quality">
		    <param value="opaque" name="wmode">
		    <param value="111.0.0.0" name="swfversion">
		    <param value="../../Scripts/expressInstall.swf" name="expressinstall">
		    <!-- 浏览器将以下替代内容显示给使用 Flash Player 6.0 和更低版本的用户。 -->
		    <div>
		      <h4>此页面上的内容需要较新版本的 Adobe Flash Player。</h4>
		      <p><a href="http://www.adobe.com/go/getflashplayer"><img width="112" height="33" src="/merchant/style/images/get_flash_player.gif" alt="获取 Adobe Flash Player"></a></p>
		    </div>
		    <!--[if !IE]>-->
		  </object>
		  <!--<![endif]-->
		</object>
	</div><!-- #logoUploader -->
</div>
<!------------------------------------- end ----------------------------------------->

<script src="/merchant/style/js/company.min.js" type="text/javascript"></script>
<script>
var avatar = {};
avatar.uploadComplate = function( data ){
	var result = eval('('+ data +')');
	if(result.success){
		jQuery('#logoShow img').attr("src",ctx+ '/'+result.content);
		jQuery.colorbox.close();
	}
};
</script>
			<div class="clear"></div>
			<input type="hidden" value="d1035b6caa514d869727cff29a1c2e0c" id="resubmitToken">
	    	<a rel="nofollow" title="回到顶部" id="backtop" style="display: inline;"></a>
	   		 </div><!-- end #container -->

@endsection
@section('script')
			<script>
				function show(){
					$('.aa').show();
				}
				function changeOut(){
					$('.aa').css('display','none');
				}
				//店铺信息修改
				$('#editDetailForm').submit(function(){
					me = $(this);
					$.post(me.attr('action'),me.serialize(),function(data){
						if(data.stats ==='ok'){
							layer.msg(data.msg,{icon:6})
						}else{
							layer.msg(data.msg,{icon:5})
						}
					});
					return false;
				});

				//店铺信息详情
				$('#companyDesForm').submit(function(){
					me = $(this);
					$.post('{{route('merchant.shop.detailchange')}}',me.serialize(),function(data){
						if(data.stats ==='ok'){
							layer.msg(data.msg,{icon:6})
						}else{
							layer.msg(data.msg,{icon:5})
						}
					});
					return false;
				});
				//店铺负责人
				$('#audit').submit(function(){
					me = $(this);
					$.post('{{route('merchant.shop.auditchange')}}',me.serialize(),function(data){
						if(data.stats ==='ok'){
							layer.msg(data.msg,{icon:6})
						}else{
							layer.msg(data.msg,{icon:5})
						}
					});
					return false;
				});
			</script>
@endsection
