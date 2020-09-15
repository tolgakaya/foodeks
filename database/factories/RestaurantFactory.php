<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'description' => $faker->text(100),
        'phone' => $faker->phoneNumber,
        'address' => $faker->streetAddress,
        'email' => 'bilgitap@hotmail.com'
    ];
});