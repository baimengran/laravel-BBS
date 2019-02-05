<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/29
 * Time: 19:16
 */

namespace App\Observers;


use App\Models\Comment;
use App\Notifications\TopicReplied;

class CommentObserver
{

    // creating, created, updating, updated, saving,
    // saved,  deleting, deleted, restoring, restored

    public function created(Comment $comment)
    {
        $comment->topic->increment('reply_count', 1);

        //消息通知 通知话题所有者有新的评论
        $comment->topic->user->topicNotify(new TopicReplied($comment));

    }

    /**
     * 过滤XSS安全漏洞
     * @param Comment $comment
     */
    public function creating(Comment $comment)
    {
        $comment->content = clean($comment->content, 'user_topic_body');
    }


    public function deleted(Comment $comment)
    {
        if ($comment->reply_count > 0) {
            $comment->topic->decrement('reply_count', 1);
        }
    }

}