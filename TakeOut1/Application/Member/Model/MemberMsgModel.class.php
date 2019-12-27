<?php
namespace Member\Model;

use Think\Model;

class MemberMsgModel extends Model {
    protected $tableName = 'member_msg';
    //设置验证完所有字段信息
    protected $patchValidate = true;
    //设置验证规则
    protected $_validate = array(
        array('name','require','收货人姓名不能为空'),
        array('mobile','require','收货人电话不能为空'),
        array('mobile','/^1[3-9]\d{9}$/','手机号格式不正确')
    );
}