<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\UserEmployer;
use Faker\Generator as Faker;

$factory->define(UserEmployer::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'employer_name' => $faker->name,
        'employer_phone' => '8123565698',
        'computer_username' => $faker->firstName,
        'computer_password' => $faker->password,
    ];
});
