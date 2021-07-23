<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ads_webpage;
use Faker\Generator as Faker;

$factory->define(ads_webpage::class, function (Faker $faker) {

    return [
        'ads_id' => $faker->randomDigitNotNull,
        'webpage_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
