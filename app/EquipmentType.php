<?php

namespace App;

use App\Equipment;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    public function equipments()
    {
        return $this->hasMany(Equipment::class, 'type_id');
    }
}
