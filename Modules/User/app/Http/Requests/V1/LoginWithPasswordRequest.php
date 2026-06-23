<?php

namespace Modules\User\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class LoginWithPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone_number' => ['required', 'regex:/^09\d{9}$/', 'max:11', 'exists:users,phone_number'],
            'password'     => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
