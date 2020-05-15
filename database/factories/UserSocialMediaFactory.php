<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SocialMedia;
use App\User;
use App\UserSocialMedia;
use Faker\Generator as Faker;

$factory->define(UserSocialMedia::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'social_id' => factory(SocialMedia::class),
        'username' => $faker->userName,
        'password' => $faker->password,
        'is_primary' => false
    ];
});
