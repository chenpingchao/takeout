<!doctype html>
<html lang="en">
<head>
    <head>
        <meta charset="utf-8" />
        <title>评论查询</title>
        <meta name="keywords" content="DeathGhost,DeathGhost.cn,web前端设,移动WebApp开发" />
        <meta name="description" content="DeathGhost.cn::H5 WEB前端设计开发!" />
        <meta name="author" content="DeathGhost"/>
        <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/home/js/public.js"></script>
        <script type="text/javascript" src="/home/js/jquery.js"></script>
        <script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
        <script src="/admin/assets/layer/layer.js" type="text/javascript"></script>
        <script src="/home/KPS/js/starScore.js"></script>
    <style>
            body,li,p,ul {
                margin: 0;
                padding: 0;
                font: 12px/1 Tahoma, Helvetica, Arial, "\5b8b\4f53", sans-serif;
            }
            ul, li, ol { list-style: none; }

            /* 重置文本格式元素 */
            a {
                text-decoration: none;
                cursor: pointer;
                color:#333333;
                font-size:14px;
            }
            a:hover {
                text-decoration: none;
            }
            .clearfix::after{
                display:block;
                content:'';
                height:0;
                overflow:hidden;
                clear:both;
            }

            /*星星样式*/
            .content{
                width:600px;
                margin:0 auto;
                padding-top:20px;
            }
            .title{
                font-size:14px;
                background:#dfdfdf;
                padding:10px;
                margin-bottom:10px;
            }
            .block{
                width:100%;
                margin:0 0 20px 0;
                padding-top:10px;
                padding-left:50px;
                line-height:21px;
            }
            .block .star_score{
                float:left;
            }
            .star_list{
                height:21px;
                margin:50px;
                line-height:21px;
            }
            .block p,.block .attitude{
                padding-left:20px;
                line-height:21px;
                display:inline-block;
            }
            .block p span{
                color:#C00;
                font-size:16px;
                font-family:Georgia, "Times New Roman", Times, serif;
            }

            .star_score {
                background:url(/home/KPS/images/stark2.png);
                width:160px;
                height:21px;
                position:relative;
            }

            .star_score a{
                height:21px;
                display:block;
                text-indent:-999em;
                position:absolute;
                left:0;
            }

            .star_score a:hover{
                background:url(/home/KPS/images/stars2.png);
                left:0;
            }

            .star_score a.clibg{
                background:url(/home/KPS/images/stars2.png);
                left:0;
            }

            #starttwo .star_score {
                background:url(/home/KPS/images/starky.png);
            }

            #starttwo .star_score a:hover{
                background:url(/home/KPS/images/starsy.png);
                left:0;
            }

            #starttwo .star_score a.clibg{
                background:url(/home/KPS/images/starsy.png);
                left:0;
            }

            /*星星样式*/

            .show_number{
                padding-left:50px;
                padding-top:20px;
            }

            .show_number li{
                width:240px;
                border:1px solid #ccc;
                padding:10px;
                margin-right:5px;
                margin-bottom:20px;
            }

            .atar_Show{
                background:url(/home/KPS/images/stark2.png);
                width:160px; height:21px;
                position:relative;
                float:left;
            }

            .atar_Show p{
                background:url(/home/KPS/images/stars2.png);
                left:0;
                height:21px;
                width:134px;
            }

            .show_number li span{
                display:inline-block;
                line-height:21px;
            }

        </style>
</head>
<body>
<div id="OrderAct5-select-from" class="add_menber">
    <form action="" id="form1" method="post">
        {{csrf_field()}}
        <table id="add_tab">
            <h2>评论内容:</h2>
            @forelse($MenuDet as $k=>$v)
                <div style="margin-left:60px;width:300px;height:10px;">{{$v->detail}}</div>
                <ul class="show_number clearfix">
                    <li style="margin-left:10px;">
                        <div class="atar_Show">
                            <p tip="{{$v->fenshu}}"></p>
                        </div>
                        <span></span>
                    </li>
                </ul>
            @empty
                <div style="margin-left:60px;width:300px;height: 80px;">
                    <b>还未评论</b>
                </div>
            @endforelse
            <tr>
                <td align="right" class="FontW">修改评论：</td>
                <input name="id"  style="display: none;" value="{{$MenuDet[0]['id']}}" />
                <td><textarea name="detail" cols="" rows=""  required placeholder="" style="width: 300px;height:80px"></textarea></td>
            </tr>
            <tr colspan="2">
                <div class="content">
                    <p class="title">修改评星</p>
                    <div id="startone"  class="block clearfix" >
                        <div class="star_score"></div>
                        <p style="float:left;">您的评分：<span id="FE" class="fenshu"></span> 分</p>
                    </div>
                    <div>
                        <input style="display: none;" type="text" id="FG" name="fenshu"  required>
                    </div>

                    <!-- 分数展示 -->
                </div>
            </tr>
            <tr>
                <td style="text-align: center" colspan="2">
                    <button type="button" id="0" class="Submit_b" style="background-color:#2d6983;height:30px;width:80px;color:#CCCCCC;">保存</button>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
<script>
    //分数评分
    scoreFun($("#startone"));
    //显示分数
    $(".show_number li p").each(function(index, element) {
        var num=$(this).attr("tip");
        var www=num*2*16;//
        $(this).css("width",www);
        $(this).parent(".atar_Show").siblings("span").text(num+"分");
    });

    $('.Submit_b').click(function(){   //submit按钮方式提交
        //获取.fenshu span中数据
        var fun=document.getElementById("FE").innerText;
        //写入name为fenshu的文本框
        $('#FG').val(fun);
        $.post('{{route("hm.mem.UserOrder_Upd")}}',$('#form1').serialize(),function(data){
            //判断是否成功
            if(data.status === 'ok'){
                parent.layer.msg(data.msg,{icon:1, time:1000, shade:[0.6]},function(){
                    // parent.layer.closeAll();
                    parent.location.reload();
                })
            }else{
                parent.layer.msg(data.msg,{icon:2,time:2000,shade:[0.6]})
            }
        },'json')
    });

</script>
</html>