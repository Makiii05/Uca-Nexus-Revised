<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'description', 'start_year', 'end_year', 'status'])]
class SchoolYear extends Model
{
    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
    public function academicTerms(): HasMany
    {
        return $this->hasMany(AcademicTerm::class);
    }
}
