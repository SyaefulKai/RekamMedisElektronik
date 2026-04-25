<?php

namespace App\Http\Requests\Resources\Encounter;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateSubjectiveRequest extends FormRequest
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
            'chief_complaint' => [
                'nullable',
                'string'
            ],
            'history_of_present_illness' => [
                'nullable',
                'string'
            ],
            'past_medical_history' => [
                'nullable',
                'string'
            ],
            'family_medical_history' => [
                'nullable',
                'string'
            ],
            'allergies' => [
                'nullable',
                'array'
            ],
            'allergies.*.name' => [
                'required_with:allergies',
                'string'
            ],
            'allergies.*.type'  => [
                'nullable',
                'string',
                'in:allergy,intolerance'
            ],
            'allergies.*.category' => [
                'nullable',
                'string',
                'in:food,medication,environment,biologic'
            ],
            'allergies.*.criticality' => [
                'nullable',
                'string',
                'in:low,high,unable-to-assess'
            ],
            'allergies.*.manifestation' => [
                'nullable',
                'string'
            ],
            'allergies.*.severity' => [
                'nullable',
                'string',
                'in:mild,moderate,severe'
            ],
        ];
    }
}
