<?php

namespace Modules\User\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            'phone_number' => ['required', 'regex:/^09\d{9}$/', 'max:11', 'unique:users'],
            'gym_name'     => ['required', 'string', 'min:3', 'max:255'],
            'logo'         => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5120'],
            'address'      => ['nullable', 'string','min:3'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'phone_number.unique' => 'این شماره موبایل قبلا ثبت نام کرده است.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
