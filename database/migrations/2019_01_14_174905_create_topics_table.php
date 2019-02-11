<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->comment('标题');
            $table->text('body')->comment('帖子内容');
            $table->unsignedInteger('user_id')->unsigned()->index()->comment('用户id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('category_id')->unsigned()->index()->comment('分类id');
            $table->unsignedInteger('reply_count')->unsigned()->default(0)->comment('回复数量');
            $table->unsignedInteger('view_count')->unsigned()->default(0)->comment('查看数量');
            $table->unsignedInteger('last_reply_user_id')->unsigned()->default(0)->comment('最后回复的用户id');
            $table->unsignedInteger('order')->default(0)->comment('排序');
            $table->text('excerpt')->nullable()->comment('文章摘要，SEO优化使用');
            $table->string('slug')->nullable()->comment('SEO友好URI');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
