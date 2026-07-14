<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'description', 'program_id', 'order'])]
class Level extends Model
{
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function prospectuses(): HasMany
    {
        return $this->hasMany(Prospectus::class);
    }

    public function subjectOfferings(): HasMany
    {
        return $this->hasMany(SubjectOffering::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
