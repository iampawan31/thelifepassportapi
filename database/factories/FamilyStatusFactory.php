<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FamilyStatus;
use App\User;
use Faker\Generator as Faker;

$factory->define(FamilyStatus::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'has_family_member' => false,
        'count' => 0
    ];
});
