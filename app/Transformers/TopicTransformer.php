<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/16
 * Time: 20:29
 */

namespace App\Transformers;


use App\Models\Topic;
use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract
{
    protected $fields=[];
    protected $except_fields=[];
    protected $availableIncludes = ['user', 'category'];

    public function __construct($fields = null,$except_fields=null)
    {
        $this->fields=explode(',',$fields);
        $this->except_fields = explode(',',$except_fields);
    }

    public function transform(Topic $topic)
    {
        //可选字段
        if(!count($this->fields)){
            $data = [];
            foreach($this->fields as $field){
                $data[$field]=$topic->$field;
            }
            return $data;
        }
        return [
            'id' => $topic->id,
            'title' => $topic->title,
            'body' => $topic->body,
            'user_id' => $topic->user_id,
            'category_id' => (int)$topic->category_id,
            'reply_count' => (int)$topic->reply_count,
            'view_count' => (int)$topic->view_count,
            'last_reply_user_id' => (int)$topic->last_reply_user_id,
            'excerpt' => $topic->excerpt,
            'slug' => $topic->slug,
            'created_at' => $topic->created_at->toDateTimeString(),
            'updated_at' => $topic->updated_at->toDateTimeString(),
        ];
    }

    public function includeUser(Topic $topic)
    {
        return $this->item($topic->user, new UserTransformer());
    }

    public function includeCategory(Topic $topic)
    {
        return $this->item($topic->category, new CategoryTransformer());
    }
}