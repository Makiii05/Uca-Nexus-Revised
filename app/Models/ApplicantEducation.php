<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['applicant_id', 'level', 'school_name', 'school_address', 'inclusive_years'])]
class ApplicantEducation extends Model
{
    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }
}
