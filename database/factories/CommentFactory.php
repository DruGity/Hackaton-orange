<?php

use Faker\Generator as Faker;

$factory->define(App\Comments::class, function (Faker $faker) {
    return [
        'comment' => $faker->unique()->text(20),
        'user_id' => $faker->numberBetween(1,10),
        'article_id' => $faker->numberBetween(1,29)
    ];
});
