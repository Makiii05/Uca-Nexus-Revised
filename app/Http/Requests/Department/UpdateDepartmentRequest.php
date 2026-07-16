<?php

namespace App\Http\Requests\Department;

use App\Enums\EducationLevel;
use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:255', 'unique:departments,code,' . $this->route('department')->id],
            'description' => ['required', 'string', 'max:255'],
            'education_level' => ['nullable', Rule::enum(EducationLevel::class)],
            'status' => ['required', Rule::enum(Status::class)],
        ];
    }
}
