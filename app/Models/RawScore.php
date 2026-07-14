<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['grade_id', 'grade_column_id', 'score'])]
class RawScore extends Model
{
    protected $table = 'raw_score';

    protected function casts(): array
    {
        return [
            'score' => 'decimal:2',
        ];
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function gradeColumn(): BelongsTo
    {
        return $this->belongsTo(GradeColumn::class);
    }
}
