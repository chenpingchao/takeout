<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body >
<div style="width:100%;height:1000px;background-color: #DDEDFB">
    <h2>{{$shop_msg->audit_name}}先生，你的店铺{{$shop_msg->shop_name}}审核不通过</h2>
    <h3>原因如下</h3>
    <h3 style="color:red">{{$turn}}</h3>
</div>
</body>
</html>