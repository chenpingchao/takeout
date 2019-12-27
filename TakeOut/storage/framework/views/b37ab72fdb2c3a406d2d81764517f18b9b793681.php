<?php $__env->startSection('main'); ?>
 <!--Start content-->
 <section class="Cfn">
  <aside class="C-left">
   <div class="S-time">服务时间：周一~周六<time>09:00</time>-<time>23:00</time></div>
   <div class="C-time">
    <img src="/home/upload/dc.jpg"/>
   </div>
   <a href="list.html" target="_blank"><img src="/home/images/by_button.png"></a>
   <a href="list.html" target="_blank"><img src="/home/images/dc_button.png"></a>
  </aside>
  <div class="F-middle">
   <ul class="rslides f426x240">
    <li><a href="javascript:"><img src="/home/upload/01.jpg"/></a></li>
    <li><a href="javascript:"><img src="/home/upload/02.jpg" /></a></li>
    <li><a href="javascript:"><img src="/home/upload/03.jpg"/></a></li>
   </ul>
  </div>
  <aside class="N-right">
   <div class="N-title">公司新闻 <i>COMPANY NEWS</i></div>
   <ul class="Newslist">
    <li><i></i><a href="" target="_blank" title="这里调用新闻标题...">欢迎访问DeathGhost博客站...</a></li>
    <li><i></i><a href="" target="_blank" title="这里调用新闻标题...">H5WEB前端开发 移动WEB模板设计...</a></li>
   </ul>
   <ul class="Orderlist">
    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <li>
     <p>订单编号：<?php echo e($v->orders_num); ?></p>
     <p>收件人：<?php echo e($v->username); ?></p>
     <p>订单状态：<i class="State01">
       <?php switch($v->active):
        case (1): ?>
        未付款
        <?php break; ?>
        <?php case (2): ?>
        已付款
        <?php break; ?>
        <?php case (3): ?>
        已发货
        <?php break; ?>
        <?php case (4): ?>
        已签收
        <?php break; ?>
        <?php case (5): ?>
        已评论
        <?php break; ?>
        <?php default: ?>
       <?php endswitch; ?>
      </i></p>
    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
     <li class="Orderlist">
      <p>∑(っ°Д°;)っ卧槽，不见了</p>
     </li>
    <?php endif; ?>
   </ul>
   <script>
    var UpRoll = document.getElementById('UpRoll');
    var lis = UpRoll.getElementsByTagName('li');
    var ml = 0;
    var timer1 = setInterval(function(){
     var liHeight = lis[0].offsetHeight;
     var timer2 = setInterval(function(){
      UpRoll.scrollTop = (++ml);
      if(ml ==1){
       clearInterval(timer2);
       UpRoll.scrollTop = 0;
       ml = 0;
       lis[0].parentNode.appendChild(lis[0]);
      }
     },10);
    },5000);
   </script>
  </aside>
 </section>
 <section class="Sfainfor">
  <article class="Sflist">
   <div id="Indexouter">
    <ul id="Indextab">
     <li class="current">点菜</li>
     <li>餐馆</li>
     <p class="class_B">
      <a href="#">中餐</a>
      <a href="#">西餐</a>
      <a href="#">甜点</a>
      <a href="#">日韩料理</a>
      <span><a href="#" target="_blank">more ></a></span>
     </p>
    </ul>
    <div id="Indexcontent">
     <ul style="display:block;">
      <li>
       <p class="seekarea">
        <a href="#">碑林区</a>
        <a href="#">新城区</a>
        <a href="#">未央区</a>
        <a href="#">雁塔区</a>
        <a href="#">莲湖区</a>
        <a href="#">高新区</a>
        <a href="#">灞桥区</a>
        <a href="#">高陵区</a>
        <a href="#">阎良区</a>
        <a href="#">临潼区</a>
        <a href="#">长安区</a>
        <a href="#">周至县</a>
        <a href="#">蓝田县 </a>
       </p>
       
       <div class="SCcontent">
         <?php $__empty_1 = true; $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
           <a href="<?php echo e(route('home.menuDetail',['uid' => $u->id ])); ?>" target="_blank" title="<?php echo e($u -> menu_name); ?>">
             <figure>
               <img src="/home/upload/05.jpg">
               <figcaption>
                <span class="title"><?php echo e($u -> menu_name); ?></span>
                <span class="price"><i>￥</i><?php echo e($u -> price); ?></span>
               </figcaption>
             </figure>
           </a>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <h2>暂无好吃的菜品信息</h2>
        <?php endif; ?>
       </div>

       
       <div class="bestshop">
         <?php $__empty_1 = true; $__currentLoopData = $shop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
         <a href="<?php echo e(route('home.shopDetail',['sid' => $s->id ])); ?>" target="_blank" title="<?php echo e($s -> name); ?>">
          <figure>
           <img src="<?php echo e($s -> logo); ?>">
          </figure>
         </a>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <h2>暂无达到要求的店铺</h2>
        <?php endif; ?>
       </div>
      </li>
     </ul>
     <ul>
      <li>
       <p class="seekarea">
        <a href="#">碑林区</a>
        <a href="#">新城区</a>
        <a href="#">未央区</a>
        <a href="#">雁塔区</a>
        <a href="#">莲湖区</a>
        <a href="#">高新区</a>
        <a href="#">灞桥区</a>
        <a href="#">高陵区</a>
        <a href="#">阎良区</a>
        <a href="#">临潼区</a>
        <a href="#">长安区</a>
        <a href="#">周至县</a>
        <a href="#">蓝田县 </a>
       </p>
       <div class="DCcontent">
        <a href="shop.html" target="_blank" title="TITLE:店名">
         <figure>
          <img src="/home/upload/cc.jpg">
          <figcaption>
           <span class="title">老重庆川菜馆</span>
           <span class="price">预定折扣：<i>8.9折</i></span>
          </figcaption>
          <p class="p1"><q>仅售169元！价值289元的4-5人餐，提供免费WiFi。</q></p>
          <p class="p2">
           店铺评分：
           <img src="/home/images/star-on.png">
           <img src="/home/images/star-on.png">
           <img src="/home/images/star-on.png">
           <img src="/home/images/star-on.png">
           <img src="/home/images/star-off.png">
          </p>
          <p class="p3">店铺地址：西安市雁塔区丈八路***老重庆川菜馆...</p>
         </figure>
        </a>
        <a href="shop.html" target="_blank" title="TITLE:店名">
         <figure>
          <img src="/home/upload/cc.jpg">
          <figcaption>
           <span class="title">老重庆川菜馆</span>
           <span class="price">预定折扣：<i>8.9折</i></span>
          </figcaption>
          <p class="p1"><q>仅售169元！价值289元的4-5人餐，提供免费WiFi。</q></p>
          <p class="p2">
           店铺评分：
           <img src="/home/images/star-on.png">
           <img src="/home/images/star-on.png">
           <img src="/home/images/star-on.png">
           <img src="/home/images/star-on.png">
           <img src="/home/images/star-off.png">
          </p>
          <p class="p3">店铺地址：西安市雁塔区丈八路***老重庆川菜馆...</p>
         </figure>
        </a>
        <a href="shop.html" target="_blank" title="TITLE:店名">
         <figure>
          <img src="/home/upload/cc.jpg">
          <figcaption>
           <span class="title">老重庆川菜馆</span>
           <span class="price">预定折扣：<i>8.9折</i></span>
          </figcaption>
          <p class="p1"><q>仅售169元！价值289元的4-5人餐，提供免费WiFi。</q></p>
          <p class="p2">
           店铺评分：
           <img src="/home/images/star-on.png">
           <img src="/home/images/star-on.png">
           <img src="/home/images/star-on.png">
           <img src="/home/images/star-on.png">
           <img src="/home/images/star-off.png">
          </p>
          <p class="p3">店铺地址：西安市雁塔区丈八路***老重庆川菜馆...</p>
         </figure>
        </a>
       </div>
      </li>
     </ul>
    </div>
   </div>
  </article>
  <aside class="A-infor">

   <img src="/home/upload/2014911.jpg">
   <div class="usercomment">
    <span>用户店铺点评</span>
    <?php $__empty_1 = true; $__currentLoopData = $Guestbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <ul>
     <li>
      <img src="<?php echo e($v->logo); ?>" style="width:75px;height:75px;padding:2px;border:1px #cccccc solid;border-radius:50%;float:left;margin-right:5px;">
      用户“<?php echo e($v->username); ?>”对[ <?php echo e($v->shop_name); ?>]留言说：<?php echo e($v->content); ?>...
     </li>
    </ul>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
     <h2>∑(っ°Д°;)っ卧槽，不见了</h2>
    <?php endif; ?>
    <span>用户菜品点评</span>

    <ul>
     <?php $__empty_1 = true; $__currentLoopData = $Gcomment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
     <li>
      <img src="/<?php echo e($v->image_dir); ?><?php echo e($v->image); ?>" style="width:75px;height:75px;padding:2px;border:1px #cccccc solid;border-radius:50%;float:left;margin-right:5px;">
      用户“<?php echo e($v->username); ?>”对[ <?php echo e($v->shop_name); ?> ]“<?php echo e($v->menu_name); ?>”评论说：<?php echo e($v->detail); ?>...
     </li>
    </ul>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
     <h2>∑(っ°Д°;)っ卧槽，不见了</h2>
    <?php endif; ?>
   </div>
  </aside>
 </section>
 <!--End content-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make("home/public/public", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>