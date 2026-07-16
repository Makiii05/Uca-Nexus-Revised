<?php

namespace App\Enums;

enum SubjectType: string
{
    case Lecture = 'lecture';
    case Laboratory = 'laboratory';
    case LectureLab = 'lecture_lab';

    public function label(): string
    {
        return match ($this) {
            self::Lecture => 'Lecture',
            self::Laboratory => 'Laboratory',
            self::LectureLab => 'Lecture / Lab',
        };
    }
}