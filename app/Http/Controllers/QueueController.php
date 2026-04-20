<?php

namespace App\Http\Controllers;

use App\Http\Requests\Queues\CreateQueueRequest;
use App\Http\Requests\Queues\StoreQueueRequest;
use App\Models\Queue;
use App\Models\Resources\Patient;
use App\Queries\Resources\PractitionerQueryBuilder;
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

    public function store(StoreQueueRequest $request)
    {
        Queue::create($request->validated());
        return redirect()->to(route('patient.index'));
    }
}
