<?php

namespace App\Http\Controllers\Admin;

use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    //系统列表
    public function lists(){
        $system_list = System::all();
        return view('admin.system.system_list',compact('system_list'));
    }
}
