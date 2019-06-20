<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Equipment;
use Faker\Generator as Faker;

$factory->define(Equipment::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'description' => $faker->text(30),
    ];
});
