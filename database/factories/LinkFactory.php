<?php

use App\Models\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    return [
        //
        'title'=>$faker->name,
        'link'=>$faker->url,
    ];
});
