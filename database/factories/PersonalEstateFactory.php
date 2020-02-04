<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PersonalEstate;
use App\User;
use Faker\Generator as Faker;

$factory->define(PersonalEstate::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'legal_name' => $faker->firstName,
        'relationship' => '',
        'company' => $faker->company,
        'phone' => '8123565698',
        'email' => $faker->companyEmail,
        'website' => $faker->url
    ];
});
