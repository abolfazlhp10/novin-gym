<?php

namespace Modules\Exercise\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExerciseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name_fa' => ['required', 'string', 'max:255', Rule::unique('exercises', 'name_fa')],
            'name_en' => ['required', 'string', 'max:255', Rule::unique('exercises', 'name_en')],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'video' => ['required', 'file', 'mimes:mp4,gif', 'max:5120'],
            'equipment_id' => ['required', 'integer', 'max:255', 'exists:equipments,id'],
            'description' => ['nullable', 'string'],
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
