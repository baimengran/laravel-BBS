<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 修改路由，可包含slug参数路由，（SEO友好路由）
     * @param array $params 附加URL参数
     * @return string 路由地址
     */
    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }
}
