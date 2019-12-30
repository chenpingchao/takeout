<?php $__env->startSection('main'); ?>
 <!--Start content-->
 <section class="Cfn">
  <aside class="C-left">
   <div class="S-time">服务时间：周一~周六<time>09:00</time>-<time>23:00</time></div>
   <div class="C-time">
    <?php if($Leftindexad): ?>
     <a href="" title="">
      <img width="293" src="<?php echo e($Leftindexad->img_dir); ?><?php echo e($Leftindexad->image); ?>" alt="广告">
     </a>
    <?php endif; ?>
   </div>
  </aside>
  <div class="F-middle">
   <?php if($indexad): ?>
   <ul class="rslides f426x240">
    <li><a href="javascript:"><img width="600" src="<?php echo e($indexad->img_dir); ?><?php echo e($indexad->image); ?>"/></a></li>
    <li><a href="javascript:"><img width="600" src="<?php echo e($indexad->img_dir); ?><?php echo e($indexad->image); ?>"/></a></li>
    <li><a href="javascript:"><img width="600" src="<?php echo e($indexad->img_dir); ?><?php echo e($indexad->image); ?>"/></a></li>
   </ul>
   <?php endif; ?>
  </div>
  <aside class="N-right">
   <div class="N-title">网站新闻<i>COMPANY NEWS</i></div>

   <select style="display:none;" name="town" id="s3"></select>
   
   <script>
    setup();
    preselect('河南省');
    document.getElementById('s2').value='郑州市';
    document.getElementById('s2').onchange();
    // console.log($('#s3').find('option:gt(0)'))  地区列表
    site();
    $('#s2').change(function(){site()});
    function site(){
     $('.site').remove();
     var qu = $('#s3').find('option:gt(0)');
     var str = '';
     for(var i=0 ; i<qu.length;i++){
      str += '<dd class="site"><a href="javascript:">'+qu.eq(i).text()+'</a></dd>';
     }
     $('#select1').append(str);

    }
   </script>

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
      
      <?php $__empty_1 = true; $__currentLoopData = $scName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <a href="<?php echo e(route('H_list_shop',['shop_name'=>$sc->sc_name])); ?>"><?php echo e($sc->sc_name); ?></a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <h2>暂无店铺菜品信息</h2>
      <?php endif; ?>
      <span><a><<&nbsp;&nbsp;&nbsp;&nbsp;店铺分类</a></span>
     </p>

    </ul>
    <div id="Indexcontent">
     <ul style="display:block;">
      <li>
       
       <div class="SCcontent">
         <?php $__empty_1 = true; $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
           <a href="<?php echo e(route('home.menuDetail',['uid' => $u->id ])); ?>" target="_blank" title="<?php echo e($u -> menu_name); ?>">
             <figure>
               <img src="<?php echo e($u->image_dir); ?><?php echo e($u->image); ?>">
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
      </li>
     </ul>
     <ul>
      <li>
       <div class="DCcontent">
        
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