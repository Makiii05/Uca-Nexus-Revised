<?php

namespace App\Http\Requests\SchoolYear;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSchoolYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:255', 'unique:school_years,code,' . $this->route('school_year')->id],
            'description' => ['required', 'string', 'max:255'],
            'start_year' => ['required', 'string', 'max:255'],
            'end_year' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::enum(Status::class)],
        ];
    }
}
