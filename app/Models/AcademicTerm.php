<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'description', 'type', 'department_id', 'academic_year_id', 'start_date', 'end_date', 'status'])]
class AcademicTerm extends Model
{
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function prospectuses(): HasMany
    {
        return $this->hasMany(Prospectus::class, 'term_id');
    }

    public function subjectOfferings(): HasMany
    {
        return $this->hasMany(SubjectOffering::class);
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class);
    }

    public function enlistments(): HasMany
    {
        return $this->hasMany(Enlistment::class);
    }

    public function teacherOfferings(): HasMany
    {
        return $this->hasMany(TeacherOffering::class);
    }

    public function assessmentHistories(): HasMany
    {
        return $this->hasMany(AssessmentHistory::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function studentFees(): HasMany
    {
        return $this->hasMany(StudentFee::class);
    }
}
