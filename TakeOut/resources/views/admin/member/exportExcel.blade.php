<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        table{
            background-color: #f0c040;
        }
        th{
            text-align: center;
            font-weight: bold;
            background-color: #000;
            color:#fff;
        }
        td,th{
            border:1px solid #ff0300;
            vertical-align: middle;
        }

    </style>
</head>
<body>

<table>
   <tr>
       <td colspan="5">
           <h1 style="text-align: center;font-family: 黑体">商品列表</h1>
       </td>
   </tr>
    <tr>
        <th  width="10">id</th>
        <th  width="100">用户名</th>
        <th  width="400">密码</th>
        <th  width="30">等级</th>
        <th  width="30">电话号码</th>
    </tr>
    @forelse($member as  $v)
        <tr>
            <td>{{$v['id']}}</td>
            <td>{{$v['username']}}</td>
            <td>{{$v['password']}}</td>
            <td>{{$v['grade']}}</td>
            <td>{{$v['mobile']}}</td>
        </tr>
        @empty
    @endforelse
</table>
</body>
</html>