<?php

namespace App\Models\Resources\Plans;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Plans\Plan;
use App\Models\Resources\Medications\Medication;
use App\Models\Resources\Medications\MedicationStock;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PlanMedication extends Model
{
    protected $table = 'plan_medications';

    protected $fillable = [
        'plan_id',
        'medication_id',
        'medication_stock_id',
        'frequency_per_day',
        'dose_per_take',
        'quantity',
        'instruction'
    ];

    protected $appends = ['name'];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function medication()
    {
        return $this->belongsTo(Medication::class, 'medication_id');
    }

    public function medicationStock()
    {
        return $this->belongsTo(MedicationStock::class, 'medication_stock_id');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->medication ? ($this->medication->trade_name ?? $this->medication->generic_name) : null,
        );
    }
}
