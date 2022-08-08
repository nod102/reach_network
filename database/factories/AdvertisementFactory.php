<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Advertisement;
use App\Models\Tag;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Advertisement::class, function (Faker $faker) {
    return [
        'title' => $faker->company(),
        'description' => $faker->text(),
        'start_date' => $faker->dateTimeInInterval('-1 week', '+3 days'),
        'type' => $faker->randomElement(['free', 'paid']),
        'advertiser_id' => $faker->name(),
        'category_id' => $faker->name(),
        'tags' => Tag::inRandomOrder()->limit(5)->pluck('id')
    ];
});
