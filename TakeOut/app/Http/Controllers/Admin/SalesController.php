<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    //闪购---从数据库中取出数据
    public function ad_FlashBuy(){
        return view('admin.sales.flash_buy');
    }
}
