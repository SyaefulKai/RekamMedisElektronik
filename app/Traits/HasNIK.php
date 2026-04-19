<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Crypt;

trait HasNIK
{
    protected function nik(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Crypt::encryptString($value),
            get: fn($value) => Crypt::decryptString($value),
        );
    }
}
