<?php

namespace App\Services;

use App\Models\Program;
use Illuminate\Database\Eloquent\Collection;

class ProgramService
{
    public function getAll(): Collection
    {
        return Program::with('department')->orderBy('code')->get();
    }

    public function getForDropdown(): Collection
    {
        return Program::orderBy('code')->get();
    }

    public function create(array $data): Program
    {
        return Program::create($data);
    }

    public function update(Program $program, array $data): bool
    {
        return $program->update($data);
    }

    public function delete(Program $program): ?bool
    {
        return $program->delete();
    }
}
