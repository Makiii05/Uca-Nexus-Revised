<?php

namespace App\Http\Controllers\Web\Registrar;

use App\Http\Controllers\Controller;
use App\Http\Requests\Level\StoreLevelRequest;
use App\Http\Requests\Level\UpdateLevelRequest;
use App\Models\Level;
use App\Services\LevelService;
use App\Services\ProgramService;
use Illuminate\Http\RedirectResponse;

class LevelController extends Controller
{
    public function __construct(
        private readonly LevelService $levelService,
        private readonly ProgramService $programService,
    ) {}

    public function index()
    {
        $levels = $this->levelService->getAll();
        $programs = $this->programService->getForDropdown();

        return view('portals.registrar.levels.index', compact('levels', 'programs'));
    }

    public function store(StoreLevelRequest $request): RedirectResponse
    {
        $this->levelService->create($request->validated());

        return redirect()->route('registrar.levels.index')
            ->with('success', 'Level created successfully.');
    }

    public function update(UpdateLevelRequest $request, Level $level): RedirectResponse
    {
        $this->levelService->update($level, $request->validated());

        return redirect()->route('registrar.levels.index')
            ->with('success', 'Level updated successfully.');
    }

    public function destroy(Level $level): RedirectResponse
    {
        $this->levelService->delete($level);

        return redirect()->route('registrar.levels.index')
            ->with('success', 'Level deleted successfully.');
    }
}
