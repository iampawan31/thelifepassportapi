<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SpouseEstate;
use App\SpouseEstateAddress;
use App\User;
use Faker\Generator as Faker;

$factory->define(SpouseEstateAddress::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'spouse_estate_id' => factory(SpouseEstate::class),
        'street_address1' => $faker->streetName,
        'street_address2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->city,
        'zipcode' => '110028',
    ];
});
