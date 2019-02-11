<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //

    protected $fillable = ['title', 'link'];

    public $cache_key = 'larablog_links';
    protected $cache_expire_in_minutes = 1440;

    public function getAllCached()
    {
        //尝试从缓存中取出cache_key 对应的数据，如果有直接返回数据。
        //否则运行匿名函数中的代码，取出 links 表中所有数据，返回同时做缓存
        return \Cache::remember($this->cache_key, $this->cache_expire_in_minutes, function () {
            return $this->all();
        });
    }
}
