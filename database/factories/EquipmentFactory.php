<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Equipment;
use Faker\Generator as Faker;

$factory->define(Equipment::class, function (Faker $faker) {
    $equipmentTypes = App\EquipmentType::pluck('id')->toArray();
    return [
        'name' => $faker->text(10),
        'description' => $faker->text(30),
        'type_id' => function() {
            return factory(App\EquipmentType::class)->create()->id;
        },
    ];
});
