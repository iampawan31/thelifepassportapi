<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FamilyRelation;
use Faker\Generator as Faker;

$factory->define(FamilyRelation::class, function (Faker $faker) {
    return [
        'title' => $faker->firstName,
        'status' => true
    ];
});
