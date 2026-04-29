<?php

namespace App\Http\Requests\Resources\Encounter;

use App\Enums\DiagnosisRole;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAssessmentRequest extends FormRequest
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
            'icd10s' => [
                'nullable',
                'array'
            ],
            'icd10s.*.diagnosis_type' => [
                'required',
                Rule::enum(DiagnosisRole::class),
            ],
            'icd10s.*.icd10' => [
                'required',
                'exists:icd10s,id'
            ]
        ];
    }
}
