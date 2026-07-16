<?php

namespace App\Services;

use App\Models\AcademicTerm;
use Illuminate\Database\Eloquent\Collection;

class AcademicTermService
{
    public function getAll(): Collection
    {
        return AcademicTerm::with(['schoolYear', 'department'])->orderBy('start_date')->get();
    }

    public function create(array $data): AcademicTerm
    {
        return AcademicTerm::create($data);
    }

    public function update(AcademicTerm $academicTerm, array $data): bool
    {
        return $academicTerm->update($data);
    }

    public function delete(AcademicTerm $academicTerm): ?bool
    {
        return $academicTerm->delete();
    }
}
