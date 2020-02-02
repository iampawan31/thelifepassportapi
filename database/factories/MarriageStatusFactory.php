<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MarriageStatus;
use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(MarriageStatus::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'is_married' => false
    ];
});
