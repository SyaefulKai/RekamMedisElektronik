<?php

namespace App\Models\Resources;

use App\Models\Queue;
use App\Models\User;
use App\Traits\HasNIK;
use Illuminate\Database\Eloquent\Model;

class Practitioner extends Model
{

    use HasNIK;

    protected $fillable = [
        'nik',
        'type'
    ];

    public function queues()
    {
        return $this->hasMany(Queue::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function encounters()
    {
        return $this->hasMany(Encounter::class);
    }
}
