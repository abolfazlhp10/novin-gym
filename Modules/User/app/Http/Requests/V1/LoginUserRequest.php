<?php
namespace Modules\User\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'phone_number' => ['required', 'regex:/^09\d{9}$/', 'max:11', 'exists:users'],
            'otp_code'     => ['required', 'integer', 'digits:5'],
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
