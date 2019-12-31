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

</head>
<body>
    <div>
        <form action="" id="form">
            <input type="hidden" name="sid" value="{{$sid}}" >
            {{csrf_field()}}
        <dl>
            <dd>
                <label for="tg_name">团购名称：</label>
                <input type="text" name="tg_name" id="tg_name" placeholder="请输入团购大礼包的名称">
            </dd>
            <dd>
                <label for="num">成团人数：</label>
                <input type="text" name="num" class="add-tuan-input" id="num" placeholder="请合理填写人数，以免造成损失">
            </dd>
            <dd>
                <label for="ring">团购数量：</label>
                <input type="text" name="ring" class="add-tuan-input" id="ring" placeholder="请填写团购礼包的数量">
            </dd>
            <dd>
                <label for="price">团购价格：</label>
                <input type="text" name="price"  class="add-tuan-input" id="price" placeholder="请填写团购礼包的价格">
            </dd>
            <dd>
                <label for="start_time">开始时间：</label>
                <input type="text" name="start_time" class="add-tuan-input" id="start_time" placeholder="填写团购开始时间">
            </dd>
            <dd>
                <label for="end_time">拼团时长：</label>
                <input type="text" name="end_time" class="add-tuan-input-other" id="end_time" placeholder="请填写拼团的最大时间">
            </dd>
            <dd>
                <input type="submit" class="add-tuan-submit" value="添加团购" >
            </dd>
        </dl>
            <div>
                <table>
                    <tr>
                        <td></td>
                        <td>序号</td>
                        <td>图片</td>
                        <td>菜名</td>
                        <td>价格</td>
                    </tr>
                    @forelse($menu as $k=> $v)
                    <tr>
                        <td><input type="checkbox" name="chk[]"></td>
                        <td>{{$k+1}}</td>
                        <td><img src="/{{$v -> image_dir}}100_{{$v-> image}}" alt="{{$v->menu_name}}"></td>
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
        </form>
    </div>
</body>
<script>
    $('#form').submit(function(){
        me = $(this);
        $.post('',me.serialize(),function(even){
            if(even.status === 'ok'){

            }else{

            }

        })
        return false;
    })

</script>
</html>