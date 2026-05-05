<?php

namespace App\Models\Resources\Medications;

use Illuminate\Database\Eloquent\Model;

class MedicationMovement extends Model
{
    protected $fillable = [
        'medication_stock_id',
        'type',
        'quantity',
        'quantity_before',
        'quantity_after',
        'note',
        'moved_at',
    ];

    public function stock()
    {
        return $this->belongsTo(MedicationStock::class, 'medication_stock_id');
    }
}
