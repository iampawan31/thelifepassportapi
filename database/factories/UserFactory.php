<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => null,
        'is_active' => false,
        'role' => 2,
        'phone_number' => '7973601201',
        'password' => Hash::make('pawan123'), // password
        'remember_token' => Str::random(10),
        'api_token' => Str::random(80),
    ];
});

$factory->state(App\User::class, 'verified', [
    'is_active' => true,
    'email_verified_at' => Carbon::now()
]);
