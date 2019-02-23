<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->email,
        'name' => $faker->unique()->name(),
        'password' => $faker->unique()->numberBetween(1000,2000),
    ];
});
