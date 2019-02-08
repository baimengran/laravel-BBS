<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    //
    public function home()
    {
        return view('index.home');
    }


    public function help()
    {
        return view('index.help');
    }

    public function about()
    {
        return view('index.about');
    }


    public function permissionDenied()
    {
        //如果当前用户有权限访问后台，直接跳转
        if (config('administrator.permission')()) {
            return redirect(url(config('administrator.uri')), 302);
        }
        //否则使用视图
        return view('index.permission_denied');
    }
}
