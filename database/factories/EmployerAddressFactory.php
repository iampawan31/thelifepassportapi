<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EmployerAddress;
use Faker\Generator as Faker;

$factory->define(EmployerAddress::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'employer_id' => factory(\App\UserEmployer::class),
        'street_address1' => $faker->streetName,
        'street_address2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => '110028',
    ];
});
