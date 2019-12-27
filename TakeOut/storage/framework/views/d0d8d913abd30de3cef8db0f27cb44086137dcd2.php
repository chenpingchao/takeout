<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/admin/css/style.css"/>
    <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
    <link rel="stylesheet" href="/admin/css/validate.css" type="text/css"/>
    <![endif]-->
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/js/H-ui.js" type="text/javascript"></script>
    <title>添加广告</title>
</head>

<body>
<div class="margin clearfix">
    <div class="article_style">
        <div class="add_content" id="form-article-add">
            <form action="" method="post">
                <?php echo e(csrf_field()); ?>

                <ul>
                    <li class="clearfix Mandatory">
                        <label class="label_name"><i>*</i>广告名称</label>
                        <span class="formControls col-10">
                            <input name="advertis_name" type="text" id="form-field-1" class="col-xs-10 col-sm-5 ">
                            <div class="validate-error"><?php echo e($errors->first('advertis_name')); ?></div>
                        </span>
                        <
                    </li>
                    <li class="clearfix Mandatory">
                        <label class="label_name"><i>*</i>链接</label>
                        <span class="formControls col-10">
                            <input name="advertis_href" type="text" id="form-field-1" class="col-xs-10 col-sm-6 ">
                            <div class="validate-error"><?php echo e($errors->first('advertis_name')); ?></div>
                        </span>
                    </li>
                    </li>
                </ul>
            </form>
            <div class="Button_operation">
                <button href="<?php echo e(route('bg.advertis.index')); ?>" class="btn btn-primary radius" type="submit">保存并提交</button>
                <button onclick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="/admin/Widget/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/admin/Widget/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/admin/Widget/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    /**提交操作**/
    if ('<?php echo e(session('status')); ?>' === 'ok'){
        //添加成功
        parent.confirm('<?php echo e(session('msg')); ?>',{icon:3,title:'跳转提示',btn:['继续添加','返回']},
            
        )
    }
    //返回
    function layer_close(){
        location.href="<?php echo e(route('bg.advertis.index')); ?>";
    }
    /*radio激发事件*/
    function Enable(){ $('.date_Select').css('display','block');}
    function closes(){$('.date_Select').css('display','none')}
</script>