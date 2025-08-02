<?php

namespace Modules\Exercise\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name_fa' => ['required', 'string', 'max:255', Rule::unique('categories', 'name_fa')],
            'name_en' => ['required', 'string', 'max:255', Rule::unique('categories', 'name_en')],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && $this->user()->hasRole('admin');
    }
}
