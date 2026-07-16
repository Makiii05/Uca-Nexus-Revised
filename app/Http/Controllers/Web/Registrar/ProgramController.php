<?php

namespace App\Http\Controllers\Web\Registrar;

use App\Http\Controllers\Controller;
use App\Http\Requests\Program\StoreProgramRequest;
use App\Http\Requests\Program\UpdateProgramRequest;
use App\Models\Program;
use App\Services\DepartmentService;
use App\Services\ProgramService;
use Illuminate\Http\RedirectResponse;

class ProgramController extends Controller
{
    public function __construct(
        private readonly ProgramService $programService,
        private readonly DepartmentService $departmentService,
    ) {}

    public function index()
    {
        $programs = $this->programService->getAll();
        $departments = $this->departmentService->getForDropdown();

        return view('portals.registrar.programs.index', compact('programs', 'departments'));
    }

    public function store(StoreProgramRequest $request): RedirectResponse
    {
        $this->programService->create($request->validated());

        return redirect()->route('registrar.programs.index')
            ->with('success', 'Program created successfully.');
    }

    public function update(UpdateProgramRequest $request, Program $program): RedirectResponse
    {
        $this->programService->update($program, $request->validated());

        return redirect()->route('registrar.programs.index')
            ->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program): RedirectResponse
    {
        $this->programService->delete($program);

        return redirect()->route('registrar.programs.index')
            ->with('success', 'Program deleted successfully.');
    }
}
