<?php

namespace App\Models\Resources;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
