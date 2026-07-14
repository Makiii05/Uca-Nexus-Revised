<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'first_name', 'middle_name', 'last_name', 'email', 'status'])]
class Teacher extends Model
{
    public function accounts(): HasMany
    {
        return $this->hasMany(TeacherAccount::class);
    }

    public function offerings(): HasMany
    {
        return $this->hasMany(TeacherOffering::class);
    }
}
