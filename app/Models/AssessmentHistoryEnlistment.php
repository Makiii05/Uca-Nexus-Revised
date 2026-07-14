<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['assessment_history_id', 'code', 'description', 'units'])]
class AssessmentHistoryEnlistment extends Model
{
    protected function casts(): array
    {
        return [
            'units' => 'decimal:2',
        ];
    }

    public function assessmentHistory(): BelongsTo
    {
        return $this->belongsTo(AssessmentHistory::class);
    }
}
