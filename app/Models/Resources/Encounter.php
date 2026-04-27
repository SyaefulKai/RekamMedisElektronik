<?php

namespace App\Models\Resources;

use App\Models\Queue;
use App\Observers\EncounterObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(EncounterObserver::class)]
class Encounter extends Model
{
    use HasUuids;
    protected $fillable = [
        'patient_id',
        'practitioner_id',
        'queue_id',
        'uuid',
        'status',
        'date'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class);
    }

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }

    public function subjective()
    {
        return $this->hasOne(Subjective::class);
    }

    public function objective()
    {
        return $this->hasOne(Objective::class);
    }

    public function uniqueIds(): array
    {
        return [
            'uuid'
        ];
    }
}
