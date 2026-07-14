<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'description', 'percentage', 'department_id'])]
class Component extends Model
{
    protected function casts(): array
    {
        return [
            'percentage' => 'decimal:2',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function gradingComponents(): HasMany
    {
        return $this->hasMany(GradingComponent::class);
    }

    public function gradeColumns(): HasMany
    {
        return $this->hasMany(GradeColumn::class);
    }
}
