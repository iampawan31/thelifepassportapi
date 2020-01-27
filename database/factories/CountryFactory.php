<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Countries;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Countries::class, function (Faker $faker) {
    return [
        'country_code' => $faker->countryCode(),
        'country_name' => $faker->country()
    ];
});
