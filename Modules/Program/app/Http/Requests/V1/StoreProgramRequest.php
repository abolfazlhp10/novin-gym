<?php

namespace Modules\Program\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Program\Models\V1\Program;

class StoreProgramRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'user_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^09\d{9}$/'],
            'meta_data' => ['required', 'json'],
            'description' => ['nullable', 'string'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create',Program::class);
    }
}
