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
        $rules = [
            'phone_number' => ['required', 'regex:/^09\d{9}$/', 'max:11', 'exists:users'],
        ];

        if ($this->has('otp_code')) {
            $rules['otp_code'] = ['required', 'integer', 'digits:5']; 
        }

        return $rules;
    }


    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
