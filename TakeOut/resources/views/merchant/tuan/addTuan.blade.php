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
<form action="" id="form" method="post">
    <div class='add_box'>
        <input type="hidden" name="sid" value="{{$sid}}" >
        {{csrf_field()}}
        <dl>
            <dd class='dd_input'>
                <label for="tg_name">团购名称：</label>
                <input type="text" name="name" class="add-tuan-input" id="tg_name" placeholder="请输入团购大礼包的名称">
                <div class="image name"></div>
            </dd>
            <dd class='dd_input'>
                <label for="num">成团人数：</label>
                <input type="text" name="num" class="add-tuan-input" id="num" placeholder="请合理填写人数，以免造成损失">
                <div class="image num"></div>
            </dd>
            <dd>
                <label for="ring">礼包数量：</label>
                <input type="text" name="ring" class="add-tuan-input" id="ring" placeholder="请填写团购礼包的数量">
                <div class="image ring"></div>
            </dd>
            <dd>
                <label for="price">团购价格：</label>
                <input type="text" name="price"  class="add-tuan-input" id="price" placeholder="请填写团购礼包的价格">
                <div class="image price"></div>
            </dd>
            <dd>
                <label for="start_time">开始时间：</label>
                <input type="text" name="start_time" class="add-tuan-input" id="start_time" placeholder="填写团购开始时间">
                <div class="image start_time"></div>
            </dd>
            <dd>
                <label for="end_time">结束时间：</label>
                <input type="text" name="end_time" class="add-tuan-input" id="end_time" placeholder="请填写拼团的最大时间">
                <div class="image end_time"></div>
            </dd>
        </dl>

            <div>
                <table calss='menu_list'>
                    <tr>
                        <td></td>
                        <td class='xuhao'>序号</td>
                        <td>图片</td>
                        <td>菜名</td>
                        <td>价格</td>
                    </tr>
                    @forelse($menu as $k=> $v)
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="{{$v->id}}"></td>
                        <td class='xuhao'>{{$k+1}}</td>
                        <td><img style="width:50px;" src="/{{$v -> image_dir}}100_{{$v-> image}}" alt="{{$v->menu_name}}"></td>
                        <td>{{$v -> menu_name}}</td>
                        <td>{{$v -> price }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td><h2>你还没有菜品快去添加吧</h2></td>
                        </tr>
                    @endforelse
                </table>
            </div>

    </div>
    <div class='detail'>
        <dl>
            <dd style="display:flex;margin-bottom:10px;align-items:center;">
                <label for="tg_detail" style="">团购简介：</label>
                <textarea name="tg_detail" cols="30" rows="3" class="add-tuan-input-other" id="tg_detail">请填写团购简介</textarea>
            </dd>
            <dd>
                <input type="submit" class="add-tuan-submit" value="添加团购" >
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
            ring:{
                required: true,
                digits:true,
                min:2,
            },
            price:{
                required :true,
                number:true,
                min:0
            },
            start_time: {
                required: true,
            },
            end_time: {
                required: true,
            },

        },
        messages: {
            name: {
                required:'团购礼包名称为必填',
                rangelength: '长度在2到18个字符之间'
            },
            num: {
                required: '团购礼包拼团人数为必填',
                digits:'必须为数字',
                range: '值必须在2到100之间'
            },
            ring:{
                required: '团购礼包数量为必填',
                digits:'必须为数字',
                min: '最小值为2',
            },
            price:{
                required :'团购价格为必填',
                number: '必须为数字',
                 min: '最小值为0',
            },
            start_time: {
                required: '开始时间必填',
            },
            end_time: {
                required: '结束时间为必填',
            },

        },
        //配置成功提示样式
        errorElement: "div",
        success: function(div) {
            div.addClass("ok").html('验证通过');
        },
        validClass: "ok",
    });

    //绑定时间插件
    laydate.render({
        elem:'#start_time',  //绑定input元素
        type:'datetime',       //date(默认 )、 time 、   year、  month
        value: new Date(), //默认值
        min: '2017-8-11 12:30:00',  //最小可选日期
        max: '2030-8-18 12:30:00',  //最大可选日期
        calendar:true,  //显示公历节日
        theme:'#056dae',  //主题颜色
        showBottom: true //是否显示底部栏
    })
    laydate.render({
        elem:'#end_time',  //绑定input元素
        type:'datetime',       //date(默认 )、 time 、   year、  month
        min: '2017-8-11 12:30:00',  //最小可选日期
        max: '2030-8-18 12:30:00',  //最大可选日期
        calendar:true,  //显示公历节日
        theme:'#056dae',  //主题颜色
        showBottom: true  //是否显示底部栏
    })



    $('form').submit(function(){
        //判断时间的大小
        var now_time = $('#start_time').val().replace('-','/');
        var end_time = $('#end_time').val().replace('-','/');
        var now_time  =  (new Date( now_time )).getTime()/1000;
        var end_time  =  (new Date( end_time )).getTime()/1000;

        if(now_time >= end_time){
            layer.msg('结束时间应大于开始时间',{icon:5,shade:[0.6],time:2500});
            return false;
        }
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

</script>
</html>