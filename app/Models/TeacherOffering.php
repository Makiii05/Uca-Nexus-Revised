<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['teacher_id', 'offering_id', 'academic_term_id', 'status'])]
class TeacherOffering extends Model
{
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function offering(): BelongsTo
    {
        return $this->belongsTo(SubjectOffering::class, 'offering_id');
    }

    public function academicTerm(): BelongsTo
    {
        return $this->belongsTo(AcademicTerm::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'teacher_offering_id');
    }

    public function gradeColumns(): HasMany
    {
        return $this->hasMany(GradeColumn::class, 'teacher_offering_id');
    }
}
