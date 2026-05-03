<?php

namespace App\Http\Requests\Resources\Procedure;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateProcedureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'string',
            ],
            'system' => [
                'required',
                'string'
            ],
            'display' => [
                'required',
                'string',
            ],
            'name' => [
                'required',
                'string',
            ]
        ];
    }
}
