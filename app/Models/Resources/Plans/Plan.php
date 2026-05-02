<?php

namespace App\Models\Resources\Plans;

use App\Models\Resources\Encounter;
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
}
