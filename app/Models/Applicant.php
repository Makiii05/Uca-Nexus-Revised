<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'application_no', 'level', 'student_type', 'year_level',
    'strand', 'first_program_choice', 'second_program_choice', 'third_program_choice',
    'last_name', 'first_name', 'middle_name', 'sex', 'citizenship', 'religion',
    'birthdate', 'place_of_birth', 'civil_status',
    'status', 'school_year', 'reject_reason',
])]
class Applicant extends Model
{
    protected function casts(): array
    {
        return [
            'birthdate' => 'date',
        ];
    }

    public function strandProgram(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'strand');
    }

    public function firstProgramChoice(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'first_program_choice');
    }

    public function secondProgramChoice(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'second_program_choice');
    }

    public function thirdProgramChoice(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'third_program_choice');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(ApplicantContact::class);
    }

    public function guardians(): HasMany
    {
        return $this->hasMany(ApplicantGuardian::class);
    }

    public function education(): HasMany
    {
        return $this->hasMany(ApplicantEducation::class);
    }

    public function admission(): HasOne
    {
        return $this->hasOne(Admission::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'application_id');
    }
}
