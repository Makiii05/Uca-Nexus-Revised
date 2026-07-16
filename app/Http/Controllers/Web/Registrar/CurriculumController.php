<?php

namespace App\Http\Controllers\Web\Registrar;

use App\Http\Controllers\Controller;
use App\Http\Requests\Curriculum\StoreCurriculumRequest;
use App\Http\Requests\Curriculum\UpdateCurriculumRequest;
use App\Models\Curriculum;
use App\Services\CurriculumService;
use App\Services\DepartmentService;
use Illuminate\Http\RedirectResponse;

class CurriculumController extends Controller
{
    public function __construct(
        private readonly CurriculumService $curriculumService,
        private readonly DepartmentService $departmentService,
    ) {}

    public function index()
    {
        $curricula = $this->curriculumService->getAll();
        $departments = $this->departmentService->getForDropdown();

        return view('portals.registrar.curricula.index', compact('curricula', 'departments'));
    }

    public function store(StoreCurriculumRequest $request): RedirectResponse
    {
        $this->curriculumService->create($request->validated());

        return redirect()->route('registrar.curricula.index')
            ->with('success', 'Curriculum created successfully.');
    }

    public function update(UpdateCurriculumRequest $request, Curriculum $curriculum): RedirectResponse
    {
        $this->curriculumService->update($curriculum, $request->validated());

        return redirect()->route('registrar.curricula.index')
            ->with('success', 'Curriculum updated successfully.');
    }

    public function destroy(Curriculum $curriculum): RedirectResponse
    {
        $this->curriculumService->delete($curriculum);

        return redirect()->route('registrar.curricula.index')
            ->with('success', 'Curriculum deleted successfully.');
    }
}
