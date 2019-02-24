<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->email,
        'name' => $faker->unique()->name(),
        'password' => $faker->unique()->numberBetween(1000,2000),
        'role_id' => rand(0,1),
        'image' => $faker->imageUrl($width = 50, $height = 50, 'cats'),
        'image_public_id' => $faker->text(20)
    ];
});
