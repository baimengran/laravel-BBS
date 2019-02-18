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

    public function comment()
    {
        return $this->hasMany(Comment::class);
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

    /**
     * 本地查询作用于排序功能
     * @param $query
     * @param $order
     * @return mixed
     */
    public function scopeWithOrder($query, $order)
    {
        //不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            case 'recent':
                $query = $this->recent();
                break;
            default:
                $query = $this->recentReplied();
                break;
        }
        //预加载防止N+1
        return $query->with('user', 'category');
    }

    /**
     * 本地查询作用域 倒序
     * @param $query
     * @return mixed
     */
    public function scopeRecent($query)
    {
        //按创建时间排序
        return $query->orderBy('created_at', 'desc');
    }


    public function scopeRecentReplied($query)
    {
        //当话题有新回复时，会自动更新话题模型reply_count字段
        //此时会自动触发框架对数据模型updated_at时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }
}
