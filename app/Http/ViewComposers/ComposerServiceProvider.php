<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/9
 * Time: 9:17
 */

namespace App\Http\ViewComposers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        View::composer(
            '__header', 'App\Http\ViewComposers\UserInfo'
        );
    }

    public function register(){

    }
}