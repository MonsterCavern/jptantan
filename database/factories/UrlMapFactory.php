<?php

use Faker\Generator as Faker;

$factory->define(App\Models\UrlMap::class, function (Faker $faker) {
    $sentence = $faker->sentence(5);
    return [
        'url'   => $faker->url,
        'title' => substr($sentence, 0, strlen($sentence) - 1)
    ];
});
