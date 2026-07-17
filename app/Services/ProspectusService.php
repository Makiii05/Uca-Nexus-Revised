<?php

namespace App\Services;

use App\Models\Prospectus;
use Illuminate\Database\Eloquent\Collection;

class ProspectusService
{
    public function getAll(): Collection
    {
        return Prospectus::with([
            'curriculum.department',
            'level.program',
            'term.schoolYear',
            'term.department',
            'subject',
        ])->get();
    }

    public function getByCurriculum(int $curriculumId): Collection
    {
        return Prospectus::with([
            'level.program',
            'term.schoolYear',
            'subject',
        ])
            ->where('curriculum_id', $curriculumId)
            ->orderBy('level_id')
            ->orderBy('term_id')
            ->get();
    }

    public function getForDropdown(): Collection
    {
        return Prospectus::with('curriculum', 'level', 'term', 'subject')
            ->orderBy('curriculum_id')
            ->get();
    }

    public function create(array $data): Prospectus
    {
        return Prospectus::create($data);
    }

    public function update(Prospectus $prospectus, array $data): bool
    {
        return $prospectus->update($data);
    }

    public function delete(Prospectus $prospectus): ?bool
    {
        return $prospectus->delete();
    }
}
