<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\SpouseInfo;
use App\SpousePhone;
use Faker\Generator as Faker;

$factory->define(SpousePhone::class, function (Faker $faker) {
    return [
        'user_id' => factory(SpouseInfo::class)->create(),
        'phone' => '8123565698',
        'is_primary' => false
    ];
});
