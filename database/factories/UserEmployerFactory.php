<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserEmployer;
use Faker\Generator as Faker;

$factory->define(UserEmployer::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'employer_name' => $faker->name,
        'employer_phone' => '8123565698',
        'computer_username' => $faker->userName,
        'computer_password' => $faker->password,
    ];
});
