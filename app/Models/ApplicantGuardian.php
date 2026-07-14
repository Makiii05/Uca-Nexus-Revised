<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['applicant_id', 'type', 'name', 'occupation', 'contact_number', 'monthly_income'])]
class ApplicantGuardian extends Model
{
    protected function casts(): array
    {
        return [
            'monthly_income' => 'decimal:2',
        ];
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }
}
