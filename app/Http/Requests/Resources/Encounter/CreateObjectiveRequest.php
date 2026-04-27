<?php

namespace App\Http\Requests\Resources\Encounter;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateObjectiveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vital_signs'                       => ['nullable', 'array'],
            'vital_signs.systolic'              => ['nullable', 'numeric', 'min:60', 'max:250'],
            'vital_signs.diastolic'             => ['nullable', 'numeric', 'min:40', 'max:150'],
            'vital_signs.heart_rate'            => ['nullable', 'numeric', 'min:30', 'max:250'],
            'vital_signs.respiratory_rate'      => ['nullable', 'numeric', 'min:5', 'max:60'],
            'vital_signs.temperature'           => ['nullable', 'numeric', 'min:30', 'max:43'],
            'vital_signs.oxygen_saturation'     => ['nullable', 'numeric', 'min:50', 'max:100'],
            'vital_signs.weight'                => ['nullable', 'numeric', 'min:1', 'max:300'],
            'vital_signs.height'                => ['nullable', 'numeric', 'min:50', 'max:250'],

            'physical_examination'              => ['nullable', 'string', 'max:5000'],
        ];
    }
}
