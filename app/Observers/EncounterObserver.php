<?php

namespace App\Observers;

use App\Enums\QueueStatus;
use App\Models\Resources\Encounter;
use Illuminate\Support\Str;

class EncounterObserver
{
    public function creating(Encounter $encounter): void
    {
        $encounter->uuid = Str::uuid();
    }

    public function created(Encounter $encounter): void
    {
        $encounter->queue()->update([
            'status' => QueueStatus::InProgress->value
        ]);
    }
}
