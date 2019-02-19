<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/18
 * Time: 17:38
 */

namespace App\Transformers;


use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'topic'];

    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'topic_id' => $comment->topic_id,
            'user_id' => $comment->user_id,
            'parent_id' => $comment->parent_id,
            'parent_user_id' => $comment->parent_user_id,
            'content' => $comment->content,
            'created_at' => $comment->created_at->toDateTimeString(),
            'updated_at' => $comment->updated_at->toDateTimeString(),
        ];
    }

    public function includeUser(Comment $comment)
    {
        return $this->item($comment->user, new UserTransformer());
    }

    public function includeTopic(Comment $comment)
    {
        return $this->item($comment->topic, new TopicTransformer());
    }
}