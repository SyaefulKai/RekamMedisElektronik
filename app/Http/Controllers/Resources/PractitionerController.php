<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Resources\Practitioner;
use App\Models\User;
use Inertia\Inertia;

class PractitionerController extends Controller
{
    public function index()
    {
        return Inertia::render('practitioner/Index', [
            'practitioners' => Practitioner::paginate(10),
        ]);
    }

    public function create(User $user)
    {
        $this->authorize('create', Practitioner::class);
        return Inertia::render('practitioner/Create', [
            'user' => $user,
        ]);
    }
}
