<?php

use Faker\Generator as Faker;

$factory->define(App\Categories::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->text(15),
        'url' => $faker->numberBetween(1000,2000),
    ];
});
