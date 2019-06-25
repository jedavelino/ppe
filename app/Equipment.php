<?php

namespace App;

use App\EquipmentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type_id', 'description',
    ];

    public function type() 
    {
        return $this->belongsTo(EquipmentType::class);
    }
}
