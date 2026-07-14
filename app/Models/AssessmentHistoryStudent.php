<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['assessment_history_id', 'student_number', 'name', 'year_level', 'program', 'department'])]
class AssessmentHistoryStudent extends Model
{
    public function assessmentHistory(): BelongsTo
    {
        return $this->belongsTo(AssessmentHistory::class);
    }
}
