<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>广告位编辑</title>
    <link href="/admin/css/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/css/select.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/css/validate.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/admin/css/js/jquery.js"></script>
    <script type="text/javascript" src="/admin/css/js/jquery.idTabs.min.js"></script>
    <script type="text/javascript" src="/admin/css/js/select-ui.min.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>

</head>
<body>

<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="" method="post">
                {{csrf_field()}}
                <ul class="forminfo">
                    <li>
                        <label>广告位名称<b>*</b></label>
                        <input name="advertisP_name" type="text" value="{{$advertis_edit->advertisP_name}}" class="dfinput" placeholder="请填写广告位名称"  style="width:518px;"/>
                        <div class="validate-error">{{$errors->first('advertisP_name')}}</div>
                    </li>
                    <li>
                        <label>广告数量<b>*</b></label>
                        <input name="advertis_num" type="text" value="{{$advertis_edit->advertis_name}}" class="dfinput" placeholder="请填写广告数量"  style="width:518px;"/>
                        <div class="validate-error">{{$errors->first('advertis_num')}}</div>
                    </li>
                    <li>
                        <label>广告图宽度<b>*</b></label>
                        <input name="width" type="text"  value="{{$advertis_edit->width}}" class="dfinput" placeholder="请填写广告图宽度"  style="width:518px;"/>
                        <div class="validate-error">{{$errors->first('width')}}</div>
                    </li>
                    <li>
                        <label>广告图高度<b>*</b></label>
                        <input name="height" type="text"  value="{{$advertis_edit->height}}" class="dfinput" placeholder="请填写广告图高度"  style="width:518px;"/>
                        <div class="validate-error">{{$errors->first('height')}}</div>
                    </li>
                    <li>
                        <label>广告位描述<b>*</b></label>
                        <textarea name="description" id="" cols="30" rows="10" placeholder="请填写广告位描述信息" style="border:1px solid #ccc;width:518px;height:6em;">{{$advertis_edit->description}}</textarea>
                        <div class="validate-error">{{$errors->first('description')}}</div>
                    </li>
                    <li>
                        <label>&nbsp;</label>
                        <input name="" type="submit" class="btn" value="提交"/>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">

    //判断添加是否成功
    if('{{session("status")}}' == 'ok'){
        // top.main.location.reload();
        parent.layer.msg('添加成功',{icon:1,time:1000,shade:[0.6]},function(){
            parent.layer.closeAll();
        });
    }else if('{{session("status")}}' == 'error'){
        parent.layer.msg('添加失败',{icon:2,time:3000, shade:[0.6]})
    }

</script>
</html>
