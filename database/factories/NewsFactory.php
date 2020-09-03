<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'name' => $faker->words(rand(1, 3), true),
        'content' => $faker->paragraph,
        'picture' => $faker->picsum(config('news.pictures_path'), 400, 400, false),
    ];
});
