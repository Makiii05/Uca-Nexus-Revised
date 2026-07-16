<?php

namespace App\Services;

use App\Models\SchoolYear;
use Illuminate\Database\Eloquent\Collection;

class SchoolYearService
{
    public function getAll(): Collection
    {
        return SchoolYear::orderBy('start_year', 'desc')->get();
    }

    public function getForDropdown(): Collection
    {
        return SchoolYear::orderBy('start_year', 'desc')->get();
    }

    public function create(array $data): SchoolYear
    {
        return SchoolYear::create($data);
    }

    public function update(SchoolYear $schoolYear, array $data): bool
    {
        return $schoolYear->update($data);
    }

    public function delete(SchoolYear $schoolYear): ?bool
    {
        return $schoolYear->delete();
    }
}
