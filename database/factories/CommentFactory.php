<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\News;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'comment' => $faker->text,
        'news_id' => fn() => News::query()->inRandomOrder()->first()
    ];
});
