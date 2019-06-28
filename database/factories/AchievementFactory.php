<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Achievement;
use Faker\Generator as Faker;

$factory->define(Achievement::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'icon' => 'some-icon.svg'
    ];
});
