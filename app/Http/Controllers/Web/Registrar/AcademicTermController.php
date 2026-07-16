<?php

namespace App\Http\Controllers\Web\Registrar;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicTerm\StoreAcademicTermRequest;
use App\Http\Requests\AcademicTerm\UpdateAcademicTermRequest;
use App\Models\AcademicTerm;
use App\Services\AcademicTermService;
use App\Services\DepartmentService;
use App\Services\SchoolYearService;
use Illuminate\Http\RedirectResponse;

class AcademicTermController extends Controller
{
    public function __construct(
        private readonly AcademicTermService $academicTermService,
        private readonly SchoolYearService $schoolYearService,
        private readonly DepartmentService $departmentService,
    ) {}

    public function index()
    {
        $academicTerms = $this->academicTermService->getAll();
        $schoolYears = $this->schoolYearService->getForDropdown();
        $departments = $this->departmentService->getForDropdown();

        return view('portals.registrar.academic-terms.index', compact('academicTerms', 'schoolYears', 'departments'));
    }

    public function store(StoreAcademicTermRequest $request): RedirectResponse
    {
        $this->academicTermService->create($request->validated());

        return redirect()->route('registrar.academic-terms.index')
            ->with('success', 'Academic Term created successfully.');
    }

    public function update(UpdateAcademicTermRequest $request, AcademicTerm $academicTerm): RedirectResponse
    {
        $this->academicTermService->update($academicTerm, $request->validated());

        return redirect()->route('registrar.academic-terms.index')
            ->with('success', 'Academic Term updated successfully.');
    }

    public function destroy(AcademicTerm $academicTerm): RedirectResponse
    {
        $this->academicTermService->delete($academicTerm);

        return redirect()->route('registrar.academic-terms.index')
            ->with('success', 'Academic Term deleted successfully.');
    }
}
