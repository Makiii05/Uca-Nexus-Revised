<?php

namespace App\Http\Controllers\Web\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicantRequest;
use App\Services\ApplicantService;
use App\Services\LevelService;
use App\Services\ProgramService;
use App\Services\SchoolYearService;

class ApplyController extends Controller
{
    public function __construct(
        private readonly ApplicantService $applicantService,
        private readonly ProgramService $programService,
        private readonly SchoolYearService $schoolYearService,
        private readonly LevelService $levelService,
    ) {}

    public function index()
    {
        $programs = $this->programService->getForDropdown();
        $schoolYears = $this->schoolYearService->getForDropdown();
        $levels = $this->levelService->getForDropdown();

        return view('website.application.index', compact('programs', 'schoolYears', 'levels'));
    }

    public function store(StoreApplicantRequest $request)
    {
        $this->applicantService->create($request->validated());

        return redirect()->route('application.index')
            ->with('success', 'Your application has been submitted successfully. We will contact you via email.');
    }
}
