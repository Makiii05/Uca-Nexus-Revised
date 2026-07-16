<?php

namespace App\Http\Controllers\Web\Registrar;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolYear\StoreSchoolYearRequest;
use App\Http\Requests\SchoolYear\UpdateSchoolYearRequest;
use App\Models\SchoolYear;
use App\Services\SchoolYearService;
use Illuminate\Http\RedirectResponse;

class SchoolYearController extends Controller
{
    public function __construct(
        private readonly SchoolYearService $schoolYearService,
    ) {}

    public function index()
    {
        $schoolYears = $this->schoolYearService->getAll();

        return view('portals.registrar.school-years.index', compact('schoolYears'));
    }

    public function store(StoreSchoolYearRequest $request): RedirectResponse
    {
        $this->schoolYearService->create($request->validated());

        return redirect()->route('registrar.school-years.index')
            ->with('success', 'School Year created successfully.');
    }

    public function update(UpdateSchoolYearRequest $request, SchoolYear $schoolYear): RedirectResponse
    {
        $this->schoolYearService->update($schoolYear, $request->validated());

        return redirect()->route('registrar.school-years.index')
            ->with('success', 'School Year updated successfully.');
    }

    public function destroy(SchoolYear $schoolYear): RedirectResponse
    {
        $this->schoolYearService->delete($schoolYear);

        return redirect()->route('registrar.school-years.index')
            ->with('success', 'School Year deleted successfully.');
    }
}
