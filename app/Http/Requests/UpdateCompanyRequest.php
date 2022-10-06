<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:200',
            'email' => 'nullable|email',
            'thumbnail' => 'nullable|file|dimensions:min_width=100,min_height=100|mimes:jpeg,jpg,png,gif,svg|max:100000',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
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