<?php

namespace App\Models;

use App\Enums\EducationLevel;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'description', 'education_level', 'status'])]
class Department extends Model
{
    protected function casts(): array
    {
        return [
            'education_level' => EducationLevel::class,
            'status' => Status::class,
        ];
    }
    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }

    public function levels(): HasMany
    {
        return $this->hasMany(Level::class);
    }

    public function academicTerms(): HasMany
    {
        return $this->hasMany(AcademicTerm::class);
    }

    public function curricula(): HasMany
    {
        return $this->hasMany(Curriculum::class);
    }

    public function gradingSystems(): HasMany
    {
        return $this->hasMany(GradingSystem::class);
    }

    public function components(): HasMany
    {
        return $this->hasMany(Component::class);
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
