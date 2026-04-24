<?php

namespace App\Enums;

enum EncounterStatus: string
{
    case Arrived = 'arrived';
    case InProgress = 'in-progress';
    case Finished = 'finished';
    case Cancelled = 'cancelled';
}
