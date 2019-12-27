<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //菜品表
    protected  $table = 'menu';
    //关闭自动维护时间戳
    public $timestamps = false;

    //获取指定菜品的月销量
    //参数$data为查询的年查询的月的时间戳
    //参数$id为查询菜品id
    public static function getMonthNum($id,$data){
        @$data = date('Y-m',$data);
        $begin_date = strtotime($data);
        $end_date = strtotime($data.'+1 month') - 1;
        $saled = OrdersMenu:: from('orders_menu as om')
                           -> join('orders as o','o.id','=','om.oid')
                           -> where('om.uid',$id)
                           -> whereBetween('o.add_time',[$begin_date,$end_date])
                           -> pluck('om.num');
        $month_num = 0;
        foreach ($saled as $v){
            $month_num += $v;
        }
        return $month_num;
    }
}
