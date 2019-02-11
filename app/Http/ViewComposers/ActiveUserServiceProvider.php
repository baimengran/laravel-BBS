<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/9
 * Time: 12:40
 */

namespace App\Http\ViewComposers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ActiveUserServiceProvider extends ServiceProvider
{

    public function boot()
    {
        View::composer([
            'topics.index', 'topics.show',
        ], 'App\Http\ViewComposers\ActiveUser');
    }

    public function register()
    {

    }
}