<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = json_decode(file_get_contents(base_path('subjects.json')), true);

        foreach ($subjects as $item) {
            Subject::create([
                'code' => $item['code'],
                'description' => $item['description'],
                'unit' => $item['unit'],
                'lech' => (int) ($item['lec_hour'] ?: 0),
                'lecu' => $item['lec_unit'],
                'labh' => (int) ($item['lab_hour'] ?: 0),
                'labu' => $item['lab_unit'],
                'type' => match ($item['type']) {
                    'Lecture / Lab' => 'lecture_lab',
                    'Lecture' => 'lecture',
                    'Laboratory' => 'laboratory',
                    default => 'lecture',
                },
                'education_level' => $item['education_level'],
                'status' => $item['status'],
            ]);
        }
    }
}
