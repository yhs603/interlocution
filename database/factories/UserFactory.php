<?php

use Faker\Generator as Faker;

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

$factory->define(\Interlocution\Models\User::class, function (Faker $faker) {

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => bcrypt('111111'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\Interlocution\Model\Question::class, function (Faker $faker) {
    return [
        'user_id'           => random_int(1, 51),
        "category_id"       => '',
        'title'             => '',
        'description'       => '',
        'price'             => '',
        'answers_count'     => '',
        'views_count'       => '',
        'followers_count'   => '',
        'collections_count' => '',
        'comments_count'    => '',
        'status'            => '',
    ];
});
