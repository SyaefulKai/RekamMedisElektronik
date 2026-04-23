<?php

namespace App\Http\Controllers;

use App\Http\Requests\Queues\StoreQueueRequest;
use App\Models\Queue;
use App\Models\Resources\Patient;
use App\Queries\Resources\PractitionerQueryBuilder;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class QueueController extends Controller
{

    public function create(Patient $patient, PractitionerQueryBuilder $practitioner)
    {
        return Inertia::render('queue/Create', [
            'patient' => $patient,
            'practitioners' => $practitioner->get(10)
        ]);
    }

    public function store(StoreQueueRequest $request, Patient $patient)
    {
        $data = $request->validated();

        DB::transaction(function () use ($patient, $data) {
            $patient->update($data['patient']);
            Queue::create([
                'patient_id' => $patient->id,
                'date'         => today(),
                'queue_number' => Queue::whereDate('date', today())
                    ->lockForUpdate()
                    ->count() + 1,
                ...$data
            ]);
        });

        return redirect()->route('patient.index');
    }
}
