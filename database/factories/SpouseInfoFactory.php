<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SpouseInfo;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(SpouseInfo::class, function (Faker $faker) {
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
        'mother_birth_place' => $faker->name,
        'marriage_date' => Carbon::now(),
        'marriage_location' => $faker->city
    ];
});
