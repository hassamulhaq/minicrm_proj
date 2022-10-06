<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class StoreCompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:200',
            'email' => 'nullable|email|unique:companies,email',
            'company_logo' => 'nullable|image|dimensions:min_width=100,min_height=100|mimes:jpeg,jpg,png,gif,svg,webp|max:100000',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Company :attribute required',
            'name.max' => 'Max size will be 200',
            'email.email' => 'Not a valid email',
            'email.unique' => 'Email already exists.',
            'company_logo.required' => 'Logo required',
            'company_logo.image' => 'Logo must be image',
            'company_logo.dimensions' => 'Min width 100. Max width 100',
            'company_logo.mimes' => 'Valid ext are jpeg,jpg,png,gif,svg,webp',
            'company_logo.max' => 'Maximum size 10MB',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator): void
    {
        $response = [
            'success' => false,
            'status_code' => 422,
            'type' => 'validation_error',
            'message' => 'Validation Error',
            'data' => $validator->errors()
        ];

        throw new HttpResponseException(response()->json($response, $response['status_code']));
    }
}
