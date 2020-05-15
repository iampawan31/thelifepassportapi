<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FamilyMemberAddress;
use App\FamilyMembers;
use App\User;
use Faker\Generator as Faker;

$factory->define(FamilyMemberAddress::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'family_member_id' => factory(FamilyMembers::class),
        'street_address1' => $faker->streetAddress,
        'street_address2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->city,
        'zipcode' => '110028'
    ];
});
