<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\EquipmentType;
use Faker\Generator as Faker;

$factory->define(EquipmentType::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
    ];
});
