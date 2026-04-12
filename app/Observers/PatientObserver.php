<?php

namespace App\Observers;

use App\Models\Resources\Patient;
use Illuminate\Support\Facades\Crypt;

class PatientObserver
{
    public function saving(Patient $patient)
    {
        if($patient->nik) $patient->nik = Crypt::encryptString($patient->nik);
    }
}
 