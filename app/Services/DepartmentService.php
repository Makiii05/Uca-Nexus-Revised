<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

class DepartmentService
{
    public function getAll(): Collection
    {
        return Department::orderBy('code')->get();
    }

    public function getForDropdown(): Collection
    {
        return Department::orderBy('code')->get();
    }

    public function create(array $data): Department
    {
        return Department::create($data);
    }

    public function update(Department $department, array $data): bool
    {
        return $department->update($data);
    }

    public function delete(Department $department): ?bool
    {
        return $department->delete();
    }
}
