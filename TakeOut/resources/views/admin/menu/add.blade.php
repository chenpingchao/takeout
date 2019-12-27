<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加商品</title>
    <link href="/admin/css/add-style.css" rel="stylesheet" type="text/css" />
{{--    <link href="/admin/css/select.css" rel="stylesheet" type="text/css" />--}}
    <link href="/admin/css/validate.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/js/webuploader/webuploader.css" />
    <link rel="stylesheet" type="text/css" href="/js/preview/preview.css" />
    <script type="text/javascript" src="/admin/js/jQuery.js"></script>
    <script type="text/javascript" src="/admin/js/jquery.idTabs.min.js"></script>
{{--    <script type="text/javascript" src="/admin/js/select-ui.min.js"></script>--}}
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
        <li><a href="#">添加菜品</a></li>
    </ul>
</div>
<div  style="margin-left:100px;width: 80%"  id="validate-div" >
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="{{route('admin.menu.add')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
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
                        <input name="menu_name" type="text" class="dfinput" placeholder="请填写商品名称"  style="width: 680px;"/>
                        <div class="validate-error menu_name" style="background: url('/image/error.png') no-repeat 5px 10px;"></div>
                    </li>
                    <li>
                        <label>菜品关键字<b>*</b></label>
                        <input name="key_words" type="text" class="dfinput" placeholder="请填写商品关键字,多个关键字用逗号隔开"  style="width: 680px;"/>
                        <div class="validate-error keywords" style="background: url('/image/error.png') no-repeat 5px 10px;"></div>
                    </li>
                    <li>
                        <label>菜品原价<b>*</b></label>
                        <input name="price" type="text" class="dfinput" placeholder="请填写商城价格"  style="width: 680px;"/>
                        <div class="validate-error price" style="background: url('/image/error.png') no-repeat 5px 10px;"></div>
                    </li>
                    <li>
                        <label>菜品现价<b>*</b></label>
                        <input name="or_price" type="text" class="dfinput" placeholder="请填写市场价格"  style="width: 680px;"/>
                        <div class="validate-error or_price" style="background: url('/image/error.png') no-repeat 5px 10px;"></div>
                    </li>
                    <li>
                        <label>商品主图<b></b></label>
                        <div class="preview-div">
                            <label for="image" class="preview-label">点击选择主图</label>
                            <input type="file" id="image" name="image" class="preview-input"  onchange="preview(this,200,200)">
                            <img src="" width="200" height="200" alt=""/>
                        </div>
                    </li>
                    <li >
                        <label>商品图片<b></b></label>
                        <div class="uploader-list-container vocation" style="width: 680px;border:1px #ccc solid;margin-bottom: 30px;">
                            <div class="queueList">
                                <div id="dndArea" class="placeholder">
                                    <div id="filePicker-2"></div>
                                    <p>或将照片拖到这里，单次最多可选6张</p>
                                </div>
                            </div>
                            <div class="statusBar" style="display:none;">
                                <div class="progress"> <span class="text">0%</span> <span class="percentage"></span> </div>
                                <div class="info"></div>
                                <div class="btns">
                                    <div id="filePicker2"></div>
                                    <div class="uploadBtn" style="display: none" >开始上传</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <label>商品详情<b></b></label>
                        <textarea name="detail" id="content" style="width: 680px" rows="30"></textarea>
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
<script type="text/javascript" src="/js/preview/preview.js"></script>
<script type="text/javascript" src="/js/webuploader/webuploader.js"></script>
<script type="text/javascript" src="/js/webuploader/upload.js"></script>
{{--<script  type="text/javascript"  src="/js/jquery.form.js"></script>--}}
<script type="text/javascript">
    //定义处理上传的url,注意要将此路由排除在csrf检测之外
    var upload_url='{{route("admin.menu.addImg")}}';
    //上传成功这后跳转到的页面
    var jump_url='{{route("admin.menu.list")}}';

    //商品分类三级联动
    var firstCate = $('select[name="firstCate"]');
    var secondCate = $('select[name="secondCate"]');
    var thirdCate = $('select[name="thirdCate"]');

    //拿各个级别的分类
    function getSubCate(select,pid,cid){
        $.get('{{route("admin.category.nextList")}}',{pid:pid,cid:cid},function(data){
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

    //异步发布商品
    $('form').submit(function(){
        $(this).ajaxSubmit({
            beforeSubmit: function(){
                goods_loader = parent.layer.load(2);
            },
            success:function(data){
                parent.layer.close(goods_loader);
                if(data.status === 'ok'){
                    if($('.filelist').find('li').length > 0){
                        //上传商品辅图
                        $('.uploadBtn').click();
                    }else{
                        parent.layer.msg(data.msg,{icon:6,time:2000},function () {
                            location = jump_url;
                        });
                    }
                }else{
                    layer.msg(data.msg,{ icon:2,time:2000,shade:[0.6] })
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
</script>
</html>
