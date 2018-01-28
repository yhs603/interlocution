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
        'username'           => $faker->name,
        'email'              => $faker->unique()->safeEmail,
        'password'           => bcrypt('111111'),
        'remember_token'     => str_random(10),
        'confirmation_token' => $faker->uuid,
    ];
});

$factory->define(\Interlocution\Models\Question::class, function (Faker $faker) {
    return [
        'user_id'           => random_int(1, 51),
        "category_id"       => random_int(1, 5),
        'title'             => $faker->sentence,
        'description'       => $faker->text,
        'experience'        => $faker->randomDigitNotNull,
        'answers_count'     => $faker->randomDigitNotNull,
        'views_count'       => $faker->randomDigitNotNull,
        'followers_count'   => $faker->randomDigitNotNull,
        'collections_count' => $faker->randomDigitNotNull,
        'comments_count'    => $faker->randomDigitNotNull,
        'status'            => $faker->numberBetween(0, 1),
    ];
});

$factory->define(\Interlocution\Models\Answer::class, function (Faker $faker) {
    $question = factory(\Interlocution\Models\Question::class)->create();

    return [
        'user_id'        => random_int(1, 51),
        'question_id'    => $question->id,
        'question_title' => $question->title,
        'content'        => $faker->paragraph,
        'status'         => 1,
    ];
});
