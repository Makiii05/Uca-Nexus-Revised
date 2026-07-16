<?php

namespace App\Http\Requests\Program;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:255', 'unique:programs,code'],
            'description' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::enum(Status::class)],
            'department_id' => ['required', 'exists:departments,id'],
        ];
    }
}
