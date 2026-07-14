<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'description', 'unit', 'lech', 'lecu', 'labh', 'labu', 'type', 'education_level', 'status'])]
class Subject extends Model
{
    public function prospectuses(): HasMany
    {
        return $this->hasMany(Prospectus::class);
    }

    public function subjectOfferings(): HasMany
    {
        return $this->hasMany(SubjectOffering::class);
    }

    public function subjectFees(): HasMany
    {
        return $this->hasMany(SubjectFee::class);
    }
}
