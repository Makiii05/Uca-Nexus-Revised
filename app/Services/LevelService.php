<?php

namespace App\Services;

use App\Models\Level;
use Illuminate\Database\Eloquent\Collection;

class LevelService
{
    public function getAll(): Collection
    {
        return Level::with('program.department')->orderBy('program_id')->orderBy('order')->get();
    }

    public function create(array $data): Level
    {
        return Level::create($data);
    }

    public function update(Level $level, array $data): bool
    {
        return $level->update($data);
    }

    public function delete(Level $level): ?bool
    {
        return $level->delete();
    }
}
