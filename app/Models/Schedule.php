<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['proctor_id', 'date', 'start_time', 'end_time', 'status', 'process'])]
class Schedule extends Model
{
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'start_time' => 'string',
            'end_time' => 'string',
        ];
    }

    public function proctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'proctor_id');
    }

    public function admissions(): HasMany
    {
        return $this->hasMany(Admission::class, 'interview_schedule_id');
    }

    public function examAdmissions(): HasMany
    {
        return $this->hasMany(Admission::class, 'exam_schedule_id');
    }

    public function evaluationAdmissions(): HasMany
    {
        return $this->hasMany(Admission::class, 'evaluation_schedule_id');
    }
}
