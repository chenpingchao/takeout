<?php $__env->startSection('header'); ?>
<head>
    <meta charset="utf-8" />
    <title>菜品详情</title>
    <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
    <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
    <meta name="author" content="DeathGhost"/>
    <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
    <link rel="Shortcut Icon" href="/image/title.ico">
    <script type="text/javascript" src="/home/js/public.js"></script>
    <script type="text/javascript" src="/home/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
    <script type="text/javascript" src="/home/js/jqpublic.js"></script>
    <style>
        ul.listpage{float: right;margin-bottom:10px; }
        .listpage a,.listpage span{ padding:5px 10px;  text-align:center; border:solid 1px #CCCCCC;}
        .listpage a:hover{background-color: #C91623;color:#fff;font-weight: bold;}
        .listpage a.current,.listpage span.current{background-color: #C91623;color:#fff;font-weight: bold;}
        .listpage span{ margin:0 10px;}

        ul.smallpic li{
            border: 1px solid #ccc;
            margin-left: 5px;
            cursor: pointer;
        }
        #showimg{
            border: 1px solid #ccd0d2;
        }
    </style>
    <script>
        $(function(){
            $('.title-list li').click(function(){
                var liindex = $('.title-list li').index(this);
                $(this).addClass('on').siblings().removeClass('on');
                $('.menutab-wrap div.menutab').eq(liindex).fadeIn(150).siblings('div.menutab').hide();
                var liWidth = $('.title-list li').width();
                $('.shopcontent .title-list p').stop(false,true).animate({'left' : liindex * liWidth + 'px'},300);
            });

            $('.menutab-wrap .menutab li').hover(function(){
                $(this).css("border-color","#ff6600");
                $(this).find('p > a').css('color','#ff6600');
            },function(){
                $(this).css("border-color","#fafafa");
                $(this).find('p > a').css('color','#666666');
            });
        });
    </script>
</head>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<!--Start content-->
<section class="slp">
 <section class="food-hd">
  <div class="foodpic">
   <img src="/<?php echo e($menu_msg -> image_dir); ?>350_<?php echo e($menu_msg -> image); ?>" id="showimg">
    <ul class="smallpic">
     <li><img src="/<?php echo e($menu_msg -> image_dir); ?>100_<?php echo e($menu_msg -> image); ?>" onclick="show('/<?php echo e($menu_msg -> image_dir); ?>350_<?php echo e($menu_msg -> image); ?>')"></li>
        <?php $__empty_1 = true; $__currentLoopData = $menu_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <li><img src="/<?php echo e($v -> image_dir); ?>100_<?php echo e($v -> image); ?>" onclick="show('/<?php echo e($v -> image_dir); ?>350_<?php echo e($v -> image); ?>')" ></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
    </ul>
  </div>
  <div class="foodtext">
   <div class="foodname_a"  style="margin:10px;">
    <h1><?php echo e($menu_msg -> menu_name); ?></h1>

   </div>
   <div class="price_a">
    <p class="price01">促销：￥<span><?php echo e($menu_msg -> price); ?></span></p>
    <p class="price02">价格：￥<s><?php echo e($menu_msg -> or_price); ?></s></p>
   </div>
   <div class="Freight">

   </div>
   <ul class="Tran_infor" style="margin-top:20px;">
     <li>
      <p class="Numerical"><?php echo e($month_num); ?></p>
      <p>月销量</p>
     </li>
     <li class="line">
      <p class="Numerical"><?php echo e($menu_msg -> eval_num); ?></p>
      <p>累计评价</p>
     </li>
   </ul>
   <form action="" method="post" id="form1">
       <?php echo e(csrf_field()); ?>

       <div class="BuyNo">
        <span>我要买：
            <input type="number" name="Number" required autofocus min="1" value="1"/>份
        </span>
        <div class="Buybutton">
            <input name="" type="submit" value="加入购物车" class="BuyB">
            <a href="<?php echo e(route('home.shopDetail',['sid' => $menu_msg->sid ])); ?>"><span class="Backhome">进入店铺首页</span></a>
        </div>
       </div>
   </form>
  </div>

  <div class="viewhistory">
   <span class="VHtitle">看了又看</span>
   <ul class="Fsulist">
    <li>
     <a href="detailsp.html" target="_blank" title="酱爆茄子"><img src="/home/upload/03.jpg"></a>
     <p>酱爆茄子</p>
     <p>￥12.80</p>
    </li>
    <li>
     <a href="detailsp.html" target="_blank" title="酱爆茄子"><img src="/home/upload/02.jpg"></a>
     <p>酱爆茄子</p>
     <p>￥12.80</p>
    </li>
   </ul>
  </div>
 </section>
 <!--bottom content-->
 <section class="Bcontent">
  <article>
   <div class="shopcontent">
  <div class="title2 cf">
    <ul class="title-list fr cf ">
      <li class="on">详细说明</li>
      <li >评价详情（<?php echo e($menu_msg -> eval_num); ?>）</li>
      <p><b></b></p>
    </ul>
  </div>
  <div class="menutab-wrap">
    <!--case1-->
    <div class="menutab show">
      <div class="cont_padding">
      <?php echo $menu_msg -> detail; ?>

      </div>
    </div>
    <!--case2-->
    <div class="menutab" id="menus-comments-list">
     <div class="cont_padding">
      <table class="Dcomment">
       <th width="80%">评价内容</th>
       <th width="20%" style="text-align:right">评价人</th>
       <?php $__empty_1 = true; $__currentLoopData = $menu_eval; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
       <tr>
       <td>
       <span>
           <a href="javascript:;" onclick="Guestbook_iew('<?php echo e($v->username); ?>','<?php echo e($v->detail); ?>','<?php echo e($v->reply); ?>')" style="color: #ff2f2f;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:3;">
            <?php echo e(mb_substr($v -> detail , 0 ,150)); ?><?php echo e(strlen($v -> detail) > 150 ? '...' : ''); ?>

           </a>
       </span>
        <time><?php echo e(date('Y-m-d H:i:s')); ?></time><span>(<?php echo e(empty($v -> reply) ? '未回复' : '已回复'); ?>)</span>
       </td>
       <td align="right"><span style="color: #a31;"><?php echo e($v -> username); ?></span></td>
       </tr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
           <tr>
               <td colspan="2">还没有人评论</td>
           </tr>
          <?php endif; ?>
      </table>
     </div>
        <ul class="am-pagination am-pagination-right listpage">
            <?php echo $show; ?>

        </ul>
    </div>
       <div id="Guestbook" style="display:none;text-indent: 2em">
           <div class="content_style">
               <div class="form-group">
                   <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="font-weight: bold;font-size: 16px">评论用户: </label>
                   <div class="username-one col-sm-9" style="color: #a31;line-height: 3em"></div>
               </div>
               <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="font-weight: bold;font-size: 16px"> 评论内容: </label>
                   <div class="content-one col-sm-9" style="margin-left:50px;color: #ff2f2f;line-height: 2em;font-size: 15px;width: 500px;height: 100px;border: 1px #095f8a solid"></div>
               </div>
               <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="font-weight: bold;font-size: 16px"> 商家回复: </label>
                   <div class="shop-content-one col-sm-9" style="margin-left:50px;color: #ff4444;line-height: 2em;font-size: 15px;width: 500px;height: 100px;border: 1px #4f80a0 solid"></div>
               </div>
           </div>
       </div>
   </div>
  </article>
  <!--ad&other infor-->
  <aside>
   <!--广告位或推荐位-->
   <a href="#" title="广告位占位图片" target="_blank"><img src="/home/upload/2014912.jpg"></a>
  </aside>
 </section>
</section>
<!--End content-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $("#form1").submit(function(){
            me = $(this);
            $.post('<?php echo e(route('home.joinCart',['uid' =>  $menu_msg->id ])); ?>',me.serialize(),function(data){
                if( data.stats === 'ok' ){
                    layer.confirm(data.msg ,{icon:3,btn:['前往购物车','留在本页'],shade:[0.6]},
                        function(){
                            location = "<?php echo e(route('home.cart')); ?>"
                        }
                    );
                }else{
                    layer.msg( data.msg, { icon:5,shade:[0.6] } )
                }
            });
            return false;
        });

        //展示评论详情
        function Guestbook_iew(username,content,shopContent){
            var index = layer.open({
                type: 1,
                title: '评论详情',
                maxmin: true,
                shadeClose:false,
                area : ['600px' , '400px'],
                content:$('#Guestbook'),
            })

            $(".username-one").text(username);
            $('.content-one').text(content);
            $('.shop-content-one').text(shopContent);
        };

        //分页
        function search(page,url){
            var page=page?page:1;

            $.get(url,{"page":page},function(res){
                $('#menus-comments-list').html(res);
            })
        }

        //显示图
        function show(src) {
            $('#showimg').attr('src',src);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("home.public.public", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>