<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/public.css">
    <title>添加团购</title>
    <script type="text/javascript" src="/merchant/style/js/jquery.1.10.1.min.js"></script>
    <script src="/js/layer/layer.js" type="text/javascript"></script>
    <script type="text/javascript" src="/merchant/style/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/js/laydate/laydate.js"></script>

    <style>
        tr td{
            margin-right: 10px;
            text-align:center;
        }
        .xuhao{
            width:50px;
        }

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

</head>
<body>
    <div id="show" class="add_box add_box_1">
        <dl class="shan_detail">
            <dd>团购名称：<?php echo e($shan -> shan_name); ?></dd>
            <dd>团购人数：<?php echo e($shan -> shan_num); ?></dd>

            <dd>团购价格：<?php echo e($shan -> shan_price); ?></dd>
            <dd>团购简介：<?php echo e($shan -> shan_detail); ?></dd>
            <table class='menu_list'>
                <tr>

                    <td class='xuhao'>序号</td>
                    <td>图片</td>
                    <td>菜名</td>
                    <td>价格</td>
                </tr>
                <?php $__empty_1 = true; $__currentLoopData = $sg_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class='xuhao'><?php echo e($k+1); ?></td>
                        <td><img style="width:50px;" src="/<?php echo e($v -> image_dir); ?>100_<?php echo e($v-> image); ?>" alt="<?php echo e($v->menu_name); ?>"></td>
                        <td><?php echo e($v -> menu_name); ?></td>
                        <td><?php echo e($v -> price); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td><h2>你还没有菜品快去添加吧</h2></td>
                    </tr>
                <?php endif; ?>
            </table>
        </dl>
        <div class='detail' style="height: 50px;">
            <div id="buttom" class="detail-1">
                <input type="button" id='change'  class="buttom" value="修改">
                <input type="button"  id="delete" class="buttom" value="删除">
                <?php if($shan -> shan_active ==1): ?>
                    <input type="button" href="<?php echo e(route('merchant.shop.shanActive',["sg_id"=>$shan->id,"active"=>$shan->shan_active])); ?>" id="active" style="background:#0F0;"  class="buttom" value="激活">
                <?php else: ?>
                    <input type="button" href="<?php echo e(route('merchant.shop.shanActive',["sg_id"=>$shan->id,"active"=>$shan->shan_active])); ?>" id="active"  style="background:#f00;color:#fff;"  class="buttom" value="禁用">
                <?php endif; ?>
            </div>
        </div>
    </div>
    <form action="" id="form" method="post" style="display: none">
        <div class='add_box'>
            <input type="hidden" name="sg_id" value="<?php echo e($shan->id); ?>" >
            <?php echo e(csrf_field()); ?>

            <dl>
                <dd class='dd_input'>
                    <label for="shan_name">闪购名称：</label>
                    <input type="text" name="name" class="add-shan-input" id="shan_name" placeholder="请输入团购大礼包的名称" value="<?php echo e($shan-> shan_name); ?>">
                    <div class="image name"></div>
                </dd>
                <dd class='dd_input'>
                    <label for="num">闪购数量：</label>
                    <input type="text" name="num" class="add-shan-input" id="num" placeholder="每日闪购礼包数量" value="<?php echo e($shan -> shan_num); ?>">
                    <div class="image num"></div>
                </dd>

                <dd>
                    <label for="price">闪购价格：</label>
                    <input type="text" name="price"  class="add-shan-input" id="price" placeholder="请填写闪购礼包的价格" value="<?php echo e($shan -> shan_price); ?>">
                    <div class="image price"></div>
                </dd>

            </dl>

            <div>
                <p>请从下列商品中选择一个或多个加入闪购礼包中</p>
                <table calss='menu_list'>
                    <tr>
                        <td></td>
                        <td class='xuhao'>序号</td>
                        <td>图片</td>
                        <td>菜名</td>
                        <td>价格</td>
                    </tr>
                    <?php $__empty_1 = true; $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><input type="checkbox" name="chk[]" value="<?php echo e($v->id); ?>" <?php echo e(in_array($v->id,$menu_id) ? 'checked' : ''); ?>></td>
                            <td class='xuhao'><?php echo e($k+1); ?></td>
                            <td><img style="width:50px;" src="/<?php echo e($v -> image_dir); ?>100_<?php echo e($v-> image); ?>" alt="<?php echo e($v->menu_name); ?>"></td>
                            <td><?php echo e($v -> menu_name); ?></td>
                            <td><?php echo e($v -> price); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td><h2>你还没有菜品快去添加吧</h2></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>

        </div>
        <div class='detail'>
            <dl>
                <dd style="display:flex;margin-bottom:10px;align-items:center;">
                    <label for="sg_detail" style="">闪购简介：</label>
                    <textarea name="detail" cols="30" rows="3" class="add-shan-input-other" id="sg_detail"><?php echo e($shan -> shan_detail); ?></textarea>
                </dd>
                <dd>
                    <input type="submit" class="add-shan-submit" value="添加闪购" >
                </dd>
            </dl>
        </div>
    </form>
</body>
<script>
    //验证表单
    var s =$("#form").validate({
        rules: {
            name: {
                required: true,
                rangelength:[2,18] ,
            },
            num: {
                required: true,
                digits:true,
                range:[2,100]
            },

            price:{
                required :true,
                number:true,
                min:0
            },

        },
        messages: {
            name: {
                required:'闪购礼包名称为必填',
                rangelength: '长度在2到18个字符之间'
            },
            num: {
                required: '闪购礼包拼团人数为必填',
                digits:'必须为数字',
                range: '值必须在2到100之间'
            },

            price:{
                required :'闪购价格为必填',
                number: '必须为数字',
                min: '最小值为0',
            },
        },
        //配置成功提示样式
        errorElement: "div",
        success: function(div) {
            div.addClass("ok").html('验证通过');
        },
        validClass: "ok",
    });
    //修改
    $('form').submit(function(){
        //判断多选按钮是否选中
        if( $('input:checked').length <= 0 ){
            layer.msg('请选择菜品',{icon:5,shade:[0.6],time:2500});
            return false;
        }
        if(s.form()){
            //提交
            me = $(this);
            $.ajax({
                data:me.serialize(),
                type:'post',
                dataType:'json',
                success:function(data){
                    if(data.status === 'ok'){
                        layer.msg(data.msg,{icon:6,shade:[0.6],time:1500},function(){
                            parent.location.reload();
                        })
                    }else{
                        layer.msg(data.msg,{icon:5,shade:[0.6],time:2500})
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

        }
        return false;
    })

    //删除
    $('#delete').click(function(){
        layer.confirm('确认删除？',{ btn:['确认','取消'] , icon:3, title:'删除提示' },
            function(){
                $.get('<?php echo e(route('merchant.shop.shanDelete',['sg_id'=> $shan->id])); ?>','',function(data){
                    if(data.status == 'ok'){
                        // alert('a');
                        parent.location.reload();
                        parent.layer.closeAll();
                    }else{
                        layer.msg(data.msg,{icon:5})
                    }
                })
            }
        )

    });
    //闪购的激活和禁用
    $('#active').click(function(){
        me = $(this);
        $.get(me.attr('href'),'',function(data){
            if(data.status === 'ok'){
                if(data.active == 1 ){
                    //激活
                    me.val('激活').attr('style','background:#0F0;')
                }else{
                    //禁用
                    me.val('禁用').attr('style','background:#f00;color:#fff;')
                }
                layer.msg(data.msg,{icon:6});
                parent.location.reload();
                me.attr('href',data.url)
            }else{
                console.log('aa');
                layer.msg(data.msg,{icon:5})
            }
        });
        return false;
    })

    //由显示改为编辑
    $('#change').click(function(){
        $('#show').attr('style','display:none')
        $('form').show();
    });


</script>
</html>