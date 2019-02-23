<?php

use Faker\Generator as Faker;

$factory->define(App\Articles::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->text(10),
        'preview' => $faker->unique()->text(40),
        'content' => $faker->unique()->text(500),
        'category_id' => $faker->numberBetween(1,4),
        'image' => 1,
        'is_active' => true,
        'url' => $faker->numberBetween(10000,40000),
    ];
});

