<?php

namespace App\Http\Requests\Resources\Encounter;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreatePlanRequest extends FormRequest
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
            'procedures' => [
                'nullable',
                'array'
            ],
            'procedures.*.code' => [
                'required',
            ],
            'procedures.*.display' => [
                'required',
            ],
            'procedures.*.system' => [
                'required'
            ],
            'procedures.*.name' => [
                'required',
            ]
        ];
    }
}
