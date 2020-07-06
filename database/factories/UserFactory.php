<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => $faker->randomElement([null, now()]),
        'password' => '$2y$10$00tMXBY4RP4gzyC7C9Y3Se2P61DZV9ShokANnxsmefmcW33XTA.ty', // 123456
        'remember_token' => $faker->randomElement([null, function() {
            return Str::random(10);
        }]),
    ];
});
