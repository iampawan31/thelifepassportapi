<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Country;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'country_code' => $faker->countryCode(),
        'country_name' => $faker->country()
    ];
});
