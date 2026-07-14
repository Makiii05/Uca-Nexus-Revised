<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['description', 'amount', 'type', 'month_to_pay', 'fee_group', 'program_id', 'academic_term_id', 'student_id'])]
class Fee extends Model
{
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'month_to_pay' => 'float',
        ];
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function academicTerm(): BelongsTo
    {
        return $this->belongsTo(AcademicTerm::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function subjectFees(): HasMany
    {
        return $this->hasMany(SubjectFee::class);
    }

    public function studentFees(): HasMany
    {
        return $this->hasMany(StudentFee::class);
    }
}
