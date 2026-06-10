<?php

namespace App\Models\Resources\Medications;

use Database\Factories\MedicationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;
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

    public static function newFactory()
    {
        return MedicationFactory::new();
    }
}
