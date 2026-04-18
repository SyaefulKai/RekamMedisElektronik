<?php

namespace App\Models\Resources;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Practitioner extends Model
{
    protected $fillable = [
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
