<?php

namespace App\Services;

use App\Models\Curriculum;
use Illuminate\Database\Eloquent\Collection;

class CurriculumService
{
    public function getAll(): Collection
    {
        return Curriculum::with('department')->orderBy('curriculum')->get();
    }

    public function getForDropdown(): Collection
    {
        return Curriculum::with('department')->orderBy('curriculum')->get();
    }

    public function getByDepartment(int $departmentId): Collection
    {
        return Curriculum::with('department')
            ->where('department_id', $departmentId)
            ->orderBy('curriculum')
            ->get();
    }

    public function create(array $data): Curriculum
    {
        return Curriculum::create($data);
    }

    public function update(Curriculum $curriculum, array $data): bool
    {
        return $curriculum->update($data);
    }

    public function delete(Curriculum $curriculum): ?bool
    {
        return $curriculum->delete();
    }
}
