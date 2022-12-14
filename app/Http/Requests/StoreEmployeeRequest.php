<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEmployeeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'email' => 'nullable|email|unique:employees,email',
            'phone' => ['nullable', new PhoneNumber()],
            'company_id' => 'nullable|exists:companies,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Firstname required',
            'first_name.max' => 'Max size will be 150',
            'last_name.required' => 'Lastname required',
            'last_name.max' => 'Max size will be 150',
            'email.email' => 'Not a valid email',
            'email.unique' => 'Email already exists.',
            'company_id.exists' => 'Invalid Company Id',
        ];
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
