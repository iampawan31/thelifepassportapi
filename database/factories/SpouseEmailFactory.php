<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\SpouseEmail;
use App\SpouseInfo;
use Faker\Generator as Faker;

$factory->define(SpouseEmail::class, function (Faker $faker) {
    return [
        'user_id' => factory(SpouseInfo::class),
        'email' => $faker->email,
        'password' => $faker->password
    ];
});
