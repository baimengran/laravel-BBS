<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Link;
use App\Models\Topic;
use App\Models\User;
use App\Observers\CommentObserver;
use App\Observers\LinkObserver;
use App\Observers\TopicObserver;
use App\Observers\UserObserver;
use Carbon\Carbon;
use Dingo\Api\Facade\API;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //修改时间中文
        Carbon::setLocale('zh');
        //topic观观察着
        Topic::observe(TopicObserver::class);
        //Comment观察者
        Comment::observe(CommentObserver::class);
        //User观察者
        User::observe(UserObserver::class);
        //Link观察者
        Link::observe(LinkObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //注册laravel-ide-helper
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }

        //修改DingoApi默认异常行为
        API::error(function (ModelNotFoundException $exception) {
            abort(404,$exception->getMessage());
        });

        API::error(function (AuthorizationException $exception) {
            abort(403, $exception->getMessage());
        });
    }
}
