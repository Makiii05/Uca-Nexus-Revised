<?php

namespace App\Http\Requests\Subject;

use App\Enums\EducationLevel;
use App\Enums\Status;
use App\Enums\SubjectType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:255', 'unique:subjects,code,' . $this->route('subject')->id],
            'description' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'integer', 'min:0'],
            'lech' => ['required', 'integer', 'min:0'],
            'lecu' => ['required', 'integer', 'min:0'],
            'labh' => ['required', 'integer', 'min:0'],
            'labu' => ['required', 'integer', 'min:0'],
            'type' => ['required', Rule::enum(SubjectType::class)],
            'education_level' => ['nullable', Rule::enum(EducationLevel::class)],
            'status' => ['required', Rule::enum(Status::class)],
        ];
    }
}
