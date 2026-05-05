<?php

namespace App\Models\Resources\Medications;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $fillable = [
        'generic_name',
        'trade_name',
        // 'category',
        'form',
        'strength',
        'unit',
        'is_active'
    ];

    public function stocks()
    {
        return $this->hasMany(MedicationStock::class);
    }
}
