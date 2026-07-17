<?php

namespace App\Http\Controllers\Web\Registrar;

use App\Http\Controllers\Controller;
use App\Http\Requests\Prospectus\StoreProspectusRequest;
use App\Http\Requests\Prospectus\UpdateProspectusRequest;
use App\Models\Curriculum;
use App\Models\Prospectus;
use App\Services\AcademicTermService;
use App\Services\CurriculumService;
use App\Services\DepartmentService;
use App\Services\LevelService;
use App\Services\ProspectusService;
use App\Services\SubjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProspectusController extends Controller
{
    public function __construct(
        private readonly ProspectusService $prospectusService,
        private readonly DepartmentService $departmentService,
        private readonly CurriculumService $curriculumService,
        private readonly LevelService $levelService,
        private readonly AcademicTermService $academicTermService,
        private readonly SubjectService $subjectService,
    ) {}

    public function index(Request $request)
    {
        $departments = $this->departmentService->getForDropdown();
        $curriculumId = $request->query('curriculum_id');
        $departmentId = $request->query('department_id');

        $curricula = $departmentId
            ? $this->curriculumService->getByDepartment($departmentId)
            : collect();

        $prospectus = null;
        $selectedCurriculum = null;

        if ($curriculumId) {
            $selectedCurriculum = Curriculum::with('department')->find($curriculumId);
            $prospectus = $this->prospectusService->getByCurriculum($curriculumId);
        }

        $levels = $this->levelService->getForDropdown();
        $terms = $this->academicTermService->getForDropdown();
        $subjects = $this->subjectService->getForDropdown();

        return view('portals.registrar.prospectus.index', compact(
            'departments',
            'curricula',
            'curriculumId',
            'departmentId',
            'prospectus',
            'selectedCurriculum',
            'levels',
            'terms',
            'subjects',
        ));
    }

    public function curriculaByDepartment(Request $request): JsonResponse
    {
        $request->validate(['department_id' => 'required|exists:departments,id']);

        $curricula = $this->curriculumService->getByDepartment($request->integer('department_id'));

        return response()->json($curricula);
    }

    public function store(StoreProspectusRequest $request): RedirectResponse
    {
        $prospectus = $this->prospectusService->create($request->validated());

        return redirect()
            ->route('registrar.prospectus.index', [
                'department_id' => $request->department_id ?? $prospectus->curriculum->department_id,
                'curriculum_id' => $prospectus->curriculum_id,
            ])
            ->with('success', 'Subject added to prospectus successfully.')
            ->with('new_prospectus_id', $prospectus->id);
    }

    public function update(UpdateProspectusRequest $request, Prospectus $prospectus): RedirectResponse
    {
        $this->prospectusService->update($prospectus, $request->validated());

        return redirect()
            ->route('registrar.prospectus.index', [
                'department_id' => $request->department_id ?? $prospectus->curriculum->department_id,
                'curriculum_id' => $prospectus->curriculum_id,
            ])
            ->with('success', 'Prospectus entry updated successfully.');
    }

    public function destroy(Prospectus $prospectus): RedirectResponse
    {
        $curriculumId = $prospectus->curriculum_id;
        $departmentId = $prospectus->curriculum->department_id;

        $this->prospectusService->delete($prospectus);

        return redirect()
            ->route('registrar.prospectus.index', [
                'department_id' => $departmentId,
                'curriculum_id' => $curriculumId,
            ])
            ->with('success', 'Subject removed from prospectus successfully.');
    }
}
