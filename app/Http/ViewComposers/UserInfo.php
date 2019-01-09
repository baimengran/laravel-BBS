<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/9
 * Time: 15:32
 */

namespace App\Http\ViewComposers;


use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class UserInfo
{

    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function composer(View $view)
    {
        $view->with('userInfo', [$this->user]);
    }
}