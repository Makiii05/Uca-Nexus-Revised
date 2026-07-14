<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['assessment_history_id', 'type', 'description', 'amount'])]
class AssessmentHistoryFee extends Model
{
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }

    public function assessmentHistory(): BelongsTo
    {
        return $this->belongsTo(AssessmentHistory::class);
    }
}
