<?php

namespace App\Http\Requests\Queues;

use App\Http\Requests\Resources\Patient\UpdatePatientRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreQueueRequest extends FormRequest
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

        $updatePatientRequest = new UpdatePatientRequest();
        $updatePatientRequestRules = collect($updatePatientRequest->rules())->mapWithKeys(function($value, $key) {
            return [
                "patient.$key" => $value
            ];
        })->toArray();
        dd($updatePatientRequestRules);

        return array_merge([
            'practitioner_id' => [
                'required',
                'exists:practitioner,id'
            ],
            'patient_id' => [
                'required',
                'exists:patient,id'
            ]
        ], $updatePatientRequestRules);
    }
}
