<?php

namespace App\Http\Controllers\Web\Registrar;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Models\Subject;
use App\Services\SubjectService;
use Illuminate\Http\RedirectResponse;

class SubjectController extends Controller
{
    public function __construct(
        private readonly SubjectService $subjectService,
    ) {}

    public function index()
    {
        $subjects = $this->subjectService->getAll();

        return view('portals.registrar.subjects.index', compact('subjects'));
    }

    public function store(StoreSubjectRequest $request): RedirectResponse
    {
        $this->subjectService->create($request->validated());

        return redirect()->route('registrar.subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    public function update(UpdateSubjectRequest $request, Subject $subject): RedirectResponse
    {
        $this->subjectService->update($subject, $request->validated());

        return redirect()->route('registrar.subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject): RedirectResponse
    {
        $this->subjectService->delete($subject);

        return redirect()->route('registrar.subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }
}
