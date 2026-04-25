<?php

namespace App\Http\Controllers;

use App\Http\Requests\Queues\StoreQueueRequest;
use App\Models\Queue;
use App\Models\Resources\Patient;
use App\Queries\Resources\PractitionerQueryBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class QueueController extends Controller
{
    public function index()
    {
        return Inertia::render('queue/Index', [
            'queues' => Queue::with([
                'patient',
                'practitioner.user',
                'encounter'
            ])
                ->whereDate('date', today())
                ->paginate(10)
        ]);
    }

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

        $patient->update($data['patient']);

        Queue::create([
            'patient_id'      => $patient->id,
            'practitioner_id' => $data['practitioner_id'],
        ]);

        Inertia::flash('queueCreated', 'Antrian berhasil dibuat.');

        return to_route('queue.index');
    }
}
