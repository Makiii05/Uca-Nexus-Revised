<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['component_id', 'grading_id'])]
class GradingComponent extends Model
{
    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    public function gradingSystem(): BelongsTo
    {
        return $this->belongsTo(GradingSystem::class, 'grading_id');
    }
}
