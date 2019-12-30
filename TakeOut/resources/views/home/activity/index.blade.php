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
                border: 2px solid #666;
                padding: 5px;
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
                margin:5px 0;
            }
            .header_msg{
                height: 75px;
                left: 5px;
                border: 1px #1b6aaa solid;
            }
        </style>
</head>
@endsection
@section('main')
<div class="box">
    <div class="sg">

    </div>
    <div class="tg">
        <div class="header_msg"></div>
        <div>
            <ul>
                <li>活动列表</li>
                @forelse($tg as $v)
                <li>
                    <div class="tg_detail">
                        <img src="{{$v['logo']}}" class="logo">
                        <div class="right">
                            <span>店铺名称：{{$v['shop_name']}}</span>x
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

