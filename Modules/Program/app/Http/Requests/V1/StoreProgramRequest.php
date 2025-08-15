<?php
namespace Modules\Program\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Modules\Program\Models\V1\Program;

class StoreProgramRequest extends FormRequest
{

    protected function prepareForValidation(): void
    {
        $meta_data = json_decode($this->input('meta_data'), true);

        $this->merge([
            'meta_data' => $meta_data,
        ]);
    }

    public function rules(): array
    {
        return [
            'user_name'                    => ['required', 'string', 'max:255'],
            'phone_number'                 => ['required', 'string', 'regex:/^09\d{9}$/'],
            'description'                  => ['nullable', 'string', 'max:1000'],
            'meta_data'                    => 'required|array|min:1',
            'meta_data.*'                  => 'required|array',
            'meta_data.*.exercises'        => 'required|array',
            'meta_data.*.exercises.*'      => 'required|array',
            'meta_data.*.exercises.*.sets' => 'required|string',
            'meta_data.*.exercises.*.type' => 'required|string',
            'meta_data.*.exercises.*.reps' => 'required|integer|min:0',
            'meta_data.*.exercises.*.rest' => 'required|integer|min:0',
            'meta_data.*.exercises.*.time' => 'required|integer|min:0',
            'meta_data.*.exercises.*.desc' => 'nullable|string',
            'meta_data.*.super-sets'       => 'nullable|array',
            'meta_data.*.super-sets.*'     => 'required|array',
            'meta_data.*.super-sets.*.*'   => 'required|integer',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $sessions = $this->input('meta_data', []);

            if (! is_array($sessions)) {
                return;
            }

            foreach (array_keys($sessions) as $key) {
                if (! preg_match('/^session[1-9][0-9]*$/', $key)) {
                    $validator->errors()->add(
                        'meta_data',
                        "Invalid session key format. Each session key must be 'session' followed by a number (e.g., 'session1')."
                    );
                    break;
                }
            }
        });
    }

    public function authorize(): bool
    {
        return $this->user()->can('create', Program::class);
    }
}
