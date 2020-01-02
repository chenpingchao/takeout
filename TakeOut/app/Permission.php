<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    //管理员表
    protected  $table = 'permissions';
    //关闭自动维护时间戳
    public $timestamps = false;

    //查询菜单树
    public static function getPermissionTree(){
        //获取所有顶级菜单
        $permissionTree = self::where('pid',0) -> get() -> toArray();

        foreach($permissionTree as $k1 => $v1){
            //获取剩余所有子权限
            $permissionTree[$k1]['child'] = self::where('pid',$v1['id']) -> get() -> toArray();
        }
        return $permissionTree;
    }

}

