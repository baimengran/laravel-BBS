<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/9
 * Time: 19:29
 */

namespace App\Observers;


use App\Models\Link;

class LinkObserver
{


    public function saved(Link $link)
    {
        //数据保存时清空cache_key对应的缓存
        \Cache::forget($link->cache_key);
    }
}