<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\SpouseEmployer;
use App\SpouseInfo;
use Faker\Generator as Faker;

$factory->define(SpouseEmployer::class, function (Faker $faker) {
    return [
        'user_id' => factory(SpouseInfo::class),
        'employer_name' => $faker->name,
        'employer_phone' => '8123565698',
        'computer_username' => $faker->firstName,
        'computer_password' => $faker->password,
    ];
});
