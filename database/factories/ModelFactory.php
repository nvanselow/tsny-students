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

$factory->define('Tsny\Models\User', function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => $faker->password,
        'remember_token' => str_random(10),
    ];
});

$factory->define('Tsny\Models\Student', function ($faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'nickname' => substr(strtoupper($faker->firstName), 0, 3),
        'primary_school' => 1
    ];
});

$factory->define('Tsny\Models\Note', function ($faker) {
    return [
        'note' => $faker->sentence
    ];
});

$factory->define('Tsny\Models\Skill', function ($faker) {
    return [
        'name' => $faker->word,
        'proficiency' => rand(0, 3),
        'current' => $faker->boolean,
        'note' => $faker->sentence
    ];
});

$factory->define('Tsny\Models\Goal', function ($faker) {
    return [
        'description' => $faker->sentence,
        'complete' => $faker->boolean
    ];
});