<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PersonalEmployerBenefits;
use Faker\Generator as Faker;

$factory->define(PersonalEmployerBenefits::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'employer_id' => factory(App\UserEmployer::class),
        'benefit_id' => factory(App\EmployerBenefitsMaster::class),
    ];
});
