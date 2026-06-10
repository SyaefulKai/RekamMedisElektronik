<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Practitioner\CreatePractitionerRequest;
use App\Models\Resources\Practitioner;
use App\Models\User;
use App\Queries\Resources\PractitionerQueryBuilder;
use Inertia\Inertia;

class PractitionerController extends Controller
{
    public function index(PractitionerQueryBuilder $query)
    {
        $this->authorize('viewAny', Practitioner::class);
        return Inertia::render('practitioner/Index', [
            'practitioners' => $query->paginate(10),
        ]);
    }

    public function create(User $user)
    {
        $this->authorize('create', Practitioner::class);
        return Inertia::render('practitioner/Create', [
            'user' => $user,
        ]);
    }

    public function store(User $user, CreatePractitionerRequest $request)
    {
        $this->authorize('create', Practitioner::class);
        $data = $request->validated();
        $user->practitioner()->create($data);
        Inertia::flash('practitionerCreated', "Data praktisi $user->name berhasil disimpan.");
        return to_route('user.index');
    }
}
