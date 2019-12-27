可用积分:<span style="color: #f2bc18;"><?php echo e($score); ?></span><span class="subtotal"></span>
<div>
    <form action="" id="form1">
        <?php echo e(csrf_field()); ?>

        <dl>
            <dt>红包:</dt>
            <dd>规则:<br>
               无门楷红包:以积分:红包 3:2兑换对应红包。<br>
               满减红包:需要消费指定额度时才可使用。<br>
               单次最多兑换十个红包。
            </dd>
            <dd>
                红包类型:
                <select name="type" style="font-size:16px ; width: 120px;height: 30px">
                    <option value="1">无门楷红包</option>
                    <option value="2">满减红包</option>
                </select>
            </dd>
            <dd>
                红包价值:
                <select name="value" style="font-size:16px;width:120px;height:30px">
                    <option value="8">8元红包</option>
                    <option value="16">16元红包</option>
                    <option value="24">24元红包</option>
                    <option value="32">32元红包</option>
                </select>
            </dd>
            <dd>
                红包个数:
                <input  name="min"  style="width:30px; height:30px;border:1px solid #ccc;" type="button" value="-" />
                <input name="num"  id="text_box1" type="text" value="0" style=" width:40px;height:28px; text-align:center; border:1px solid #ccc;" />
                <input  name="add"   style="width:30px; height:30px;border:1px solid #ccc;" type="button" value="+" />
            </dd>
            <dd>
                <button type="button" value="兑换" style="float:right;width: 50px;height: 35px;">兑换</button>
                <input type="button" value="取消" style="float:right;width: 50px;height: 35px;margin-right: 10px">
            </dd>
        </dl>
    </form>
</div>
<script type="text/javascript" src="/js/jQuery-1.8.2.min.js"></script>
<script type="text/javascript" src="/js/layer/layer.js"></script>
<script>
    //加的处理
    $('input[name="add"]').click(function(){
        me = $(this);
        if(me.prev().val() < 10){
            me.prev().val( parseInt( me.prev().val() )+1 )
        }
       subtotal();
    });

    //减的处理
    $('input[name="min"]').click(function(){
        me = $(this);
        if(me.next().val() > 0) {
            me.next().val( parseInt(me.next().val()) - 1)
        }
       subtotal();
    });

    $('select').change(function () {
        subtotal();
    });

    function subtotal() {
        if ($('input[name="num"]').val() > 0){
            if ($('select[name="type"]').val() === '1'){
                $('.subtotal').text('-'+parseInt($('input[name="num"]').val())*1.5*parseInt($('select[name="value"]').val()));
            } else {
                $('.subtotal').text('-'+parseInt($('input[name="num"]').val())*parseInt($('select[name="value"]').val()));
            }
        } else {
            $('.subtotal').text('');
        }
    }

    $('button:first').click(function () {
        if ($('input[name="num"]').val() !== '0'){
            $.post('',$('#form1').serialize(),function (data) {
                if (data.status === 'ok') {
                    layer.msg(data.msg, {icon: 6, time: 1000},function () {
                        parent.location.reload(true);
                        parent.layer.closeAll();
                    });
                }else{
                    parent.layer.msg(data.msg, {icon: 5, time: 2000})
                }
            },'json')
        }else {
           layer.msg('红包数量不能为0',{icon:0,time:2000});
        }
        return false;
    });

    $('input:last').click(function () {
        parent.location.reload(true);
        parent.layer.closeAll();
    });
</script>