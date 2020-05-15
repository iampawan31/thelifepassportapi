<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EmployerBenefitsMaster;
use App\PersonalEmployerBenefits;
use App\UserEmployer;
use Faker\Generator as Faker;

$factory->define(PersonalEmployerBenefits::class, function (Faker $faker) {
    return [
        'employer_id' => factory(UserEmployer::class),
        'benefit_id' => factory(EmployerBenefitsMaster::class),
    ];
});
