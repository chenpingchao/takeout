<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加广告</title>
    <link href="/admin/css/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/css/select.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/css/validate.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/admin/css/js/jquery.js"></script>
    <script type="text/javascript" src="/admin/css/js/jquery.idTabs.min.js"></script>
    <script type="text/javascript" src="/admin/css/js/select-ui.min.js"></script>
    <script type="text/javascript" src="/admin/css/js/laydate/laydate.js"></script>
    <script type="text/javascript" src="/admin/css/js/preview1.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
    <style>

        div.preview-div{
            position:relative;
            float:left;
            width: 500px;
            border:1px solid #e6e6e6;
            margin-bottom: 20px;;
            text-align: center;
        }
        input.preview-input{
            display: none;
        }
        label.preview-label{
            position:absolute;
            top:0;
            left:0;
            text-align:center;
            cursor:pointer;
        }
    </style>
</head>
<body>
<div class="formbody" style="margin-left:50px">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="" method="post" id="addAdForm" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="width" value="{{$advertis_index->width}}">
                <input type="hidden" name="width" value="{{$advertis_index->height}}">
                <ul class="forminfo">
                    <li>
                        <label>广告名称<b>*</b></label>
                        <input name="advertis_name" type="text" value="{{old('advertis_name')}}" class="dfinput" placeholder="请填写广告位名称"  style="width: 500px;" />
                        <div class="validate-error">{{$errors->first('advertis_name')}}</div>
                    </li>
                    <li>
                        <label>广告图片<b>*</b></label>
                        <div class="preview-div" >
                            <label for="image0" class="preview-label" style="width: 500px;">广告图片大小({{$advertis_index->width}}像素&times;{{$advertis_index->height}}像素)</label>
                            <input type="file" id="image0" name="image" class="preview-input"  onchange="preview(this,{{$advertis_index->width}},{{$advertis_index->height}})">
                            <img src="" class="preview-img" alt=""/>
                        </div>
                    </li>
                    <li>
                        <label>广告链接<b>*</b></label>
                        <input name="ad_url" type="text" value="{{old('ad_url')}}" class="dfinput" placeholder="请填写广告链接"   style="width: 500px;"/>
                        <div class="validate-error">{{$errors->first('ad_url')}}</div>
                    </li>
                    <li>
                        <label>开始时间</label>
                        <input name="start_time" id="start_time" value="{{old('start_time')}}"  placeholder="请选择广告开始时间" autocomplete="off" type="text" class="dfinput"  style="width:500px;"/>
                    </li>
                    <li>
                        <label>结束时间</label>
                        <input name="end_time" id="end_time"  value="{{old('end_time')}}" placeholder="请选择广告结束时间" autocomplete="off" type="text" class="dfinput"   style="width: 500px;"/>
                    </li>
                    <li>
                        <label>广告描述<b>*</b></label>
                        <textarea name="ad_description" id="" class="dfinput" cols="30" rows="10" autocomplete="off" placeholder="请填写广告描述信息" style="width: 500px;border:1px solid #ccc;height:6em;"></textarea>
                        <div class="validate-error">{{$errors->first('ad_description')}}</div>
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
    //定义时间插件
    laydate.render({
        elem:'#start_time',
        type:'datetime',
        calendar:true,
        theme:'#056dae'
    });

    laydate.render({
        elem:'#end_time',
        type:'datetime',
        calendar:true,
        theme:'#056dae'
    });

    //预览区域宽高设置
    $('div.preview-div').css('height',function(){
        //广告宽度
        var adw = {{$advertis_index->width}}
        //广告高度
        var adh = {{$advertis_index->height}}

            //设置div高度
            height = (500*adh)/adw;
        h1 = height>=40 ? (height>500?500:height) : 40;

        //设置预览图片宽高
        w2 = adw>500 ? 500 : adw ;
        h2 = adh<=h1? adh : h1 ;
        $('.preview-img').css({width:w2+'px',height:h2+'px'});

        h = h1<=h2?h1:h2;
        //设置label行高
        $('label.preview-label').css('line-height',h +'px');
        return h +'px';
    });
    //判断广告添加是否成功
    if('{{session("status")}}' === 'ok'){
        top.main.location.reload();
        parent.layer.msg('添加成功',{icon:1,time:1000, shade:[0.6]},function(){
            parent.layer.closeAll();
        });
    }else if('{{session("status")}}' === 'error'){
        parent.layer.msg('添加失败',{icon:2,time:3000,shade:[0.6,'#000000']})
    }

    $.get("{{route('bg.advertis.addad',['ap_id'=>$ap_id])}}",{gid:id,price:price},function(data){
        if(data.status === 'ok'){
            parent.layer.msg(data.msg,{icon:6,shade:[0.6],time:2000},function(){
                $(me).closest('tr').detach();
                top.main.location.reload();
            })
        }else{
            parent.layer.msg(data.msg,{icon:5,shade:[0.6]})
        }
    },'json');
</script>
</html>