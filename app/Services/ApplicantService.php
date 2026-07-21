<?php

namespace App\Services;

use App\Models\Applicant;
use App\Models\ApplicantContact;
use App\Models\ApplicantEducation;
use App\Models\ApplicantGuardian;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ApplicantService
{
    public function getForDropdown(): Collection
    {
        return Applicant::orderBy('last_name')->get();
    }

    public function create(array $data): Applicant
    {
        return DB::transaction(function () use ($data) {
            $data['application_no'] = $this->generateApplicationNo();
            $data['status'] = 'pending';

            $applicant = Applicant::create($data);

            if ($contact = $data['contact'] ?? null) {
                $contact['applicant_id'] = $applicant->id;
                ApplicantContact::create($contact);
            }

            foreach ($data['guardians'] ?? [] as $guardianData) {
                $guardianData['applicant_id'] = $applicant->id;
                ApplicantGuardian::create($guardianData);
            }

            foreach ($data['education'] ?? [] as $eduData) {
                $eduData['applicant_id'] = $applicant->id;
                ApplicantEducation::create($eduData);
            }

            return $applicant;
        });
    }

    private function generateApplicationNo(): string
    {
        $year = date('Y');
        $latest = Applicant::where('application_no', 'like', "APP-{$year}-%")
            ->orderBy('id', 'desc')
            ->value('application_no');

        if ($latest) {
            $seq = (int) substr($latest, -4) + 1;
        } else {
            $seq = 1;
        }

        return sprintf('APP-%s-%04d', $year, $seq);
    }
}
