<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Status;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence,
        'pinned' => false,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});