<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SpouseEstateStatus;
use App\User;
use Faker\Generator as Faker;

$factory->define(SpouseEstateStatus::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'has_spouse_estate' => false,
        'count' => 0
    ];
});
