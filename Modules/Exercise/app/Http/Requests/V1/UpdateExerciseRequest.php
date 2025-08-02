<?php

namespace Modules\Exercise\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExerciseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name_fa'     => ['sometimes', 'string', 'max:255', Rule::unique('exercises', 'name_fa')->ignore($this->exercise->id)],
            'name_en'     => ['sometimes', 'string', 'max:255', Rule::unique('exercises', 'name_en')->ignore($this->exercise->id)],
            'category_id' => ['sometimes', 'integer', 'exists:categories,id'],
            'video'       => ['sometimes', 'file', 'mimes:mp4,gif', 'max:5120'],
            'equipment_id' => ['sometimes', 'integer', 'exists:equipments,id'],
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
