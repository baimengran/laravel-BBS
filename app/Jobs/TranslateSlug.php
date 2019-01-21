<?php

namespace App\Jobs;

use App\Handlers\SlugTranslateHandler;
use App\Models\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $topic;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Topic $topic)
    {
        \Log::info($topic->id);
        //
        $this->topic = $topic;
    }

    public function tags(){
        return ['添加slug','topic:'.$this->topic->id];
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //请求百度API接口进行翻译
        $slug = app(SlugTranslateHandler::class)->translate($this->topic->title);
        if ($slug == 'edit') {
            $slug = 'edit-slug';
        }
        //使用DB进行数据库操作，避免使用模型时模型监控器因分发任务，任务触发模型监控器，再次分发任务的死循环
        \DB::table('topics')->where('id', $this->topic->id)->update(['slug' => $slug]);
    }
}
