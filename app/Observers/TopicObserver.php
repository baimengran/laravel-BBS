<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/18
 * Time: 16:46
 */

namespace App\Observers;


use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;
use App\Models\Topic;

class TopicObserver
{
    // creating, created, updating, updated, saving,
    // saved,  deleting, deleted, restoring, restored
    /**
     * Topic saving观察器方法
     * @param Topic $topic
     */
    public function saving(Topic $topic)
    {
        //HTMLPurifier for laravel HTML CSS JAVASCRIPT标签过滤
        $topic->body = clean($topic->body, 'user_topic_body');
        //生成话题摘要
        $topic->excerpt = make_excerpt($topic->body, 150);

    }

    public function saved(Topic $topic)
    {
        //如果slug字段为空，使用翻译器对title进行翻译
        if (!$topic->slug) {
            //翻译队列分发
            dispatch(new TranslateSlug($topic));
        }
    }


}