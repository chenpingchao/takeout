<?php
namespace Home\Model;

use Think\Model;

class MemberModel extends Model {
    protected $tableName = 'member';
//设置验证完所有字段信息
    protected $patchValidate = true;
//设置验证规则
    protected $_validate = array(
        array('username','require','用户名不能为空！'),
        array('username','','帐号名称已经存在！',0,'unique',1),
        array('username','3,20','用户名长度在3到20个字符之间！',0,'length ',1),
        array('password','require','密码不能为空！'),
        array('password','3,20','密码长度在3到20个字符之间！',0,'length ',1),
        array('repwd','require','确认密码不能为空！'),
        array('repwd','3,20','确认密码长度在3到20个字符之间！',0,'length ',1),
        array('repwd','password','两次密码输入不一致',0,'confirm'),
        array('mobile','require','手机号码不能为空'),
        array('mobile','/^1[356789][0-9]{9}$/','手机号码格式不正确',0,'regex')
    );
}