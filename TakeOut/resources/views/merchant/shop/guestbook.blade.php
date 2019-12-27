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
    <![endif]-->
    <script src="/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/admin/assets/layer/layer.js" type="text/javascript" ></script>
    <script src="/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <link href="/admin/css/validate.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/admin/js/jquery.js"></script>
    <script type="text/javascript" src="/admin/js/jquery.idTabs.min.js"></script>
    <title>留言</title>
</head>
<body>

<div id="Guestbook">
    <div class="content_style">
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">留言用户 </label>
            <div class="col-sm-9 username-one">{{$content[0]['username']}}</div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 留言内容 </label>
            <div class="col-sm-9 content-one">{{$content[0]['content']}}</div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 回复内容</label>
            <div class="col-sm-9 content-one">{{$content['reply'] ? $content['reply'] : '你还没有回复呦' }}</div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">是否回复 </label>
            <div class="col-sm-9">
                <label>
                    <input name="checkbox" type="checkbox" class="ace" id="checkbox">
                    <span class="lbl"> 回复</span>
                </label>
                <form action="" method="post">
                    {{csrf_field()}}
                    <div class="Reply_style">
                        <textarea name="reply" class="guest-reply form-control" id="form_textarea" placeholder="" onkeyup="checkLength(this);"></textarea>
                        <div  class="validate-error reply"></div>
                        <span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span>字</span>
                        <div class="center">
                            <button onclick="" class="btn radius btn-primary" id="Reply-one" type="button">提交回复</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $('#Reply-one').click(function () {
        $.ajax({
            url:'{{route('merchant.orders.guestBook',['gid'=>$content[0]['id']])}}',
            type:'post',
            data:$('form').serialize(),
            dataType:'json',
            success:function(data){
                //显示回复成功信息
                if(data.status === 'ok'){
                    layer.msg(data.msg,{icon:6,shade:[0.6]},function(){
                        //关闭窗口
                        parent.layer.closeAll();
                    })
                }else{
                    layer.msg(data.msg,{icon:5,shade:[0.6]})
                }
            },
            error:function(xhr){
                //显示验证信息
                var errors = JSON.parse(xhr.responseText).errors;
                console.log(errors);
                //方式一：
                for(var i in errors){
                    $('.'+i).text(errors[i][0])
                }
            }
        });
        //阻止表单默认提交
        return false;
    })
</script>
<script type="text/javascript">
    /*用户-查看*/
    function member_show(title,url,id,w,h){
        layer_show(title,url+'#?='+id,w,h);
    }
    /*checkbox激发事件*/
    $('#checkbox').on('click',function(){
        if($('input[name="checkbox"]').prop("checked")){
            $('.Reply_style').css('display','block');
        }
        else{

            $('.Reply_style').css('display','none');
        }
    })
    /*留言查看*/
    function Guestbook_iew(id,username,content,mid){
        var index = layer.open({
            type: 1,
            title: '留言信息',
            maxmin: true,
            shadeClose:false,
            area : ['600px' , ''],
            content:$('#Guestbook'),
        })
        $(".username-one").text(username);
        $('.content-one').text(content);
        $('.guest-id').val(id);
        $('.guest-mid').val(mid);
    };

    /*字数限制*/
    function checkLength(which) {
        var maxChars = 200; //
        if(which.value.length > maxChars){
            layer.open({
                icon:2,
                title:'提示框',
                content:'您输入的字数超过限制!',
            });
            // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
            which.value = which.value.substring(0,maxChars);
            return false;
        }else{
            var curr = maxChars - which.value.length; //250 减去 当前输入的
            document.getElementById("sy").innerHTML = curr.toString();
            return true;
        }
    };
</script>

    </html>