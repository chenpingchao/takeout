<?php

namespace App\Http\Controllers\admin;

use App\Admin;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    //后台首页
     public function index(){
         return view("admin.index.index");
     }
     //后台主页
     public function main(){
         $Admin=Admin::where('id',[session('aid')])
             ->select('login_time','login_num','login_ip')
             ->get()
             ->toArray();
         $Member=Member::count();
          return view("admin.index.main",compact('Admin','Member'));
     }
     public function left(){
         return view("admin.index.left");
     }
     public function footer(){
         return view("admin.index.footer");
     }
}
