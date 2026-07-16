<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'student_number', 'lrn', 'department_id', 'program_id', 'level_id',
    'last_name', 'first_name', 'middle_name', 'sex', 'citizenship', 'religion',
    'birthdate', 'place_of_birth', 'civil_status', 'student_type',
    'school_year_admitted', 'application_id', 'status', 'is_exported',
])]
class Student extends Model
{
    protected function casts(): array
    {
        return [
            'birthdate' => 'date',
            'is_exported' => 'boolean',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class, 'application_id');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(StudentContact::class);
    }

    public function guardians(): HasMany
    {
        return $this->hasMany(StudentGuardian::class);
    }

    public function academicHistories(): HasMany
    {
        return $this->hasMany(StudentAcademicHistory::class);
    }

    public function account(): HasOne
    {
        return $this->hasOne(StudentAccount::class);
    }

    public function profilePicture(): HasOne
    {
        return $this->hasOne(StudentProfilePicture::class);
    }

    public function enlistments(): HasMany
    {
        return $this->hasMany(Enlistment::class);
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class);
    }

    public function studentFees(): HasMany
    {
        return $this->hasMany(StudentFee::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function assessmentHistories(): HasMany
    {
        return $this->hasMany(AssessmentHistory::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
