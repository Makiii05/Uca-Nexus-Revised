<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['applicant_id', 'zip_code', 'present_address', 'permanent_address', 'telephone_number', 'mobile_number', 'email'])]
class ApplicantContact extends Model
{
    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }
}
