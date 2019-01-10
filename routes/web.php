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

//注册
Route::get('/register', 'Auths\registerController@show')->name('register');
Route::post('/register', 'Auths\registerController@store')->name('register');

//会话控制
Route::get('/login', 'Auths\LoginController@show')->name('login');
Route::post('/login', 'Auths\LoginController@login')->name('login');
Route::delete('/logout', 'Auths\LoginController@logout')->name('logout');


//用户显示
Route::get('/users/{user}', 'UsersController@show')->name('users.show');
//修改密码
Route::post('users/{user}/edit', 'UsersController@edit')->name('users.edit');