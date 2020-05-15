<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EmployerBenefitsMaster;
use App\Model;
use App\SpouseEmployer;
use App\SpouseEmployerBenefits;
use Faker\Generator as Faker;

$factory->define(SpouseEmployerBenefits::class, function (Faker $faker) {
    return [
        'employer_id' => factory(SpouseEmployer::class),
        'benefit_id' => factory(EmployerBenefitsMaster::class),
    ];
});
