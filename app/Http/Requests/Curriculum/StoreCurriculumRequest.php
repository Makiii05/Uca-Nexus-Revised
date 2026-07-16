<?php

namespace App\Http\Requests\Curriculum;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCurriculumRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'curriculum' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::enum(Status::class)],
            'department_id' => ['required', 'exists:departments,id'],
        ];
    }
}
