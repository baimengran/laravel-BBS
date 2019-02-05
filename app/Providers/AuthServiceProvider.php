<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\TopicPolicy;
use App\Policies\UserPolcy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolcy::class,
        Topic::class => TopicPolicy::class,
        Comment::class=>CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
