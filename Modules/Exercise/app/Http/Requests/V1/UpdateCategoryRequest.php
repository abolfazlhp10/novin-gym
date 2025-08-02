<?php

namespace Modules\Exercise\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name_fa' => ['sometimes', 'string', 'max:255', Rule::unique('categories', 'name_fa')->ignore($this->category->id)],
            'name_en' => ['sometimes', 'string', 'max:255', Rule::unique('categories', 'name_en')->ignore($this->category->id)],
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
