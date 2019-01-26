<?php

use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //所有用户id数组，
        $user_ids = User::all()->pluck('id')->toArray();

        //所有话题id数组
        $topic_ids = Topic::all()->pluck('id')->toArray();

        //获取Faker实例
        $faker = app(\Faker\Generator::class);

        $comments = factory(Comment::class)
            ->times(500)
            ->make()
            ->each(function ($comment, $index) use ($user_ids, $topic_ids, $faker) {
                //从用户id数组中随机取出一个并赋值
                $comment->user_id = $faker->randomElement($user_ids);

                //从话题id数组随机取出一个并赋值
                $comment->topic_id = $faker->randomElement($topic_ids);
            });

        //将数据集合转换为数组，并插入数据库中
        Comment::insert($comments->toArray());

        $commentAll = Comment::all()->toArray();

        $comments = factory(Comment::class, 500)
            ->make()
            ->each(function ($comment, $index) use ($commentAll, $user_ids, $faker) {

                $comments = $faker->randomElement($commentAll);
                $comment->topic_id = $comments['topic_id'];
                $comment->parent_user_id = $comments['user_id'];
                $comment->parent_id = $comments['id'];
                $comment->user_id=$faker->randomElement($user_ids);
            });
        Comment::insert($comments->toArray());

    }
}
