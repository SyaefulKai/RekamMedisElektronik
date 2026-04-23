<?php

namespace App\Models;

use App\Models\Resources\Patient;
use App\Models\Resources\Practitioner;
use App\Observers\QueueObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
#[ObservedBy(QueueObserver::class)]
class Queue extends Model
{

    protected $fillable = [
        'patient_id',
        'practitioner_id',
        'queue_number',
        'date',
        'status'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class);
    }
}
