<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PersonalAddress;
use App\User;
use Faker\Generator as Faker;

$factory->define(PersonalAddress::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create(),
        'street_address1' => $faker->streetName,
        'street_address2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => '110028',
    ];
});
