<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['teacher_offering_id', 'period', 'component_id', 'column_number', 'highest_score'])]
class GradeColumn extends Model
{
    protected $table = 'grade_column';

    protected function casts(): array
    {
        return [
            'highest_score' => 'decimal:2',
        ];
    }

    public function teacherOffering(): BelongsTo
    {
        return $this->belongsTo(TeacherOffering::class, 'teacher_offering_id');
    }

    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    public function rawScores(): HasMany
    {
        return $this->hasMany(RawScore::class);
    }
}
