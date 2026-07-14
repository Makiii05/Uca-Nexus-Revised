<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['description'])]
class PaymentType extends Model
{
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'type_id');
    }
}
