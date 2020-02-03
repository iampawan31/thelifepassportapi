<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FamilyMembers;
use App\FamilyPhone;
use App\User;
use Faker\Generator as Faker;

$factory->define(FamilyPhone::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'family_member_id' => factory(FamilyMembers::class),
        'phone' => '8123565698'
    ];
});
