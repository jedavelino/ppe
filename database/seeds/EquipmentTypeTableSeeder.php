<?php

use App\EquipmentType;
use Illuminate\Database\Seeder;

class EquipmentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EquipmentType::class, 25)->create();
    }
}
