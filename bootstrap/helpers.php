<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11
 * Time: 0:43
 */

/**
 * 返回路径名称供页面class使用
 * @return string 路由名称字符串
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}