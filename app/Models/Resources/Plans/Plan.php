<?php

namespace App\Models\Resources\Plans;

use App\Models\Resources\Encounter;
use App\Models\Resources\Procedure;
use App\Models\Resources\Plans\PlanProcedure;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'encounter_id'
    ];

    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }

    public function procedures()
    {
        return $this->hasMany(PlanProcedure::class, 'plan_id');
    }
}
