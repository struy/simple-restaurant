<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Dishe::class, function (Faker\Generator $faker) {


    return [
        'name' => $faker->word,
        'cooking_time' => rand(5, 60),

    ];
});


$factory->define(App\Order::class, function (Faker\Generator $faker) {


    return [
        'users_id' => rand(1, 3),
        'dishes_id' => rand(1, 50),
        'quantity' => rand(1, 20),
        'number_table' => rand(1, 25),
        ];
});
