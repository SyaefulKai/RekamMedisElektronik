<?php

namespace App\Models\Resources;

use App\Models\Queue;
use Carbon\Carbon;
use Database\Factories\PatientFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasNIK;

#[UseFactory(PatientFactory::class)]
class Patient extends Model
{
    use HasFactory, SoftDeletes, HasNIK;
    protected $fillable = [
        'nik',
        'medical_record_number',
        'gender',
        'name',
        'birth_date',
        'address',
        'occupation'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected function birthDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d M Y'),
        );
    }

    public function queue()
    {
        return $this->hasMany(Queue::class);
    }

    public function encounters()
    {
        return $this->hasMany(Encounter::class);
    }
}
