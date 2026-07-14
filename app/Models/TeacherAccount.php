<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['teacher_id', 'password', 'status'])]
class TeacherAccount extends Model
{
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
