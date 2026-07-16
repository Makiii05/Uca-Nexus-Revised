<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['curriculum', 'status', 'department_id'])]
class Curriculum extends Model
{
    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function prospectuses(): HasMany
    {
        return $this->hasMany(Prospectus::class);
    }
}
