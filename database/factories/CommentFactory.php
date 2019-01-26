<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    //随机取一个月时间
    $time = $faker->dateTimeThisMonth();
    return [
        'content' => $faker->sentence,
        'created_at' => $time,
        'updated_at' => $time,
    ];
});
