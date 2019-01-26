<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id')->index()->default(0)->comment('话题id');
            $table->unsignedInteger('user_id')->index()->default(0)->comment('用户id');
            $table->unsignedInteger('parent_id')->default(0)->comment('回复评论id');
            $table->unsignedInteger('parent_user_id')->default(0)->comment('回复评论用户id');
            $table->text('content')->comment('评论文本');
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
        Schema::dropIfExists('comments');
    }
}
