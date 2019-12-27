<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>编辑菜品</title>
    <link href="/admin/css/add-style.css" rel="stylesheet" type="text/css" />

    <link href="/admin/css/validate.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/js/webuploader/webuploader.css" />
    <link rel="stylesheet" type="text/css" href="/js/preview/preview.css" />
    <script type="text/javascript" src="/admin/js/jQuery.js"></script>
    <script type="text/javascript" src="/admin/js/jquery.idTabs.min.js"></script>

    <script type="text/javascript" src="/admin/js/kindeditor/kindeditor-all-min.js"></script>
    <script src="/admin/js/layer/layer.js"></script>
    <script src="/js/jquery.form.js"></script>

    <script type="text/javascript">
        $(document).ready(function(e) {
            //加载富文本编辑器
            KindEditor.ready(function(K) {
                K.create('#content', {
                    allowFileManager : true,
                    filterMode: true,
                    afterBlur: function(){  //利用该方法处理当富文本编辑框失焦之后，立即同步数据
                        this.sync("#content") ;
                    }
                });
            });
        });
    </script>
</head>

<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">编辑菜品</a></li>
    </ul>
</div>
<div  style="margin-left:100px;width: 80%"  id="validate-div" >
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <ul class="forminfo" id="goodsInfo" >
                    <li>
                        <label>商品分类<b>*</b></label>
                        <div style="float:left;margin-bottom:10px;">
                            <select  name="firstCate" style="width: 225px;opacity:100">
                                <option value="" >请选择</option>
                            </select>
                            <select  name="secondCate" style="width: 225px;opacity:100">
                                <option value="" >请选择</option>
                            </select>
                            <select  name="thirdCate" style="width: 225px;opacity:100">
                                <option value="" >请选择</option>
                            </select>
                            <div class="validate-error thirdCate" style="left:0;background: url('/image/error.png') no-repeat 5px 10px;"></div>
                        </div>
                    </li>

                    <li>
                        <label>菜品名称<b>*</b></label>
                        <input name="menu_name" type="text" class="dfinput" placeholder="请填写商品名称" value="<?php echo e($menu -> menu_name); ?>" style="width: 680px;"/>
                        <div class="validate-error menu_name" style="background: url('/image/error.png') no-repeat 5px 10px;"></div>
                    </li>
                    <li>
                        <label>菜品关键字<b>*</b></label>
                        <input name="key_words" type="text" class="dfinput" placeholder="请填写商品关键字,多个关键字用逗号隔开" value="<?php echo e($menu -> key_words); ?>" style="width: 680px;"/>
                        <div class="validate-error keywords" style="background: url('/image/error.png') no-repeat 5px 10px;"></div>
                    </li>
                    <li>
                        <label>菜品原价<b>*</b></label>
                        <input name="price" type="text" class="dfinput" placeholder="请填写商城价格" value="<?php echo e($menu -> price); ?>" style="width: 680px;"/>
                        <div class="validate-error price" style="background: url('/image/error.png') no-repeat 5px 10px;"></div>
                    </li>
                    <li>
                        <label>菜品现价<b>*</b></label>
                        <input name="or_price" type="text" class="dfinput" placeholder="请填写市场价格" value="<?php echo e($menu -> or_price); ?>" style="width: 680px;"/>
                        <div class="validate-error or_price" style="background: url('/image/error.png') no-repeat 5px 10px;"></div>
                    </li>
                    <li>
                        <label>商品主图<b>*</b></label>
                        <div class="preview-div" style="margin-bottom:20px;">
                            <label for="image0" class="preview-label" style="background:rgba(0,0,0,0.6)">重新选择</label>
                            <input type="file" id="image0" name="image[0]" class="preview-input"  onchange="preview(this,200,200)">
                            <img src='/<?php echo e($menu -> image_dir); ?>350_<?php echo e($menu -> image); ?>' width="200" height="200" alt=""/>
                        </div>
                    </li>
                    <li >
                        <label>商品图片<b>*</b></label>
                        <div style="width: 680px;float:left">
                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="preview-div" style="float:left;width:200px;height:200px;margin:5px 30px 10px 0;">
                                    <label for="image<?php echo e($image->id); ?>"  class="preview-label" style="top:60px;left:30px;background:rgba(0,0,0,0.6)">重新选择</label>
                                    <input type="file" id="image<?php echo e($image->id); ?>" name="image[<?php echo e($image->id); ?>]" class="preview-input"  onchange="preview(this,200,200)">
                                    <img src='/<?php echo e($image->image_dir); ?>350_<?php echo e($image->image); ?>' width="200" height="200" alt=""/>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="preview-div add-image"  style="float:left;width:200px;height:200px;font-weight:bold;font-size:200px;color:#ccc;line-height:200px;cursor: pointer;margin:5px 5px 10px 0;">
                                +
                            </div>

                        </div>
                    </li>
                    <li>
                        <label>商品详情<b></b></label>
                        <textarea name="detail" id="content" style="width: 680px"  rows="30"><?php echo e($menu -> detail); ?></textarea>
                    </li>
                    <li>
                        <button type="submit" style="width:137px;height:35px; background:url(/admin/images/btnbg.png) no-repeat; font-size:14px;font-weight:bold;color:#fff; cursor:pointer;">发布</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script  type="text/javascript" src="/js/preview/preview.js"></script>
<script type="text/javascript">

    //商品分类三级联动
    var firstCate = $('select[name="firstCate"]');
    var secondCate = $('select[name="secondCate"]');
    var thirdCate = $('select[name="thirdCate"]');

    //拿各个级别的分类
    function getSubCate(select,pid,cid){
        $.get('<?php echo e(route("admin.category.nextList")); ?>',{pid:pid,cid:cid},function(data){
            //写入相应的select下列菜单
            select.html(data);
        },'html')
    }

    //获取所有的顶级分类作为一级分类菜单内容
    getSubCate(firstCate,0,<?php echo e($cates[0]); ?>);
    getSubCate(secondCate,<?php echo e($cates[0]); ?>,<?php echo e($cates[1]); ?>);
    getSubCate(thirdCate,<?php echo e($cates[1]); ?>,<?php echo e($cates[2]); ?>);

    //获取对应的二级分类
    firstCate.change(function(){
        getSubCate(secondCate,firstCate.val());
        thirdCate.html('<option value="999">请选择</option>')
    });

    //获取对应的三级分类
    secondCate.change(function(){
        getSubCate(thirdCate,secondCate.val());
    });

    //异步编辑商品
    $('form').submit(function(){
        $(this).ajaxSubmit({
            beforeSubmit: function(){
                goods_loader = parent.layer.load(2);
            },
            success:function(data){
                parent.layer.close(goods_loader);
                if(data.status === 'ok'){
                    parent.layer.msg(data.msg,{ icon:1,time:1000,shade:[0.6] })
                    location = data.jump
                }else{
                    parent.layer.msg(data.msg,{ icon:2,time:2000,shade:[0.6] })
                }
            },
            error:function(xhr){
                parent.layer.close(goods_loader);
                //页面滚动到验证提示的位置
                $(document).scrollTop(0);
                //验证的处理
                var errors=JSON.parse(xhr.responseText).errors;

                $('.validate-error').html('');
                if(errors){
                    for(var i in errors){
                        $('.'+i).text(errors[i][0])
                    }
                }
            }
        });
        return false;
    })

    //更新时添加新的商品图片
    var image_id=0;
    $('.add-image').click(function(){
        var html='<div class="preview-div" style="float:left;width:200px;height:200px;margin:5px 5px 10px 0;">';
        html+='<label for="newimg['+image_id+']" style="top:60px;left:30px;"  class="preview-label">选择图片</label>';
        html+='<input type="file" id="newimg['+image_id+']" name="newimg['+image_id+']" class="preview-input"  onchange="preview(this,200,200)" >';
        html+='<img src="" width="200" height="200" alt=""/></div>';

        $(this).before(html);

        image_id++;
    })
</script>
</html>
