<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>网站后台管理系统  </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/admin/assets/css/font-awesome.min.css" />
    <!--[if IE 7]>
    <link rel="stylesheet" href="/admin/assets/css/font-awesome-ie7.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/admin/assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="/admin/assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="/admin/css/style.css"/>
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
    <![endif]-->
    <script src="/admin/assets/js/ace-extra.min.js"></script>
    <!--[if lt IE 9]>
    <script src="/admin/assets/js/html5shiv.js"></script>
    <script src="/admin/assets/js/respond.min.js"></script>
    <![endif]-->
    <!--[if !IE]> -->
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <!-- <![endif]-->
    <!--[if IE]>
    <script type="text/javascript">window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"script>");</script>
    <![endif]-->
    <script type="text/javascript">
        if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
    </script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <!--[if lte IE 8]>
    <script src="/admin/assets/js/excanvas.min.js"></script>
    <![endif]-->
    <script src="/admin/assets/js/ace-elements.min.js"></script>
    <script src="/admin/assets/js/ace.min.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript"></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/js/jquery.nicescroll.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function(){
            var cid = $('#nav_list> li>.submenu');
            cid.each(function(i){
                $(this).attr('id',"Sort_link_"+i);

            })
        })
        jQuery(document).ready(function(){
            $.each($(".submenu"),function(){
                var $aobjs=$(this).children("li");
                var rowCount=$aobjs.size();
                var divHeigth=$(this).height();
                $aobjs.height(divHeigth/rowCount);
            });
            //初始化宽度、高度

            $("#main-container").height($(window).height()-76);
            $("#iframe").height($(window).height()-140);

            $(".sidebar").height($(window).height()-99);
            var thisHeight = $("#nav_list").height($(window).outerHeight()-173);
            $(".submenu").height();
            $("#nav_list").children(".submenu").css("height",thisHeight);

            //当文档窗口发生改变时 触发
            $(window).resize(function(){
                $("#main-container").height($(window).height()-76);
                $("#iframe").height($(window).height()-140);
                $(".sidebar").height($(window).height()-99);

                var thisHeight = $("#nav_list").height($(window).outerHeight()-173);
                $(".submenu").height();
                $("#nav_list").children(".submenu").css("height",thisHeight);
            });
            $(document).on('click','.iframeurl',function(){
                var cid = $(this).attr("name");
                var cname = $(this).attr("title");
                $("#iframe").attr("src",cid).ready();
                $("#Bcrumbs").attr("href",cid).ready();
                $(".Current_page a").attr('href',cid).ready();
                $(".Current_page").attr('name',cid);
                $(".Current_page").html(cname).css({"color":"#333333","cursor":"default"}).ready();
                $("#parentIframe").html('<span class="parentIframe iframeurl"> </span>').css("display","none").ready();
                $("#parentIfour").html(''). css("display","none").ready();
            });



        });
        /******/
        $(document).on('click','.link_cz > li',function(){
            $('.link_cz > li').removeClass('active');
            $(this).addClass('active');
        });
        /*******************/
        //jQuery( document).ready(function(){
        //	  $("#submit").click(function(){
        //	// var num=0;
        //     var str="";
        //     $("input[type$='password']").each(function(n){
        //          if($(this).val()=="")
        //          {
        //              // num++;
        //			   layer.alert(str+=""+$(this).attr("name")+"不能为空！\r\n",{
        //                title: '提示框',
        //				icon:0,
        //          });
        //             // layer.msg(str+=""+$(this).attr("name")+"不能为空！\r\n");
        //             layer.close(index);
        //          }
        //     });
        //})
        //	});

        /*********************点击事件*********************/
        $( document).ready(function(){
            $('#nav_list,.link_cz').find('li.home').on('click',function(){
                $('#nav_list,.link_cz').find('li.home').removeClass('active');
                $(this).addClass('active');
            });
//时间设置
            function currentTime(){
                var d=new Date(),str='';
                str+=d.getFullYear()+'年';
                str+=d.getMonth() + 1+'月';
                str+=d.getDate()+'日';
                str+=d.getHours()+'时';
                str+=d.getMinutes()+'分';
                str+= d.getSeconds()+'秒';
                return str;
            }

            setInterval(function(){$('#time').html(currentTime)},1000);
//修改密码
            $('.change_Password').on('click', function(){
                layer.open({
                    type: 1,
                    title:'修改密码',
                    area: ['300px','300px'],
                    shadeClose: true,
                    content: $('#change_Pass'),
                    btn:['确认修改'],
                    yes:function(index, layero){
                        if ($("#password").val()==""){
                            layer.alert('原密码不能为空!',{
                                title: '提示框',
                                icon:0,

                            });
                            return false;
                        }
                        if ($("#Nes_pas").val()==""){
                            layer.alert('新密码不能为空!',{
                                title: '提示框',
                                icon:0,

                            });
                            return false;
                        }

                        if ($("#c_mew_pas").val()==""){
                            layer.alert('确认新密码不能为空!',{
                                title: '提示框',
                                icon:0,

                            });
                            return false;
                        }
                        if(!$("#c_mew_pas").val || $("#c_mew_pas").val() != $("#Nes_pas").val() )
                        {
                            layer.alert('密码不一致!',{
                                title: '提示框',
                                icon:0,

                            });
                            return false;
                        }
                        else{
                            layer.alert('修改成功！',{
                                title: '提示框',
                                icon:1,
                            });
                            layer.close(index);
                        }
                    }
                });
            });
            $('#Exit_system').on('click', function(){
                layer.confirm('是否确定退出系统？', {
                        btn: ['是','否'] ,//按钮
                        icon:2,
                    },
                    function(){
                        location.href="login.html";

                    });
            });
        });
        function link_operating(name,title){
            var cid = $(this).name;
            var cname = $(this).title;
            $("#iframe").attr("src",cid).ready();
            $("#Bcrumbs").attr("href",cid).ready();
            $(".Current_page a").attr('href',cid).ready();
            $(".Current_page").attr('name',cid);
            $(".Current_page").html(cname).css({"color":"#333333","cursor":"default"}).ready();
            $("#parentIframe").html('<span class="parentIframe iframeurl"> </span>').css("display","none").ready();
            $("#parentIfour").html(''). css("display","none").ready();


        }
    </script>
</head>
<body>

<ul class="nav nav-list" id="nav_list">
    <li class="home"><a href="<?php echo e(route('bg.main')); ?>" target="iframe" name="home.html" class="iframeurl" title=""><i class="icon-home"></i><span class="menu-text"> 系统首页 </span></a></li>
    <li><a href="#" class="dropdown-toggle"><i class="icon-desktop"></i><span class="menu-text"> 菜品管理 </span><b class="arrow icon-angle-down"></b></a>
        <ul class="submenu">
            <li class="home"><a href="<?php echo e(route('admin.menu.list')); ?>" target="iframe" title="菜品列表" class="iframeurl"><i class="icon-double-angle-right"></i>菜品列表</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="dropdown-toggle"><i class="icon-picture "></i><span class="menu-text"> 图片管理 </span><b class="arrow icon-angle-down"></b></a>
        <ul class="submenu">
            <li class="home"><a href="<?php echo e(route('bg.advertis.index')); ?>" target="iframe" name="advertis" title="广告管理" class="iframeurl"><i class="icon-double-angle-right"></i>广告管理</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="dropdown-toggle"><i class="icon-list"></i><span class="menu-text"> 交易管理 </span><b class="arrow icon-angle-down"></b></a>
        <ul class="submenu">
            <li class="home"><a href="<?php echo e(route('bg.orders.index')); ?>" target="iframe" name="transaction.html" title="交易信息"  class="iframeurl"><i class="icon-double-angle-right"></i>交易信息</a></li>

            <li class="home"><a href="<?php echo e(route("bg.orders.order")); ?>" target="iframe" name="Orderform.html" title="订单管理"  class="iframeurl"><i class="icon-double-angle-right"></i>订单管理</a></li>
            <li class="home"><a href="<?php echo e(route("bg.orders.price")); ?>" target="iframe" name="Amounts.html" title="交易金额"  class="iframeurl"><i class="icon-double-angle-right"></i>交易金额</a></li>

            <li class="home"><a href="<?php echo e(route("bg.orders.returns")); ?>" target="iframe" name="Refund.html" title="退款管理"  class="iframeurl"><i class="icon-double-angle-right"></i>退款管理</a></li>
        </ul>
    </li>








    <li>
        <a href="#" class="dropdown-toggle"><i class="icon-user"></i><span class="menu-text"> 会员管理 </span><b class="arrow icon-angle-down"></b></a>
        <ul class="submenu">
            <li class="home"><a href="<?php echo e(route('admin.member.list')); ?>" target="iframe" title="会员列表"  class="iframeurl"><i class="icon-double-angle-right"></i>会员列表</a></li>
            <li class="home"><a href="<?php echo e(route('admin.member.memberGrade')); ?>" target="iframe" title="会员等级"  class="iframeurl"><i class="icon-double-angle-right"></i>会员等级</a></li>
            <li class="home"><a href="<?php echo e(route('admin.member.grade')); ?>" target="iframe" title="等级管理"  class="iframeurl"><i class="icon-double-angle-right"></i>等级管理</a></li>
        </ul>
    </li>
    <li><a href="#" class="dropdown-toggle"><i class="icon-laptop"></i><span class="menu-text"> 店铺管理 </span><b class="arrow icon-angle-down"></b></a>
        <ul class="submenu">
            <li class="home"><a href="<?php echo e(route('admin.shopcate.list')); ?>" target="iframe" title="店铺分类"  class="iframeurl"><i class="icon-double-angle-right"></i>店铺分类</a></li>
            <li class="home"><a href="<?php echo e(route('bg.shop.list')); ?>" target="iframe" name="Shop_list.html" title="店铺列表" class="iframeurl"><i class="icon-double-angle-right"></i>店铺列表</a></li>
            <li class="home"><a href="<?php echo e(route('bg.shop.member')); ?>" target="iframe" name="Shop_list.html" title="店铺持有人" class="iframeurl"><i class="icon-double-angle-right"></i>店铺持有人</a></li>
            <li class="home"><a href="<?php echo e(route('bg.shop.audit')); ?>" target="iframe" name="Shops_Audit.html" title="店铺审核" class="iframeurl"><i class="icon-double-angle-right"></i>店铺审核</a></li>
        </ul>
    </li>
    <li><a href="#" class="dropdown-toggle"><i class="icon-comments-alt"></i><span class="menu-text"> 消息管理 </span><b class="arrow icon-angle-down"></b></a>
        <ul class="submenu">
            <li class="home"><a href="<?php echo e(route('bg.mess.Guestbook')); ?>" target="iframe" name="Guestbook.html" title="留言列表" class="iframeurl"><i class="icon-double-angle-right"></i>留言列表</a></li>
            <li class="home"><a href="<?php echo e(route('bg.mess.Feedback')); ?>" target="iframe" name="Feedback.html" title="意见反馈" class="iframeurl"><i class="icon-double-angle-right"></i>意见反馈</a></li>
        </ul>
    </li>
    <li><a href="#" class="dropdown-toggle"><i class="icon-bookmark"></i><span class="menu-text"> 文章管理 </span><b class="arrow icon-angle-down"></b></a>
        <ul class="submenu">
            <li class="home"><a href="<?php echo e(route('bg.article.list')); ?>" target="iframe" name="article_list.html" title="文章列表" class="iframeurl"><i class="icon-double-angle-right"></i>文章列表</a></li>
            <li class="home"><a href="<?php echo e(route('bg.article.sort')); ?>" target="iframe" name="article_Sort.html" title="分类管理" class="iframeurl"><i class="icon-double-angle-right"></i>分类管理</a></li>
        </ul>
    </li>
    <li><a href="#" class="dropdown-toggle"><i class="icon-cogs"></i><span class="menu-text"> 系统管理 </span><b class="arrow icon-angle-down"></b></a>
        <ul class="submenu">
            <li class="home"><a href="javascript:void(0)" name="Systems.html" title="系统设置" class="iframeurl"><i class="icon-double-angle-right"></i>系统设置</a></li>

            <li class="home"><a href="" target="iframe" name="System_section.html" title="系统栏目管理" class="iframeurl"><i class="icon-double-angle-right"></i>系统栏目管理</a></li>

            <li class="home"><a href="javascript:void(0)" name="System_Logs.html" title="系统日志" class="iframeurl"><i class="icon-double-angle-right"></i>系统日志</a></li>
        </ul>
    </li>
    <li><a href="#" class="dropdown-toggle"><i class="icon-group"></i><span class="menu-text"> 管理员管理 </span><b class="arrow icon-angle-down"></b></a>
        <ul class="submenu">

            <li class="home">
                <a href="<?php echo e(route('bg.admin.Power')); ?>" target="iframe" name="admin_Competence.html" title="权限管理"  class="iframeurl">
                    <i class="icon-double-angle-right">
                    </i>权限管理
                </a>
            </li>
            <li class="home">
                <a href="<?php echo e(route('bg.admin.list')); ?>" target="iframe" name="administrator.html" title="管理员列表" class="iframeurl">
                    <i class="icon-double-angle-right">
                    </i>管理员列表
                </a>
            </li>
            <li class="home">
                <a href="<?php echo e(route('bg.admin.info',['id'=>session('aid')])); ?>" target="iframe" name="admin_info.html" title="个人信息" class="iframeurl">
                    <i class="icon-double-angle-right">
                    </i>个人信息
                </a>
            </li>
        </ul>
    </li>
</ul>

