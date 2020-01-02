@extends("home/public/public")
@section('header')
<head>
    <meta charset="utf-8" />
    <title>外卖订餐</title>
    <meta name="author" content="DeathGhost"/>
    <link href="/home/style/style.css" rel="stylesheet" type="text/css" />
    <link rel="Shortcut Icon" href="/image/title.ico">
    <script type="text/javascript" src="/home/js/public.js"></script>
    <script type="text/javascript" src="/home/js/jquery.js"></script>
    <script type="text/javascript" src="/home/js/layer/layer.js"></script>
    <script type="text/javascript" src="/home/js/jqpublic.js"></script>
    <script src="/home/js/geo.js"></script>
        <style>
            ul li{
                list-style-type: none;
            }
            .box{
                width: 90%;
                margin: 0 auto;
                display: flex;
                justify-content: space-around;
                padding: 5px;
            }
            .sg,.tg{
                display: inline-block;
                width: 600px;
                height: 550px;
                border: 2px solid #666;
                padding: 5px;
                overflow-y: scroll;
            }
            .tg_detail{
                display: flex;
                border: 2px solid #ccc;
                margin-bottom: 5px;
            }
            .logo{
                width: 100px;
                margin: 5px;
            }
            .right{
                width: 250px;
                margin:5px 0;
            }
            .or_price{
                text-decoration: line-through;
                color: #bbb;
                font-size: 14px;
                font-style: italic;
            }
            .price{
                color: #ff4444;
                font-size: 16px;
            }
            .about{
                margin: 5px;
            }
            .msg{
                border: 1px #095f8a solid;
                color: #999;
                padding: 5px;
                font-size: 10px;
            }
            /*滚动条的宽度*/
            ::-webkit-scrollbar {
                width:9px;
                height:9px;
            }

            /*外层轨道。可以用display:none让其不显示，也可以添加背景图片，颜色改变显示效果*/
            ::-webkit-scrollbar-track {
             display: none;
            }

            /*滚动条的设置*/
            ::-webkit-scrollbar-thumb {
                background-color:#c2c2c2;
                background-clip:padding-box;
                min-height:18px;
                -webkit-border-radius: 2em;
                -moz-border-radius: 2em;
                border-radius:2em;
            }
        </style>
</head>
@endsection
@section('main')
<div class="box">
    <div class="sg">

    </div>
    <div class="tg">
        <div>
            <div style="font-size: 25px;text-align: center">团购列表</div>
            <ul>
                @forelse($tg as $v)
                <li>
                    <div class="tg_detail">
                        <img src="{{$v['logo']}}" class="logo">
                        <div class="right">
                            <div>店铺名称：{{$v['shop_name']}}</div>
                            <div>礼包描述：{{mb_substr($v['detail'],50)}}</div>
                            <div>
                                价格：<span class="or_price">{{$v['or_price']}}</span>
                                      <span class="price">{{$v['price']}}</span>
                            </div>
                        </div>
                        <div class="about">
                            <div class="msg">
                                @if($v['member']!=1)
                                    ...
                                    @foreach($v['member'] as $m)
                                        <div>{{date('H时i分',$m['add_time'])}}用户{{$m['username']}}加入本团</div>
                                    @endforeach
                                @else
                                    <h4>暂时没有人参与团购</h4>
                                @endif
                            </div>
                            <div>
                                @if($v['active'] != 1)
                                    <span>{{$active[$v['active']]}}</span>
                                @else
                                    <div>结束倒计时：<span class="rectime" time="{{ $v['time'] }}"></span></div>
                                    <span>{{$v['join_num']}}</span>/{{$v['num']}}
                                    <button class="join" type="button">加入团购</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
                @empty
                <li>
                    <h2>暂时没有活动</h2>
                </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        function djs(me,time){
            if (time >= 0){
                time = time-1;
                $(me).text(Math.floor(time/(60*60))+'时'+(time/60)%60+'分'+time%60+'秒');
                timer =	setInterval(djs(me,time),1000);
            }else{
                clearInterval(timer);
            }
        }

        $('.rectime').each(function () {
            djs(this,$(this).attr('time'));
            // console.log($(this).attr('time'));
        })

        var ws = new WebSocket('ws://192.168.168.128:9527');
        ws.onopen=function () {
            document.getElementById('send').onclick = function () {
                var msg=document.getElementById('msg').value;
                if (msg){
                    ws.send(msg);
                }
            }
        };

        //服务器推送
        ws.onmessage=function (event) {
            msg=JSON.parse(event.data);
            showMsg(msg);
        };

        //显示信息
        function showMsg($msg){
            var p = document.createElement('p');
            if($msg.type === 'enter'){
                p.style.color = 'green';
            }else if($msg.type === 'leave'){
                p.style.color = 'red';
            }else{
                p.style.color = '#666';
            }
            p.innerHTML = $msg.connect;

            //显示在页面
            document.body.appendChild(p);
        }
    </script>
@endsection
