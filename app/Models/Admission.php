<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'applicant_id', 'interview_schedule_id', 'interview_score', 'interview_remark',
    'interview_result', 'exam_schedule_id', 'math_score', 'science_score',
    'english_score', 'filipino_score', 'abstract_score', 'exam_score',
    'exam_result', 'final_score', 'decision', 'program_id',
    'evaluation_schedule_id', 'evaluated_by', 'evaluated_at',
])]
class Admission extends Model
{
    protected function casts(): array
    {
        return [
            'interview_score' => 'decimal:2',
            'math_score' => 'decimal:2',
            'science_score' => 'decimal:2',
            'english_score' => 'decimal:2',
            'filipino_score' => 'decimal:2',
            'abstract_score' => 'decimal:2',
            'exam_score' => 'decimal:2',
            'final_score' => 'decimal:2',
            'evaluated_at' => 'datetime',
        ];
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    public function interviewSchedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'interview_schedule_id');
    }

    public function examSchedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'exam_schedule_id');
    }

    public function evaluationSchedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'evaluation_schedule_id');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
