<?php

namespace App\Services;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Collection;

class SubjectService
{
    public function getAll(): Collection
    {
        return Subject::orderBy('code')->get();
    }

    public function getForDropdown(): Collection
    {
        return Subject::orderBy('code')->get();
    }

    public function create(array $data): Subject
    {
        return Subject::create($data);
    }

    public function update(Subject $subject, array $data): bool
    {
        return $subject->update($data);
    }

    public function delete(Subject $subject): ?bool
    {
        return $subject->delete();
    }
}
