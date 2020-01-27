<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserEmail;
use Faker\Generator as Faker;

$factory->define(UserEmail::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'email' => $faker->email,
        'password' => $faker->password
    ];
});
