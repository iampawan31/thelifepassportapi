<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PersonalEstate;
use App\PersonalEstateAddress;
use App\User;
use Faker\Generator as Faker;

$factory->define(PersonalEstateAddress::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'estate_id' => factory(PersonalEstate::class),
        'street_address1' => $faker->streetName,
        'street_address2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => '110028',
    ];
});
