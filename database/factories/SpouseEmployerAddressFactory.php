<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\SpouseEmployer;
use App\SpouseEmployerAddress;
use App\SpouseInfo;
use App\User;
use App\UserEmployer;
use Faker\Generator as Faker;

$factory->define(SpouseEmployerAddress::class, function (Faker $faker) {
    return [
        'user_id' => factory(SpouseInfo::class),
        'employer_id' => factory(SpouseEmployer::class),
        'street_address1' => $faker->streetName,
        'street_address2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => '110028',
    ];
});
