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
Route::get('users/{user}', 'UserController@show')->name('users.show');
Route::post('users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('users/{user}/update', 'UserController@editBasic')->name('users.editBasic');
Route::post('users/{user}/update', 'UserController@editAvatar')->name('users.editAvatar');

//帖子
Route::get('topics','TopicController@index')->name('topics.index');
Route::get('topics/{}');





