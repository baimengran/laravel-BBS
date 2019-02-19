<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api\V1',
    'middleware' => ['serializer:array', 'bindings'],
], function ($api) {
    $api->get('version', function () {
        return response('这里是 vi 版本');
    });
    //登录注册
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {
        //图片验证码
        $api->post('captchas', 'CaptchasController@store')->name('api.captchas.store');
        //发送短信验证码
        $api->post('verificationCodes', 'VerificationCodesController@store')
            ->name('api.verificationCodes.store');
        //用户注册
        $api->post('users', 'UsersController@store')->name('api.users.store');

        //账号密码登录
        $api->post('authorizations', 'AuthorizationsController@store')->name('api.authorizations.store');
        //第三方登录
        $api->post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')->name('api.socials.authorizations.store');
        //刷新token
        $api->put('authorizations/current', 'AuthorizationsController@update')->name('api.authorizations.update');
        //删除token
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')->name('api.authorizations.destroy');

    });

    //数据请求
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires'),
    ], function ($api) {
        //游客可以访问接口
        //分类列表
        $api->get('categories', 'CategoriesController@index')->name('api.categories.index');
        //话题列表
        $api->get('topics', 'TopicsController@index')->name('api.topics.index');
        //话题评论列表
        $api->get('topics/{topic}/comments', 'CommentsController@index')->name('api.topics.comment.index');
        //用户发布的话题列表
        $api->get('users/{user}/topics', 'TopicsController@userIndex')->name('api.users.topics.index');
        //用户发布的评论列表
        $api->get('users/{user}/comments', 'CommentsController@userIndex')->name('api.users.comments.index');
        //话题详情
        $api->get('topics/{topic}', 'TopicsController@show')->name('api.topics.show');

        //需要token验证的接口
        $api->group(['middleware' => 'api.auth'], function ($api) {
            //当前登录用户权限
            $api->get('user/permissions', 'PermissionsController@index')->name('api.user.permissions.index');

            //当前登录用户信息
            $api->get('user', 'UsersController@me')->name('api.user.show');
            //编辑登录用户信息
            $api->patch('user', 'UsersController@update')->name('api.user.update');
            //图片资源
            $api->post('images', 'ImagesController@store')->name('api.images.store');
            //发布话题
            $api->post('topics', 'TopicsController@store')->name('api.topics.store');
            //修改话题
            $api->patch('topics/{topic}', 'TopicsController@update')->name('api.topics.update');
            //删除话题
            $api->delete('topics/{topic}', 'TopicsController@destroy')->name('api.topics.destroy');
            //添加评论
            $api->post('topics/{topic}/comments', 'CommentsController@store')->name('api.topics.comments.store');
            //删除评论
            $api->delete('topics/{topic}/comments/{comment}', 'CommentsController@destroy')->name('api.topics.comments.destroy');
            //评论通知列表
            $api->get('user/notifications', 'NotificationsController@index')->name('api.user.notifications.index');
            //通知统计
            $api->get('user/notifications/stats', 'NotificationsController@stats')->name('api.user.notifications.stats');
            //标记消息已读
            $api->patch('user/read/notifications', 'NotificationsController@read')->name('api.user.notification.read');

        });
    });

});


$api->version('v2', function ($api) {
    $api->get('version', function () {
        return response('这里是 v2 版本');
    });
});