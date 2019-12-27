<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/public.css">
    <script type="text/javascript" src="/merchant/style/js/jquery.1.10.1.min.js"></script>
    <script src="/js/layer/layer.js" type="text/javascript"></script>
    <title>Document</title>
</head>
<body>
<div class="add_menu_cate">

    <div class="add_box">
        <p>分类名称：{{$menu_cate-> mc_name}}</p>
        <div id="buttom">
            <input type="button" id='change'  class="buttom" value="修改">
            <input type="button"  id="delete" class="buttom" value="删除">
            @if($menu_cate -> active ==1)
                <input type="button" href="{{route('merchant.shop.menuCateActive',["mc_id"=>$menu_cate->id,"active"=>$menu_cate->active])}}" id="active" style="background:#0F0;"  class="buttom" value="激活">
            @else
                <input type="button" href="{{route('merchant.shop.menuCateActive',["mc_id"=>$menu_cate->id,"active"=>$menu_cate->active])}}" id="active"  style="background:#f00;color:#fff;"  class="buttom" value="禁用">
            @endif
        </div>

        <div style="display:none;" id="form_div">
            <form action="" id="form">
                {{csrf_field()}}
    {{--            <input type="hidden" name="sid" value="{{$s_id}}">--}}
                    <label for="cate" >新分类名称：</label>
                    <input type="text" id="cate" name="cate_name"><br>
                    <input type="submit" value="修改" class="insert">
            </form>
        </div>
    </div>
</div>
</body>
<script>
    //显示修改表单
    $('#change').click(function(){
        $('#buttom').attr('style','display:none');
        $('#form_div').attr('style','display:block');
    });
    //修改
    $('#form').submit(function(){
        me = $(this);
        $.post('',me.serialize(),function(data){
            if(data.status == 'ok'){
                parent.location.reload();
                parent.layer.closeAll();
            }else{
                layer.msg(data.msg,{icon:5})
            }
        })
        return false;

    });

    //删除
    $('#delete').click(function(){
        $.get('{{route('merchant.shop.deleteMenuCate',['mc_id'=> $menu_cate->id])}}','',function(data){
            if(data.status == 'ok'){
                // alert('a');
                parent.location.reload();
                parent.layer.closeAll();
            }else{
                layer.msg(data.msg,{icon:5})
            }
        })
    });
//分类的激活和禁用
    $('#active').click(function(){
        me = $(this);
        $.get(me.attr('href'),'',function(data){
            if(data.stats ==='ok'){
                if(data.active ==1){
                    //激活
                    me.val('激活').attr('style','background:#0F0;')
                }else{
                    //禁用
                    me.val('禁用').attr('style','background:#f00;color:#fff;')
                }
                layer.msg(data.msg,{icon:6});
                parent.location.reload();
                me.attr('href',data.url)
            }else{
                layer.msg(data.msg,{icon:5})
            }
        });
        return false;
    })

</script>
</html>