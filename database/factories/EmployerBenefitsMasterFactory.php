<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EmployerBenefitsMaster;
use Faker\Generator as Faker;

$factory->define(EmployerBenefitsMaster::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'status' => true,
    ];
});
