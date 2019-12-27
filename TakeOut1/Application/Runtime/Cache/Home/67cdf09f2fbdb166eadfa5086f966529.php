<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width"/>
<meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link type="text/css" href="/Public/css/css.css" rel="stylesheet" />
<script type="text/javascript" src="/Public/js/jQuery-1.8.2.min.js"></script>
<script type="text/javascript" src="/Public/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/Public/js/layer_mobile/layer.js"></script>
    <title>炸鸡</title>
    <style>
        .display{
            display: none;
        }
        .regRight div .current{
            display: block;
        }
        .order_right .jjj{
            font-size:13px;
        }
        .title-list li.active{
            color: #ff6600;
            font-weight: bold;
            width: 93.75px;
            line-height: 43px;
            float: left;
            display: inline;
            cursor: pointer;
            /*font-weight: bold;*/
            /*color: #333333;*/
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
    <table width="100%" border="0" cellspacing="0" class="header_nav">
    	<tr>
        	<td width="10%" class="nav_left1"><a  href='javascript:window.history.go(-1)'><</a></td>
            <td width="80%"class="nav_title"><?php echo ($ShopOne['shop_name']); ?></td>
            <td width="10%" class="nav_r"></td>
        </tr>
    </table>
    </div>
    
    <!--/*主要部分*/-->
    <div class="takemain">
    	<a href="order.html"></a>
            <div class="take">
                <td width="" class="take_pic">
                    <img src="http://www.liuweiliming.cn<?php echo ($ShopOne['image']); ?>" width="100%" height="300px"/>
                </td>
        	<table width="100%" border="0" cellspacing="0">
                <tr style="">
                   <td width="50" class="take_text">
                       <div style="margin-bottom:8px;" take_text_1><?php echo ($ShopOne['shop_name']); ?></div>
                       <!--点击收藏-->
                       <div style="float: right;" class="sj">
                           <a href="<?php echo U('Home/Shop/Num_T',array('id'=>$ShopOne['id']));?>" id="collection-add-del" class="icoa">
                               <img src="/Public/img/collect.png">
                               收藏店铺（<span id="coll_num"><?php echo ($num); ?></span>）
                           </a>
                       </div>

                       <div class="jj">电话:<?php echo ($ShopOne['shop_mobile']); ?></div>
                       <div class="sj">地址:<?php echo ($ShopOne['site']); ?></div>
                       <div class="sj">描述:<?php echo ($ShopOne['detail']); ?></div>
                   </td>
                </tr>
                <tr>
                    <td class="take_phone">
                        <div style="width:100%;margin-bottom:300px;">
                            <div class="order" style="margin-top:20px;">
                                <ul class="order_left title-list">
                                    <li class="left active">菜品</li>
                                    <li class="left">评论</li>
                                    <li class="left">详情</li>
                                    <li class="left">留言</li>
                                </ul>
                                <div class="menutab-wrap">
                                        
                                    <div class="order_right current menutab" style="display:block;" id="menutabs0">
                                            <?php if(is_array($Menu)): $k = 0; $__LIST__ = $Menu;if( count($__LIST__)==0 ) : echo "没有菜品" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><a href="product.html">
                                                    <div class="ordermain">
                                                    <table width="100%" border="0" cellspacing="0" >
                                                        <tr>
                                                            <td width="30" class="order_pic"><img  src="<?php echo ($v['filepath1']?$v['filepath1']:$filepath2); ?>" width="100%" height="auto"/></td>
                                                            <td width="60" class="order_text">
                                                                <div take_text_1><?php echo ($v["menu_name"]); ?></div>
                                                                <div>
                                                                    <div></div>
                                                                    <div class="jjj" style="width:110px; white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">描述:<?php echo ($v["detail"]); ?></div>
                                                                    <div class="jjj">销量:<?php echo ($v["salde_num"]); ?></div>
                                                                </div>
                                                                <div class="sj">规格：<span><?php echo ($v["price"]); ?></span>/盘</div>
                                                            </td>
                                                            <td width="10"><input type="checkbox"/></td>
                                                        </tr>
                                                    </table>
                                                </div></a><?php endforeach; endif; else: echo "没有菜品" ;endif; ?>
                                    </div>
                                        
                                    <div class="order_right current menutab" style="display: none;height:330px;" id="menutabs1">
                                        <?php if(is_array($MenuComment)): $k = 0; $__LIST__ = $MenuComment;if( count($__LIST__)==0 ) : echo "没有评论" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="ShopComment">
                                                <div class="SpName">
                                                    <a class="jjj" href="#"><b>菜名:</b><?php echo ($v["menu_name"]); ?></a>
                                                </div>
                                                <div class="C-content" style="text-align: center;">
                                                    <div style="text-align:left;"><q class="jjj"><?php echo ($v["detail"]); ?></q></div>
                                                    <div style="text-align:right;"><i class="jjj"><?php echo ($v["add_time"]); ?></i></div>
                                                </div>
                                                <div style="float:right;" class="username jjj"><b>用户:</b><?php echo ($v["username"]); ?></div>
                                            </div>
                                            <div class="ShopComment" style="margin-top:10px;">
                                                <div class="username jjj"><b><?php echo ($v["shop_name"]); ?>:</b><i class="jjj"><?php echo ($v["reply"]); ?></i></div>
                                            </div>
                                            <hr style="margin-bottom:5px;margin-top:5px;"><?php endforeach; endif; else: echo "没有评论" ;endif; ?>
                                    </div>
                                        
                                    <div class="order_right current menutab" style="display: none;height:330px;" id="menutabs2">
                                        <div>
                                            <img style="border-radius:50%;" src="http://www.liuweiliming.cn<?php echo ($ShopOne['logo']); ?>" width="40%"/>
                                        </div>
                                        <div class="jjj" style="margin-top:15px;margin-left:10px;">注册时间:<?php echo ($ShopOne['add_time']); ?></div>
                                        <div class="sjj" style="margin-top:15px;margin-left:10px;"><?php echo ($ShopOne['time']); ?>年老店</div>
                                    </div>
                                        
                                    <div class="order_right current menutab" style="display: none;height:330px;" id="menutabs3">
                                        <?php if(is_array($Guestbook)): $k = 0; $__LIST__ = $Guestbook;if( count($__LIST__)==0 ) : echo "暂时没有评论" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="ShopComment">
                                                <div class="SpName">
                                                    <a class="jjj" href="#"><b>用户:</b><?php echo ($v["username"]); ?></a>
                                                </div>
                                                <div class="C-content" style="text-align: center;">
                                                    <div style="text-align:left;"><q class="jjj" ><?php echo ($v["content"]); ?></q></div>
                                                    <div style="text-align:right;"><i class="jjj" ><?php echo ($v["add_time"]); ?></i></div>
                                                </div>
                                            </div>
                                            <div class="ShopComment" style="margin-top:10px;">
                                                <div class="username jjj"><b><?php echo ($v["shop_name"]); ?>:</b><i class="jjj"><?php echo ($v["reply"]); ?></i></div>
                                            </div>
                                            <hr style="margin-bottom:5px;margin-top:5px;"><?php endforeach; endif; else: echo "暂时没有评论" ;endif; ?>
                                        <div style="margin-bottom:5px;margin-top:5px;">
                                            <form class="jjj" id="form_adds form_val" method="post" action="">
                                                <table style="margin-left:5px;" width="100%" border="0" cellspacing="0" class="mainl">
                                                    <tr>
                                                        <td class="text">
                                                            <i>问题补充：</i>
                                                            <textarea name="content" id="guestbook" cols="" rows=""  required placeholder="请详细说明您的问题..." style="width:250px;height:80px" onkeyup="checkLength(this);"></textarea>
                                                            <div class="validate-error"><?php echo ((isset($errors["content"]) && ($errors["content"] !== ""))?($errors["content"]):''); ?></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div>
                                                    <input type="button" style="width:50px;height:20px;border:1px #dddddd solid;margin-left:5px;margin-top:5px;" id="guestbook_add"  value="提交" />
                                                    <span style="float:right;">剩余字数：<span id="sy" style="color:Red;">200</span>字</span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            </div>
    </div>

    <div class="btn">
        <table width="100%" border="0" cellspacing="0">
            <tr style="text-align: center">
                <td class="btn1"><a href="shopping.html"><input type="button" value="加入购物车" class="btn2"></a></td>
        </table>
    </div>
    <div class="kb"></div>
    
<!--    <table width="100%" border="0" cellspacing="0" class="nav">-->
<!--    	<tr>-->
<!--        	<td width="25" class="foot"><a href="index.html"><img src="/Public/img/11.png" width="40%" height="auto"/><p>外卖</p></a></td>-->
<!--            <td width="25" class="foot"><a href="classify.html"><img src="/Public/img/2.png" width="40%" height="auto"/><p><span>分类</span></p></a></td>-->
<!--            <td width="25" class="foot"><a href="shopping.html"><img src="/Public/img/33.png" width="40%" height="auto"/><p>购物车</p></a></td>-->
<!--            <td width="25" class="foot"><a href="member.html"><img src="/Public/img/44.png" width="40%" height="auto"/><p>我的</p></a></td>-->
<!--        </tr>-->

<!--    </table>-->
<!--    <div class="kb"></div>-->
</body>
<script>
    //店铺提交验证
    $('#form_val').validate({
        rules:{
            content: {
                required: true,
                minlength: 1,
                maxlength: 200,
            }
        },
        messages:{
            content:{
                required:"必须填写用户名" ,
                minlength:"用户名长度小于1位",
                maxlength:"用户名长度大于200位",

            }
        },
//配置成功提示样式
        errorElement: "div",
        success: function(div) {
            div.addClass("ok").html('验证通过');
        },
        validClass: "ok",
    })

    /*字数限制*/
    function checkLength(which) {
        var maxChars = 100; //
        if(which.value.length > maxChars){
            layer.open({
                icon:2,
                title:'提示!!!',
                content:'您输入的字数超过限制!',
            });
            // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
            which.value = which.value.substring(0,maxChars);
            return false;
        }else{
            var curr = maxChars - which.value.length; //250 减去 当前输入的
            document.getElementById("sy").innerHTML = curr.toString();
            return true;
        }
    };

    //选项卡
    $('.order .title-list li').click(function(){
        //划过哪个选项，哪个选项高亮显示 ，而其它的选项取消高亮显示
        $(this).addClass('active').siblings('li').removeClass('active');
        //取出划过选项卡的下标
        var i=$(this).index();
        // console.log($('#menutabs'+i));
        //通过下标找到对应的商品
        $('#menutabs'+i).css('display','block').siblings('div').css('display','none');
    });

    //分页--店铺评论
    function comment(page,url){
        var page=page?page:1;
        alert(page);
        $.get(url,{"page":page,'type':'comment'},function(res){
            $('#menutabs1').html(res);
        })
    }

    //删除--添加--店铺收藏
    $('#collection-add-del').click(function () {
        var me=this;
        $.get($(me).attr('href'),function(data){
            if(data.stats === 'add'){
                layer.open({
                    style: 'width:15em;height:7em;border:none; background-color:#ff8880; color:#fff;font-size:18px;text-align:center;',
                    content:'收藏成功',
                    time:2
                })
                // $('#coll_num').text(parseInt($('#coll_num').text()+1);
                $('#coll_num').text(data.num)
            }else if(data.stats === 'error'){
                layer.open({
                    style: 'width:15em;height:7em;border:none;background-color:#ff8880; color:#fff;font-size:18px;text-align:center;',
                    content:'取消收藏',
                    time:2
                })
                $('#coll_num').text(data.num)
            }else{
                location = "<?php echo U('Home/Login/index');?>";
            }
        });
        //阻止超链接默认行为
        return false;
    });

    //店铺留言---未登录者跳转登录页面
    $('#guestbook_add').click(function(){
        if ("<?php echo session('?mid');?>"){
            $.post('<?php echo U("/Home/Shop/guest_book",array("sid"=> $ShopOne["id"]));?>', $('#form_adds').serialize(), function (data) {
                //判断是否登录成功
                if (data.status === 'ok') {
                    layer.open({
                        style: 'width:15em;height:7em;border:none; background-color:#ff8880; color:#fff;font-size:18px;text-align:center;',
                        content:'提交成功',
                        time:2
                    })
                } else {
                    layer.open({
                        style: 'width:15em;height:7em;border:none; background-color:#ff8880; color:#fff;font-size:18px;text-align:center;',
                        content:'提交失败',
                        time:2
                    })
                }
            }, 'json')
        }else{
            location = "<?php echo U('Home/Login/login');?>";
        }
        return false;
    });
</script>
</html>