<?php $__env->startSection('header'); ?>
<head>
<meta charset="utf-8" />
<title>DeathGhost-用户中心</title>
<meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
<meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
<meta name="author" content="DeathGhost"/>
 <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
 <link rel="Shortcut Icon" href="/image/title.ico">
 <link href="/js/preview/preview.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="/home/style/style.css"></script>
 <script type="text/javascript" src="/home/js/public.js"></script>
 <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
 <script type="text/javascript" src="/js/preview/preview.js"></script>
 <script type="text/javascript" src="/home/js/jqpublic.js"></script>
 <script src="/admin/assets/layer/layer.js" type="text/javascript"></script>
 <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
 <script src="/js/jquery.validate.min.js"></script>
 <script src="/home/js/geo.js" type="text/javascript"></script>
<!--
Author: DeathGhost
Author URI: http://www.deathghost.cn
-->
 <style>
  #add_tab td{
   position: relative;
   height:35px;
   font-weight: bold;
   font-size:15px;
  }
  #add_tab td input{
   border: 1px solid #dddddd;
  }
  form input.error{
   border: 1px solid #FF0000;
   background-color: #ffcaca;
  }
  form span.error{
   position: absolute;
   top:7px;
   height:25px;
   line-height: 25px;
   margin-left:10px;
   z-index: 10;
   color:red;
   font-weight: bold;
   font-size:12px;
  }
  form span.ok{
   color:green;
  }
 </style>
</head>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<!--Start content-->
<section class="Psection MT20">
<nav class="U-nav Font14 FontW">
  <ul>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserCenter')); ?>">用户中心首页</a></li>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserOrder')); ?>">我的订单</a></li>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserAddress')); ?>">收货地址</a></li>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserMessage')); ?>">我的留言</a></li>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserCoupon')); ?>">我的优惠券</a></li>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserFavorites')); ?>">我的收藏</a></li>
   <li><i></i><a href="<?php echo e(route('hm.mem.UserAccount')); ?>">账户管理</a></li>
   <li><i></i><a href="<?php echo e(route('home.logout')); ?>">安全退出</a></li>
  </ul>
 </nav>
 <article class="U-article Overflow">
  <!--user Address-->
  <section class="Myaddress Overflow">
   <div>
    <a href="javascript:ovid()" id="mem-msg-add" style="background-color:#84AF9B; border-radius:8px;height:30px;width:57px;color:#F0FFFF;" class="MDtitle Font14 FontW Lineheight35">添加地址</a>
    <a href="javascript:ovid()" id="UserAddress-deletes" style="background-color:#84AF9B; border-radius:8px;height:30px;width:57px;color:#F0FFFF;" class="MDtitle Font14 FontW Lineheight35">批量删除</a>
   </div>
   <table class="Myorder">
      <thead>
      <tr>
       <th width="25px"><label><input name="chkAll" type="checkbox" class="ace"><span class="lbl"></span></label></th>
       <th width="80px">编号</th>
       <th width="180px">选择所在地</th>
       <th width="100px">街道地址</th>
       <th width="100px">收件人姓名</th>
       <th width="100px">邮政编码</th>
       <th width="180px">手机号码</th>
       <th width="100px">状态</th>
       <th width="180px">操作</th>
      </tr>
      </thead>
      <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $mem_msg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
       <tr style="text-align: center;">
        <td><label><input type="checkbox" name="chk[]" value="<?php echo e($v -> id); ?>" class="ace"><span class="lbl"></span></label></td>
        <td><?php echo e($k+1); ?></td>
        <td><?php echo e($v->location); ?></td>
        <td><?php echo e($v->site); ?></td>
        <td><?php echo e($v->name); ?></td>
        <td><?php echo e($v->Postcode); ?></td>
        <td><?php echo e($v->mobile); ?></td>
        <td><a style="background-color:#84AF9B; border-radius:3px;height:20px;width:40px;color:#F0FFFF;" class="default-active" href="<?php echo e(route('hm.mem.UserAddress_default',['id'=>$v->id,'active'=>$v->active])); ?>"><?php echo e($v->active==1 ? '默认地址' : '非默认地址'); ?></a></td>
        <td>
         <a href="javascript:ovid()" onclick="UserAddress_update('<?php echo e($v->name); ?>','<?php echo e($v->id); ?>','<?php echo e($v->site); ?>','<?php echo e($v->Postcode); ?>','<?php echo e($v->mobile); ?>')" style="background-color:#84AF9B; border-radius:3px;height:20px;width:25px;color:#F0FFFF;" title="编辑">编辑</a> |
         <a class="UserAddress-delete" href="<?php echo e(route('hm.mem.UserAddress_del',['id'=>$v->id])); ?>" style="background-color:#84AF9B; border-radius:3px;height:20px;width:25px;color:#F0FFFF;">删除</a>
        </td>
       </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
       <tr>
        <td colspan="9">
         <h3>没找到满足条件的数据</h3>
        </td>
       </tr>
      <?php endif; ?>
      </tbody>
     </table>
  </section>
  <section class="Myaddress Overflow">
   <!--add-->
   <div id="mem-msg-add-style" style="display:none;" class="add_menber">
    <form action="" id="form0" method="post">
     <?php echo e(csrf_field()); ?>

     <table id="add_tab">
      <tr>
       <td align="right" class="FontW">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</td>
       <td><input type="text" name="name" id="name1"></td>
      </tr>
      <tr>
       <td  align="right" class="FontW">所&nbsp;在&nbsp;地：</td>
       <td>
        <select name="province" id="s1"></select>
        <select name="city" id="s2"></select>
        <select name="town" id="s3"></select>
       </td>
      </tr>
      <tr>
       <td  align="right" class="FontW">街道地址：</td>
       <td><input type="text" name="site" id="site1"></td>
      </tr>
      <tr>
       <td  align="right" class="FontW">邮政编码：</td>
       <td><input type="text" name="Postcode" id="Postcode1"></td>
      </tr>
      <tr>
       <td  align="right" class="FontW">手&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机：</td>
       <td><input type="tel" name="mobile" id="mobile1"></td>
      </tr>
      <tr>
       <td style="text-align: center" colspan="2">
        <button type="button" name="" id="0" class="Submit_b" style="background-color:#2d6983;height:30px;width:80px;color:#CCCCCC;">添 加</button>
       </td>
      </tr>
     </table>
    </form>
   </div>
   <!--update-->
   <div id="mem-msg-update-style" style="display:none;" class="add_menber">
    <form action="" id="form1" method="post">
     <?php echo e(csrf_field()); ?>

     <table id="add_tab">
      <input name="id" type="text" style="display: none" class="id-one"/>
      <tr>
       <td  align="right" class="FontW">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</td>
       <td><input type="text" class="name-one" name="name" id="name2"></td>
      </tr>
      <tr>
       <td  align="right" class="FontW">所&nbsp;在&nbsp;地：</td>
       <td>
        <select name="province" id="s1"></select>
        <select name="city" id="s2"></select>
        <select name="town" id="s3"></select>
       </td>
      </tr>
      <tr>
       <td  align="right" class="FontW">街道地址：</td>
       <td><input type="text" class="site-one" name="site" id="site2"></td>
      </tr>
      <tr>
       <td  align="right" class="FontW">邮政编码：</td>
       <td><input type="text" class="Postcode-one" name="Postcode" id="Postcode2"></td>
      </tr>
      <tr>
       <td  align="right" class="FontW">手&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机：</td>
       <td><input type="tel" class="mobile-one" name="mobile" id="mobile2"></td>
      </tr>
      <tr>
       <td style="text-align: center" colspan="2">
        <button type="button" name="" id="1" class="Submit_b" style="background-color:#2d6983;height:30px;width:80px;color:#CCCCCC;">修 改</button>
       </td>
      </tr>
     </table>
    </form>
   </div>
  </section>
 </article>
</section>
<!--End content-->
<?php $__env->stopSection(); ?>
<!--另起炉灶 js-->
<?php $__env->startSection('script'); ?>
 <script>
   setup();
  preselect('河南省');
  document.getElementById('s2').value='郑州市';
  document.getElementById('s2').onchange();
  document.getElementById('s3').value='中原区';
 </script>
 <script>
  //删除
  $('.UserAddress-delete').click(function () {
   var me=this;
   parent.layer.confirm('确认要删除吗?',{icon:3,title:'删除提示'},function () {
    $.get($(me).attr('href'),'',function (data) {
     if (data.status==='ok'){
      parent.layer.msg(data.msg,{icon:6,shade:[0.6],time:1000},function () {
       $(me).closest('tr').detach();
       //     最近的  tr      分离
       location = data.url;
      })
     } else{
      parent.layer.msg(data.msg,{icon:5,shade:[0.6]})
     }
    },'json')
   });
   //阻止超链接默认行为
   return false;
  });

  //全选全不选
  $('input[name="chkAll"]').click(function(){
   $('input[name="chk[]"]').prop('checked',$(this).prop('checked'));
   //name         //val
  });
  $('input[name="chk[]"]').click(function(){  //点击核实 chk
   $('input[name="chkAll"]').prop('checked',$(this).prop('checked'));
  });

  //管理员批量删除  chk
  $('#UserAddress-deletes').click(function(){
   var me = this;
   parent.layer.confirm('确定要删除吗?',{icon:3,title:'删除提示'},function(){
    $.post($(me).attr('href'),$('form').serialize(),function(data){
     if (data.status==='ok'){
      parent.layer.msg(data.msg,{icon:6,shade:[0.6],time:1000},function () {
       $('input[name="chk[]"]').closest('tr').detach();
       location = data.url;
      });
     } else{
      parent.layer.msg(data.msg,{icon:5,shade:[0.6]})
     }
    },'json');
   });
   //阻止超链接的默认行为
   return false;
  });
 </script>
 <script>
  $('.default-active').click(function(){
   var me = this;
   $.get($(this).attr('href'),'',function(data){
    if (data.status==='ok'){
     //激活成功
     $(me).text(data.text).attr('href',data.href);    //成功应该干啥{----}
     layer.tips(data.msg,me,{tips:[1,'#090'],time:2000,success:function(){
       location.reload();}
     });
    } else{
     //激活失败
     layer.tips(data.msg,me,{tips:[1,'#900']});
    }
   },'json');
   //阻止超链接的默认行为
   return false;
  });

  //添加
  $('#mem-msg-add').click(function(){
    layer.open({
     type: 1,
     title:'添加地址', //标题
     shade: false, //不显示遮罩
     skin: 'layui-layer-rim',
     area: ['420px', '270px'], //宽高
     // shadeClose: false,
     content: $('#mem-msg-add-style') //可以用jQuery选择器
    });
  });
  //修改
  function UserAddress_update(name,id,site,Postcode,mobile){
   layer.open({
    type: 1,
    title:'修改地址', //标题
    shade: false, //不显示遮罩
    skin: 'layui-layer-rim',
    area: ['420px', '270px'], //宽高
    // shadeClose: false,
    content: $('#mem-msg-update-style')  //可以用jQuery选择器
   })
   $(".name-one").val(name);
   $('.id-one').val(id);
   $('.site-one').val(site);
   $('.Postcode-one').val(Postcode);
   $('.mobile-one').val(mobile);
  };

  //添加验证规则--form0
  var myvalidate0=$('#form0').validate({
   //配置验证规则
   rules:{
    name:{  //规则名称是表单元素的name属性值
     required:true
    },
    site:{
     required:true
    },
    Postcode:{
     required:true,
     isZipCode:true
    },
    mobile:{
     required:true,
     mobile:true
    },
   },
   //配置提示信息
   messages:{
    name:{  //规则名称是表单元素的name属性值
     required:'姓名不能为空',
    },
    site:{
     required:'街道地址不能为空',
    },
    Postcode:{
     required:'邮编地址不能为空',
    },
    mobile:{
     required:'手机号不能为空',
     mobile:"请正确填写您的手机号码"
    }
   },
   //配置成功提示样式
   errorElement: "span",
   success: function(span) {
    span.addClass("ok").html('验证通过');
   },
   validClass: "ok"
  });
  //修改验证规则--form1
  var myvalidate1=$('#form1').validate({
   //配置验证规则
   rules:{
    name:{  //规则名称是表单元素的name属性值
     required:true
    },
    site:{
     required:true
    },
    Postcode:{
     required:true,
     isZipCode:true
    },
    mobile:{
     required:true,
     mobile:true
    },
   },
   //配置提示信息
   messages:{
    name:{  //规则名称是表单元素的name属性值
     required:'姓名不能为空',
    },
    site:{
     required:'街道地址不能为空',
    },
    Postcode:{
     required:'邮编地址不能为空',
    },
    mobile:{
     required:'手机号不能为空',
     mobile:"请正确填写您的手机号码"
    }
   },
   //配置成功提示样式
   errorElement: "span",
   success: function(span) {
    span.addClass("ok").html('验证通过');
   },
   validClass: "ok"
  });
  //自定义手机号码规则
  jQuery.validator.addMethod("mobile", function(value, element) {  //mobile为自定义规则的名称
   var mobileReg = /^1[34578][0-9]{9}$/;
   return this.optional(element) || (mobileReg.test(value));
  },"请您正确填写您的手机号码");
  //自定义邮政编码
  jQuery.validator.addMethod("isZipCode", function(value, element) {
   var tel = /^[0-9]{6}$/;
   return this.optional(element) || (tel.test(value));
  }, "请正确填写您的邮政编码");

  //表单提交 button--ID .Submit_b 点击提交
  $('.Submit_b').click(function(){   //submit按钮方式提交
   var id=$(this).attr('id');
   //通过id判断是哪个前端验证
   if (id == 0){
    myvalidate=myvalidate0;
   } else if(id == 1){
    myvalidate=myvalidate1;
   }
   if(myvalidate.form()){ //判断前端验证是否通过
     if (id == 0){//判断 添加
      $.post('<?php echo e(route("hm.mem.UserAddress_add")); ?>',$('#form'+id).serialize(),function(data){
       //判断是否成功
       if(data.status === 'ok'){
        layer.msg(data.msg,{icon:1, time:1000, shade:[0.6]},function(){
         location.href=data.url;
        })
       }else{
        layer.msg(data.msg,{icon:2,time:2000,shade:[0.6]})
       }
      },'json')
     } else if (id == 1){//更新
      $.post('<?php echo e(route("hm.mem.UserAddress_update")); ?>',$('#form'+id).serialize(),function(data){
       //判断是否成功
       if(data.status === 'ok'){
        layer.msg(data.msg,{icon:1, time:1000, shade:[0.6]},function(){
         location.href=data.url;
        })
       }else{
        layer.msg(data.msg,{icon:2,time:2000,shade:[0.6]})
       }
      },'json')
     }
   }
   });

 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.public.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>