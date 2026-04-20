<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQueueRequest;
use App\Models\Queue;
use App\Models\Resources\Patient;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function store(Patient $patient)
    {
        Queue::create([
            'patient_id' => $patient->id,
        ]);
        return redirect()->to(route('patient.index'));
    }
}
