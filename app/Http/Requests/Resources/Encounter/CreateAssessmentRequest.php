<?php

namespace App\Http\Requests\Resources\Encounter;

use App\Enums\DiagnosisRole;
use App\Enums\DiagnosisStatus;
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
            'diagnoses' => [
                'nullable',
                'array'
            ],
            'diagnoses.*.diagnosis_role' => [
                'required',
                Rule::enum(DiagnosisRole::class),
            ],
            'diagnoses.*.diagnosis_status' => [
                'required',
                Rule::enum(DiagnosisStatus::class),
            ],
            'diagnoses.*.code' => [
                'required',
            ],
            'diagnoses.*.system' => [
                'required'
            ],
            'diagnoses.*.display' => [
                'required',
            ]
        ];
    }
}
