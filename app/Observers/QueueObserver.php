<?php

namespace App\Observers;

use App\Models\Queue;

class QueueObserver
{
    public function creating(Queue $queue)
    {
        $queue->date = now();
        $queue->queue_number = Queue::where('date', now())->count() + 1;
    }
}
