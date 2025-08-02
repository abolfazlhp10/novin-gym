<?php

namespace Modules\Exercise\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEquipmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name_fa' => ['sometimes', 'string', 'max:255', Rule::unique('equipments', 'name_fa')->ignore($this->equipment->id)],
            'name_en' => ['sometimes', 'string', 'max:255', Rule::unique('equipments', 'name_en')->ignore($this->equipment->id)],
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
