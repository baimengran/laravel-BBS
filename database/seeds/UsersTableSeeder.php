<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $avatars = 'http://www.gravatar.com/avatar/9e455368a580d24584279ae20a82fc20?s=140';
        //
        $faker = app(\Faker\Generator::class);
        //生成数据
        $user = factory(User::class, 10)->create([
            'img' => $avatars,
        ]);

        //单独处理第一条数据
        $user = User::query()->find(1);
        $user->name = 'baimengran';
        $user->email = '450175191@qq.com';
        $user->save();
    }
}
