<?php

namespace App\Http\Requests\Department;

use App\Enums\EducationLevel;
use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:255', 'unique:departments,code'],
            'description' => ['required', 'string', 'max:255'],
            'education_level' => ['nullable', Rule::enum(EducationLevel::class)],
            'status' => ['required', Rule::enum(Status::class)],
        ];
    }
}
