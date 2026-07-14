<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['description', 'total_percentage', 'department_id'])]
class GradingSystem extends Model
{
    protected function casts(): array
    {
        return [
            'total_percentage' => 'decimal:2',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function gradingComponents(): HasMany
    {
        return $this->hasMany(GradingComponent::class, 'grading_id');
    }

    public function subjectOfferings(): HasMany
    {
        return $this->hasMany(SubjectOffering::class, 'grading_id');
    }
}
