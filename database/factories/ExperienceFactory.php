<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Experience;
use Faker\Generator as Faker;

$factory->define(Experience::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'points' => 0,
    ];
});
