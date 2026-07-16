<?php

namespace App\Http\Requests\AcademicTerm;

use App\Enums\Status;
use App\Enums\TermType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAcademicTermRequest extends FormRequest
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
            'type' => ['required', Rule::enum(TermType::class)],
            'department_id' => ['nullable', 'exists:departments,id'],
            'school_year_id' => ['required', 'exists:school_years,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'status' => ['required', Rule::enum(Status::class)],
        ];
    }
}
