<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'description', 'start_year', 'end_year', 'status'])]
class AcademicYear extends Model
{
    public function academicTerms(): HasMany
    {
        return $this->hasMany(AcademicTerm::class);
    }
}
