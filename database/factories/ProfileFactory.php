<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->userName,
        'text' => $faker->sentence,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
