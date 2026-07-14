<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['teacher_offering_id', 'student_id', 'period', 'initial_grade', 'period_grade', 'status', 'submitted_at', 'approved_by', 'approved_at', 'finalized_at'])]
class Grade extends Model
{
    protected $table = 'grade';

    protected function casts(): array
    {
        return [
            'initial_grade' => 'decimal:2',
            'period_grade' => 'decimal:2',
            'submitted_at' => 'datetime',
            'approved_at' => 'datetime',
            'finalized_at' => 'datetime',
        ];
    }

    public function teacherOffering(): BelongsTo
    {
        return $this->belongsTo(TeacherOffering::class, 'teacher_offering_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rawScores(): HasMany
    {
        return $this->hasMany(RawScore::class);
    }
}
