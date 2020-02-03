<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FamilyMembers;
use App\FamilyRelation;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(FamilyMembers::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'legal_name' => $faker->firstName,
        'relationship_id' => factory(FamilyRelation::class),
        'email' => $faker->email,
        'dob' => Carbon::now(),
    ];
});
