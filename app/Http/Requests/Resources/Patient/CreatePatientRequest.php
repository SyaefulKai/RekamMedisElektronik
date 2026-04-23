<?php

namespace App\Http\Requests\Resources\Patient;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePatientRequest extends FormRequest
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
            'nik' => [
                'sometimes',
            ],
            'medical_record_number' => [
                'required',
                'string'
            ],
            'name' => [
                'required',
                'string'
            ],
            'birth_date' => [
                'required',
                'date'
            ],
            'gender' => [
                'required',
                Rule::in([
                    'male',
                    'female'
                ])
            ],
            'address' => [
                'required',
                'string'
            ],
            'occupation' => [
                'sometimes',
                'string',
            ]
        ];
    }
}
