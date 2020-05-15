<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PersonalEstateStatus;
use App\User;
use Faker\Generator as Faker;

$factory->define(PersonalEstateStatus::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'has_personal_estate' => false,
        'count' => 0
    ];
});
