<?php

use Faker\Generator as Faker;

$factory->define(App\PhoneNote::class, function (Faker $faker) {
    $users = \App\User::all();

    return [
        'name'    => $faker->name,
        'number'  => $faker->phoneNumber,
        'user_id' => rand(1, $users->count()),
    ];
});
