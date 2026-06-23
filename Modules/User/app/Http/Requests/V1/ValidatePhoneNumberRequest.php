<?php

namespace Modules\User\app\Http\Requests\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ValidatePhoneNumberRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone_number' => [
                'required',
                'string',
                'regex:/^09\d{9}$/',
                'max:11',
                'unique:users,phone_number',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'phone_number.required' => 'شماره تلفن الزامی است.',
            'phone_number.string' => 'شماره تلفن باید رشته متنی باشد.',
            'phone_number.regex' => 'فرمت شماره تلفن صحیح نیست. باید با 09 شروع شود و 11 رقم باشد.',
            'phone_number.max' => 'شماره تلفن نمی‌تواند بیشتر از 11 کاراکتر باشد.',
            'phone_number.unique' => 'این شماره تلفن قبلاً ثبت شده است.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'phone_number' => 'شماره تلفن',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'خطا در اعتبارسنجی',
                'errors' => $validator->errors(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
