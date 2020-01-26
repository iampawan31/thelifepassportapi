<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserPhone;
use Faker\Generator as Faker;

$factory->define(UserPhone::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'phone' => '8123565698',
        'is_primary' => false
    ];
});
