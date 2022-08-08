<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Advertiser;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Advertiser::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'password' => Hash::make('12345678')
    ];
});
