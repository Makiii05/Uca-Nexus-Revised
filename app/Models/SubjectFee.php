<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['subject_id', 'fee_id'])]
class SubjectFee extends Model
{
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function fee(): BelongsTo
    {
        return $this->belongsTo(Fee::class);
    }
}
