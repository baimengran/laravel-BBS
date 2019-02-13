<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/11
 * Time: 14:32
 */

namespace App\Models\Traits;


use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

trait LastActivedAtHelper
{
    //缓存相关
    protected $hash_prefix = 'larablog_last_actived_at_';
    protected $field_prefix = 'user_';

    /**
     * 将用户id与user组合后（user_id）作为field
     * 当前时间作为value
     * 保存到 redis 的哈希表中
     */
    public function recordLastActivedAt()
    {
        //Redis哈希表今日的命名，如：larablog_last_actived_at_2018-12-21
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());

        //字段名称，如：user_1
        $field = $this->getHashField();
        //dd(Redis::hGetAll($hash));
        //当前时间，如：2018-12-21 08:20:20
        $now = Carbon::now()->toDateTimeString();

        //写入Redis，字段已存在会被更新
        Redis::hSet($hash, $field, $now);
    }

    /**
     * 定期将 redis 中哈希表数据持久化到数据库
     */
    public function syncUserActivedAt()
    {
        //Redis 哈希表昨日的命名，如：larablog_last_actived_at_2018-12-19
        $hash = $this->getHashFromDateString(Carbon::yesterday()->toDateString());

        //从Redis中获取所有哈希表中的数据
        $datas = Redis::hGetAll($hash);


        //遍历，并同步到数据库中
        foreach ($datas as $user_id => $actived_at) {
            //将 redis 哈希表中的field(user_id)转换为数字(1)
            $user_id = str_replace($this->field_prefix, '', $user_id);
//            //只有当用户存在时才能更新到数据库中
            if ($user = $this->find($user_id)) {
                $user->last_actived_at = $actived_at;
                $user->save();
            }
        }
        //以数据库存储后，删除 Redis 哈希表数据
        Redis::del($hash);
    }


    public function getLastActivedAtAttribute($value)
    {
        //redis 哈希表今日对应的名称，如:larablog_last_actived_2018-12-20
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());

        //字段名称，如：user_1
        $field = $this->getHashField();

        //优先选择redis数据，否则选择数据库数据
        $datetime = Redis::hGet($hash, $field) ?: $value;

        //如果存在的话，返回时间对应的carbon实体
        if ($datetime) {
            return new Carbon($datetime);

        } else {
            //否则使用用户注册时间
            return $this->created_at;
        }
    }


    public function getHashFromDateString($date)
    {
        //Redis 哈希表的命名，如：larablog_last_actived_at_2018-12-20
        return $this->hash_prefix . $date;
    }


    public function getHashField()
    {
        //字段名称,如：user_1
        return $this->field_prefix . $this->id;
    }
}