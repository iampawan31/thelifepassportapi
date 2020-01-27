<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PersonalDetailsSteps;
use Faker\Generator as Faker;

$factory->define(PersonalDetailsSteps::class, function (Faker $faker) {
    return [
        'step' => 1,
        'slug' => 'sample',
        'percentage' => 10,
        'sequence' => 1
    ];
});
