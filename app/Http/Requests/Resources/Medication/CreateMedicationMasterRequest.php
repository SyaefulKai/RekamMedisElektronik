<?php

namespace App\Http\Requests\Resources\Medication;

use App\Enums\Medications\MedicationForm;
use App\Enums\Medications\MedicationUnit;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateMedicationMasterRequest extends FormRequest
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
            'generic_name' => [
                'required',
                'string'
            ],
            'trade_name' => [
                'required',
                'string'
            ],
            'strength' => [
                'required',
                'string'
            ],
            'form' => [
                'required',
                Rule::enum(MedicationForm::class)
            ],
            'unit' => [
                'required',
                Rule::enum(MedicationUnit::class)
            ],
        ];
    }
}
