<?php

namespace App\Http\Requests;

use App\Enums\CivilStatus;
use App\Enums\EducationLevel;
use App\Enums\EnrollmentType;
use App\Enums\GuardianType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreApplicantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'level' => ['required', Rule::enum(EducationLevel::class)],
            'student_type' => ['required', Rule::enum(EnrollmentType::class)],
            'year_level' => ['nullable', 'string', 'max:255'],
            'strand' => ['nullable', 'exists:programs,id'],
            'first_program_choice' => ['nullable', 'exists:programs,id'],
            'second_program_choice' => ['nullable', 'exists:programs,id'],
            'third_program_choice' => ['nullable', 'exists:programs,id'],

            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:255'],
            'citizenship' => ['required', 'string', 'max:255'],
            'religion' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'place_of_birth' => ['required', 'string', 'max:255'],
            'civil_status' => ['required', Rule::enum(CivilStatus::class)],

            'contact.zip_code' => ['required', 'string', 'max:255'],
            'contact.present_address' => ['required', 'string', 'max:255'],
            'contact.permanent_address' => ['required', 'string', 'max:255'],
            'contact.telephone_number' => ['nullable', 'string', 'max:255'],
            'contact.mobile_number' => ['required', 'string', 'max:255'],
            'contact.email' => ['required', 'email', 'max:255'],

            'guardians' => ['array', 'min:1'],
            'guardians.*.type' => ['required', Rule::enum(GuardianType::class)],
            'guardians.*.name' => ['required', 'string', 'max:255'],
            'guardians.*.occupation' => ['nullable', 'string', 'max:255'],
            'guardians.*.contact_number' => ['nullable', 'string', 'max:255'],
            'guardians.*.monthly_income' => ['nullable', 'numeric', 'min:0', 'max:99999999'],

            'education' => ['array', 'min:1'],
            'education.*.level' => ['required', 'string', 'max:255'],
            'education.*.school_name' => ['required', 'string', 'max:255'],
            'education.*.school_address' => ['required', 'string', 'max:255'],
            'education.*.inclusive_years' => ['required', 'string', 'max:255'],
        ];
    }
}
