<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->text(15),
        'url' => $faker->numberBetween(1000,2000),
    ];
});