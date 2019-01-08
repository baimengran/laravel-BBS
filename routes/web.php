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
//注册
Route::get('register','registerController@home')->name('signup');
//关于
Route::get('/about', 'staticPagesController@about')->name('about');
//帮助
Route::get('/help', 'staticPagesController@help')->name('help');

