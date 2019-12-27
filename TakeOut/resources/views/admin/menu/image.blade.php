<style>
    ul.smallpic li{
        border: 1px solid #ccc;
        margin-left: 5px;
        cursor: pointer;
    }
    #showimg{
        border: 1px solid #ccd0d2;
    }
    ul,li{
        list-style-type: none;
    }
    .smallpic li{
        float: left;
    }
</style>

<div class="foodpic">
    <div style="clear: both">
        <ul class="smallpic">
            <li><img src="/{{$menu_msg[0] -> image_dir}}100_{{$menu_msg[0] -> image}}" onclick="show('/{{$menu_msg[0] -> image_dir}}350_{{$menu_msg[0] -> image}}')"></li>
            @forelse($menu_image as $v)
                <li><img src="/{{$v -> image_dir}}100_{{$v -> image}}" onclick="show('/{{$v -> image_dir}}350_{{$v -> image}}')" ></li>
            @empty
            @endforelse
        </ul>
    </div>
    <div style="margin-left: 25px;margin-top: 5px;display: inline-block">
        <img src="/{{$menu_msg[0] -> image_dir}}350_{{$menu_msg[0] -> image}}" id="showimg" style="margin-left: 20px">
    </div>
</div>
<script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
<script>
    //显示图
    function show(src) {
        $('#showimg').attr('src',src);
    }
</script>