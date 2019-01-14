<?php

use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //所有用户id数组
        $user_ids = User::all()->pluck('id')->toArray();
        //所有分类id数组
        $category_ids = Category::all()->pluck('id')->toArray();
        //获取faker实例
        $faker = app(\Faker\Generator::class);

        factory(Topic::class, 100)->create([
            'user_id' => $faker->randomElement($user_ids),
            'category_id' => $faker->randomElement($category_ids),
        ]);

    }
}
