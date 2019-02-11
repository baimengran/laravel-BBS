<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/9
 * Time: 7:59
 */

namespace App\Models\Traits;


use App\Models\Comment;
use App\Models\Topic;
use Carbon\Carbon;

trait ActiveUserHelper
{
    //用于存放临时用户数据
    protected $users = [];

    //配置信息

    protected $topic_weight = 4;//话题权重
    protected $comment_wight = 1;//回复权重
    protected $pass_days = 7;//多少天内发表过内容
    protected $user_number = 6;//取出来多少用户

    //缓存相关配置
    protected $cache_key = 'larablog_active_users';
    protected $cache_expire_in_minutes = 65;

    /**
     * 缓存中获取活跃用户，缓存内没有时
     * 执行calculateActiveUsers()方法获取并加入缓存
     * @return mixed
     */
    public function getActiveUsers()
    {
        //尝试从缓存中取出cache_key 对应的数据，如果能取到，直接返回数据
        //否则运行匿名函数中的代码取出活跃用户数据，返回时做缓存
        return \Cache::remember($this->cache_key, $this->cache_expire_in_minutes, function () {
            return $this->calculateActiveUsers();
        });
    }

    /**
     * 获取活跃用户表并加入缓存
     */
    public function calculateAndCacheActiveUsers()
    {
        //获取活跃用户列表
        $active_users = $this->calculateActiveUsers();
        //加入缓存
        $this->cacheActiveUsers($active_users);
    }

    /**
     * 根据users[]临时数组中用户得分进行排序，并取出特定数量 $this->user_number用户得分数据
     * 添加到集合中返回
     * @return \Illuminate\Support\Collection 用户得分数据
     */
    private function calculateActiveUsers()
    {
        $this->calculateTopicScore();
        $this->calculateCommentScore();

        //数组按得分排序
        $users = array_sort($this->users, function ($user) {
            return $user['score'];
        });

        //数组倒序，高分靠前，第二个参数保持数组的 KEY 不变
        $users = array_reverse($users, true);

        //只获取指定数量的用户
        $users = array_slice($users, 0, $this->user_number, true);

        //新建集合
        $active_users = collect();

        foreach ($users as $user_id => $user) {
            //查询是否可以找到当前用户
            $user = $this->find($user_id);

            //如果数据库有该用户
            if ($user) {
                //将此用户实体放入集合的末尾
                $active_users->push($user);
            }
        }
        //返回数据
        return $active_users;
    }

    /**
     * 话题表取出特定时间发布过话题的用户和该用户此时间段内发布话题的数量
     * 根据话题数量使用权重$this->topic_weight计算每个用户得分，并将得分保存在users[]临时数组
     */
    private function calculateTopicScore()
    {
        //从话题数据表中取出限定时间范围$this->pass_days(const PASS_DAYS)内有发表过话题的用户
        //并且同时取出用户此段时间内发布话题的数量
        $topic_users = Topic::query()
            ->select(\DB::raw('user_id,count(*) as topic_count'))
            ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
            ->groupBy('user_id')
            ->get();

        //根据话题数量计算得分
        foreach ($topic_users as $value) {
            $this->users[$value->user_id]['score'] = $value->topic_count * $this->topic_weight;
        }
    }

    /**
     * 评论表取出特定时间发表评论用户，和该用户在此时间段内发布评论的数量
     * 根据评论数量使用权重$this->comment_weight计算每个用户得分，并与话题得分相加后保存在users[]临时数组内
     */
    private function calculateCommentScore()
    {
        //从评论数据表中取出限定时间范围$this->pass_days内有发表过评论的用户
        //并且同时取出用户在此时间段内发布评论的数量
        $comment_users = Comment::query()
            ->select(\DB::raw('user_id,count(*) as comment_count'))
            ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
            ->groupBy('user_id')
            ->get();

        //根据评论数量计算得分
        foreach ($comment_users as $value) {
            $comment_score = $value->comment_count * $this->comment_wight;
            if (isset($this->users[$value->user_id])) {
                $this->users[$value->user_id]['score'] += $comment_score;
            } else {
                $this->users[$value->user_id]['score'] = $comment_score;
            }
        }
    }

    /**
     * 将活跃用户列表保存到缓存
     * @param $active_users
     */
    private function cacheActiveUsers($active_users)
    {
        //将数据放入缓存
        \Cache::put($this->cache_key, $active_users, $this->cache_expire_in_minutes);
    }
}