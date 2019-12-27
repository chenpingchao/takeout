<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/admin/css/style.css"/>       
        <link href="/admin/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/admin/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/admin/assets/css/font-awesome.min.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="/admin/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/admin/assets/css/ace-ie.min.css" />
		<![endif]-->
			<script src="/admin/assets/js/jquery.min.js"></script>
            <title>用户查看</title>
    <style>
        .default{
            font-weight: bold;
            font-size: 15px;
        }
    </style>
</head>
<body>
<div class="member_show" >
<div class="member_content">
  <ul>
      @forelse($site as $v)
          @if($loop -> first)
              <div><h4>默认地址:</h4></div>
              <div style="border: 2px solid #444">
                <li class="default">
                      <label class="label_name">收货人：</label><span class="name">{{$v -> name}}</span>&emsp;
                      <label class="label_name">手机：</label><span class="name">{{$v -> moble}}</span><br>
                      <label class="label_name">地&emsp;址：</label><span class="name">{{$v -> location}}&emsp;{{$v -> site}}</span>
                </li>
              </div>
          @else
              <div><h4>其他地址:</h4></div>
              <div style="border: 2px solid #aaa">
                    <li>
                         <label class="label_name">收货人：</label><span class="name">{{$v -> name}}</span>&emsp;
                         <label class="label_name">手机：</label><span class="name">{{$v -> moble}}</span><br>
                         <label class="label_name">地址：</label><span class="name">{{$v -> location}}&emsp;{{$v -> site}}</span>
                    </li>
              </div>
          @endif
      @empty
          <li><h3>该用户暂未设置收货地址</h3></li>
      @endforelse
  </ul>
</div>
</div>
</body>
</html>