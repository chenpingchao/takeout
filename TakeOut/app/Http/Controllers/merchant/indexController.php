<?php

namespace App\Http\Controllers\Merchant;

use App\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    //商家后台主页
    public function index(){
        $count_shop = (string)Shop::count('id');
        $shop = Shop::where( 'sm_id',session('smid') )
            -> paginate(2) ;
        $count_shop =  str_split($count_shop);

        return view('merchant.index' , compact('shop','count_shop','shop_num'));
    }


}
