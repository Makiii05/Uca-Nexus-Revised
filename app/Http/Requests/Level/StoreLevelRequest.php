<?php

namespace App\Http\Requests\Level;

use Illuminate\Foundation\Http\FormRequest;

class StoreLevelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'program_id' => ['required', 'exists:programs,id'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
