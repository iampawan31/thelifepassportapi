<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PersonalInfo;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(PersonalInfo::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'legal_name' => $faker->name,
        'nickname' => $faker->name,
        'dob' => Carbon::now(),
        'country_id' => "1",
        'passport_number' => '1234566778',
        'father_name' => $faker->name,
        'father_birth_place' => $faker->name,
        'mother_name' => $faker->name,
        'mother_birth_place' => $faker->name
    ];
});
