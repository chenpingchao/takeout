﻿@extends('merchant.public.public')

@section('header')

	<link href="/merchant/style/css/style.css" type="text/css" rel="stylesheet">
	<link href="/merchant/style/css/external.min.css" type="text/css" rel="stylesheet">
	<link href="/merchant/style/css/popup.css" type="text/css" rel="stylesheet">
	<link href="/css/public.css" type="text/css" rel="stylesheet">
	<script src="/merchant/style/js/geo.js" charset="UTF-8" type="text/javascript"></script>
{{--	<script type="text/javascript" src="/merchant/style/js/jquery.1.10.1.min.js"></script>--}}
	<script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="/js/layer/layer.js"></script>
	<script type="text/javascript" src="/merchant/style/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="/merchant/style/js/jquery.form.js"></script>
	<script type="text/javascript" src="/merchant/style/js/ajaxfileupload.js"></script>
	<script src="/merchant/style/js/jquery.lib.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/merchant/style/kindeditor/kindeditor-all.js"></script>


	<!--[if lte IE 8]>
	<script type="text/javascript" src="/merchant/style/js/excanvas.js"></script>
	<![endif]-->
	<script type="text/javascript">
		var youdao_conv_id = 271546;
	</script>
	<script src="/merchant/style/js/ajaxCross.json" charset="UTF-8"></script>
	<link rel="stylesheet" href="/merchant/style/css/preview.css">
	<script src="/js/preview/preview.js"></script>
	<style type=text/css>
		input.error { border: 1px solid #EA5200;background: #ffdbb3;}

		div.error {
			background:url("/image/error.png") no-repeat 5px 2px;
			padding-left: 22px;
			padding-bottom: 2px;
			font-weight: bold;
			color: #EA5200;
			vertical-align: middle
		}
		div.ok {
			background:url("/image/ok.png") no-repeat 5px 2px;
			color: #6aea4c;
		}
	</style>

@endsection

@section('orders')
	<li ><a href="{{route('merchant.orders.index',['sid'=> session('sid') ] )}}" rel="nofollow">订单</a></li>
@endsection

@section('main')

    <div id="container">

  		<div style="" id="stepTip">
       		<a></a>
       		<img width="803" height="59" src="/merchant/style/images/tiponce.jpg">
       	</div>
        <div class="content_mid">
        	<dl class="c_section c_section_mid">
                <dt>
                    <h2><em></em>填写菜品信息</h2>
                </dt>
                <dd>
	                <form id="stepForm"  method="post" enctype="multipart/form-data">
	                	<input type="hidden" name='sid' value='{{$detail -> sid}}'>
						{{csrf_field()}}
	                	<div class="c_text_1">基本信息为必填项，菜品信息要全面，认真填写吧！</div>
						<h3>菜品图片</h3> <!--非必填改必填-->
						<div class="c_logo c_logo_pos">
							<div class="preview-div">
								<label for="pic" class="preview-label">菜品图片</label>
								<input type="file" id="pic" value="/{{$detail -> image_dir.$detail -> image}}" name="image" onchange="preview(this,200,200)" class="preview-input">
								<img src="/{{$detail -> image_dir.$detail -> image}}" alt="" >
							</div>
						</div>

	                    <h3>菜品名称 </h3>
	                    <input type="text" placeholder="请输入菜品名称" value="{{$detail->menu_name}}" name="menu_name" id="menu_name" class="valid">
						<div class="image shop_name"></div>

						<h3>菜品关键词</h3>
						<input type="text" placeholder="请输入菜品关键词" value="{{$detail->key_words}}" name="key_words" id="key_words">
						<div class="image shop_mobile"></div>

	                    <h3>菜品分类</h3> <!--非必填改必填-->
						<select name="mc_id" id="" class="xuanze">
							@forelse($menu_cate as $v)
								<option value="{{$v->id}}" {{$detail->mc_id == $v->id?'selected':''}}>{{$v-> mc_name}}</option>
							@empty
								<option value="0">其他</option>
							@endforelse
						</select>

						<h3>菜品原价</h3>
						<input type="text" placeholder="请输入菜品原价" value="{{$detail -> or_price}}" name="or_price" id="or_price">
						<div class="image website"></div>

						<h3>菜品现价</h3>
						<input type="text" placeholder="请输入菜品现价" value="{{$detail -> price}}" name="price" id="price">
						<div class="image shop_mobile"></div>

	                    <h3>菜品介绍</h3>
						<textarea  name="detail" id="temptation"  cols="30" rows="10">{{$detail -> detai}}</textarea>

	                    <span style="display:none;" class="error" id="beError"></span>

	                    <input type="submit" value="更新菜品" id="stepBtn" class="btn_big fr">
	                </form>
                </dd>
            </dl>
       	</div>

<!------------------------------------- end ----------------------------------------->

			<div class="clear"></div>
			<input type="hidden" value="13ae35fedd9e45cdb66fb712318d7369" id="resubmitToken">
	    	<a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
	    </div><!-- end #container -->

@endsection

@section('script')
	<script>

		$(document).ready(function(e) {
			//加载富文本编辑器
			KindEditor.ready(function(K) {
				K.create('#temptation', {
					allowFileManager : true,
					filterMode:true,
					afterBlur:function(){
						this.sync("#temptation");
					}
				});
			});
		});

		var avatar = {};
		avatar.uploadComplate = function( data ){
			var result = eval('('+ data +')');
			if(result.success){
				jQuery('#logoShow img').attr("src",ctx+ '/'+result.content);
				jQuery.colorbox.close();
				jQuery('#logoNo').hide();
				jQuery('#logoShow').show();
			}
		};

		//商品分类三级联动
		var firstCate = $('select[name="firstCate"]');
		var secondCate = $('select[name="secondCate"]');
		var thirdCate = $('select[name="thirdCate"]');

		//拿各个级别的分类
		function getSubCate(select,pid,cid){
			$.get('{{route("merchant.shop.nextList")}}',{pid:pid,cid:cid},function(data){
				//写入相应的select下列菜单
				select.html(data);
			},'html')
		}

		//获取所有的顶级分类作为一级分类菜单内容
		getSubCate(firstCate,0,999);

		//获取对应的二级分类
		firstCate.change(function(){
			getSubCate(secondCate,firstCate.val());
			thirdCate.html('<option value="999">请选择</option>')
		});

		//获取对应的三级分类
		secondCate.change(function(){
			getSubCate(thirdCate,secondCate.val());
		});

		//表单验证
		var s = $("#stepForm").validate({
			rules:{
				menu_name:{
					required:true,
					minlength:2,
					maxlength:20,
				},

				key_words:{
					required:true,
				},
				thirdCate:{
					required:true,
				},
				or_price:{
					required:true,
					number:true,
					min:0
				},
				price:{
					required:true,
					number:true,
					min:0
				}
			},
			messages:{
				menu_name:{
					required:'必须有菜品名',
					minlength:'最少2个字符',
					maxlength:'最多20个字符',
				},
				key_words:{
					required:'关键词不能为空',
				},
				thirdCate:{
					required:'分类不能为空',
				},
				or_price:{
					required:'菜品原价不能为空',
					number:'必须为数字',
					min:'请输入一个大于0的数'
				},
				price:{
					required:'菜品现价不能为空',
					number:'必须为数字',
					min:'请输入一个大于0的数'
				}
			},
			errorElement: "div",
			success: function(div) {
				div.addClass("ok").html('验证成功');
			},
			validClass: "ok"
		});


		$('#stepForm').submit(function(){
            //判断分类是否选中
            if( $('select[name="thirdCate"]').val() === '请选择' ){
                layer.msg('请选择分类',{icon:5,time:1300},function(){
                    return false
                })
            }
            if(s.form()){
				//提交
				me = $(this);
				me.ajaxSubmit({
					success:function(data){
						if(data.stats === 'ok'){
							layer.msg(data.msg,{icon:6,shade:[0.6],time:1500},function(){
								location = data.url;
							})
						}else{
							layer.msg(data.msg,{icon:6,shade:[0.6],time:2500})
						}
					},
					error:function (xhr) {
						var errors = JSON.parse(xhr.responseText).errors;
						//清空前台表单验证
						$('div.image').text('');
						//将错误信息写入表单
						for(var i in errors){
							$('.'+i).text(errors[i][0]).addClass('error')

						}
					}
				});

			}else{
            	layer.msg('信息没有更新')
			}
			return false;

		})
	


	</script>
@endsection