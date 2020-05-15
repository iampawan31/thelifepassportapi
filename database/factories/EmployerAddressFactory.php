<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EmployerAddress;
use App\User;
use App\UserEmployer;
use Faker\Generator as Faker;

$factory->define(EmployerAddress::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'employer_id' => factory(UserEmployer::class),
        'street_address1' => $faker->streetName,
        'street_address2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => '110028',
    ];
});
