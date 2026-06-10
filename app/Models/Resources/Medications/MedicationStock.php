<?php

namespace App\Models\Resources\Medications;

use Illuminate\Database\Eloquent\Model;

class MedicationStock extends Model
{
    protected $fillable = [
        'medication_id',
        'batch_number',
        'quantity',
        'expired_at',
        'buy_price',
        'sell_price'
    ];

    protected $casts = [
        'expired_at' => 'date',
    ];

    public function medication()
    {
        return $this->belongsTo(Medication::class);
    }

    public function movements()
    {
        return $this->hasMany(MedicationMovement::class);
    }
}
