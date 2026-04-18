<?php

namespace App\Models\Resources;

use App\Observers\PatientObserver;
use Carbon\Carbon;
use Database\Factories\PatientFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

#[UseFactory(PatientFactory::class)]
class Patient extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nik',
        'medical_record_number',
        'gender',
        'name',
        'birth_date',
        'address'
    ];

    protected $hidden = [
        'nik',
        'created_at',
        'updated_at'
    ];

    protected function birthDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d M Y'),
        );
    }

    protected function nik(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Crypt::encryptString($value),
            get: fn($value) => Crypt::decryptString($value),
        );
    }
}
