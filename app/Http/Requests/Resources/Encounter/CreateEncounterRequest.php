<?php

namespace App\Http\Requests\Resources\Encounter;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateEncounterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'practitioner_id' => [
                'required',
                'exists:practitioners,user_id'
            ],
            'patient_id' => [
                'required',
                'exists:patients,id'
            ],
            'queue_id' => [
                'required',
                'exists:queues,id',
                'unique:encounters,queue_id'
            ]
        ];
    }
}
