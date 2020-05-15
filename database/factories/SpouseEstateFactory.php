<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SpouseEstate;
use App\User;
use Faker\Generator as Faker;

$factory->define(SpouseEstate::class, function (Faker $faker) {
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
