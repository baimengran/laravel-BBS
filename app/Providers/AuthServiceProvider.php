<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\TopicPolicy;
use App\Policies\UserPolicy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Horizon\Horizon;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Topic::class => TopicPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //passport路由
        Passport::routes();
        //passport access_token过期时间
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        //passport refreshTokens过期时间
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        //定义horizon访问权限
        Horizon::auth(function ($request) {
            //是否是站长
            return \Auth::user()->hasRole('Founder');
        });
    }
}
