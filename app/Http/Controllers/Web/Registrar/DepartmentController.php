<?php

namespace App\Http\Controllers\Web\Registrar;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Http\RedirectResponse;

class DepartmentController extends Controller
{
    public function __construct(
        private readonly DepartmentService $departmentService,
    ) {}

    public function index()
    {
        $departments = $this->departmentService->getAll();

        return view('portals.registrar.departments.index', compact('departments'));
    }

    public function store(StoreDepartmentRequest $request): RedirectResponse
    {
        $this->departmentService->create($request->validated());

        return redirect()->route('registrar.departments.index')
            ->with('success', 'Department created successfully.');
    }

    public function update(UpdateDepartmentRequest $request, Department $department): RedirectResponse
    {
        $this->departmentService->update($department, $request->validated());

        return redirect()->route('registrar.departments.index')
            ->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department): RedirectResponse
    {
        $this->departmentService->delete($department);

        return redirect()->route('registrar.departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
