<?php

namespace App\Observers;

use App\Models\Queue;
use App\Models\Resources\Encounter;
use Illuminate\Support\Facades\DB;

class QueueObserver
{
    public function creating(Queue $queue)
    {
        DB::transaction(function () use ($queue) {
            $count = Queue::whereDate('date', today()->toDateString())
                ->lockForUpdate()
                ->count();

            $queue->date = today()->toDateString();
            $queue->queue_number = $count + 1;
        });
    }

}
