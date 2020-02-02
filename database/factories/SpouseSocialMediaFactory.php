<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\SocialMedia;
use App\SpouseInfo;
use App\SpouseSocialMedia;
use Faker\Generator as Faker;

$factory->define(SpouseSocialMedia::class, function (Faker $faker) {
    return [
        'user_id' => factory(SpouseInfo::class),
        'social_id' => factory(SocialMedia::class),
        'username' => $faker->userName,
        'password' => $faker->password,
        'is_primary' => false
    ];
});
