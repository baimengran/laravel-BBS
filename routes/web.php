<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//首页
Route::get('/', 'indexController@index')->name('home');
//关于
Route::get('/about', 'staticPagesController@about')->name('about');
//帮助
Route::get('/help', 'staticPagesController@help')->name('help');

//登录
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


//用户操作
Route::get('users/{user}', 'UsersController@show')->name('users.show');
Route::post('users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::put('users/{user}/update', 'UsersController@editBasic')->name('users.editBasic');
Route::post('users/{user}/update', 'UsersController@editAvatar')->name('users.editAvatar');

//帖子
Route::get('topics', 'TopicsController@index')->name('topics.index');
//Route::get('topics/{topic}/show', 'TopicsController@show')->name('topics.show');
Route::get('topics/create', 'TopicsController@create')->name('topics.create');
Route::post('topics', 'TopicsController@store')->name('topics.store');
//Simditor前端文本编辑器图片处理路由
Route::post('topics/upload_image', 'TopicsController@uploadImages')->name('topics.uploadImage');
Route::get('topics/{topic}/edit', 'TopicsController@edit')->name('topics.edit');
Route::put('topics/{topic}', 'TopicsController@update')->name('topics.update');
Route::delete('topics/{topic}', 'TopicsController@destroy')->name('topics.destroy');
//Slug显示路由 SEO友好路由
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

//根据分类显示帖子
Route::get('categories/{category}', 'CategoriesController@show')->name('categories.show');

//评论
Route::get('comments/{topic}/index', 'CommentsController@index')->name('comments.index');
Route::post('comments/{topic}/reply', 'CommentsController@reply')->name('comments.reply');





