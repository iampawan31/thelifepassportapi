<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserSocialMedia;
use Faker\Generator as Faker;

$factory->define(UserSocialMedia::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'social_id' => factory(App\SocialMedia::class),
        'username' => $faker->userName,
        'password' => $faker->password,
        'is_primary' => false
    ];
});
