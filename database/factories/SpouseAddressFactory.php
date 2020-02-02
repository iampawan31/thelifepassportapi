<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\SpouseAddress;
use App\SpouseInfo;
use Faker\Generator as Faker;

$factory->define(SpouseAddress::class, function (Faker $faker) {
    return [
        'user_id' => factory(SpouseInfo::class)->create(),
        'street_address1' => $faker->streetName,
        'street_address2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => '110028',
    ];
});
