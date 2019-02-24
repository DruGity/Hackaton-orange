<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->text(10),
        'content' => $faker->unique()->text(500),
        'category_id' => $faker->numberBetween(1,4),
        'image' => $faker->imageUrl($width = 300, $height = 180, 'cats'),
        'image_public_id' => $faker->text(20),
        'is_active' => true,
        'is_main' => false,
        'url' => $faker->numberBetween(10000,40000),
    ];
});

