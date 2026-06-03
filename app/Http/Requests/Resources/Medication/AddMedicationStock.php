<?php

namespace App\Http\Requests\Resources\Medication;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddMedicationStock extends FormRequest
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
            'medications' => [
                'required',
                'array'
            ],
            'medications.*.medication_id' => [
                'required',
                'exists:medications,id'
            ],
            'medications.*.batch_number' => [
                'nullable',
                'string'
            ],
            'medications.*.expired_at' => [
                'nullable',
                'date'
            ],
            'medications.*.quantity' => [
                'required',
                'integer',
                'min:1'
            ],
            'medications.*.buy_price' => [
                'required',
                'integer',
                'min:1'
            ],
            'medications.*.sell_price' => [
                'required',
                'integer',
                'min:1'
            ]
        ];
    }
}
