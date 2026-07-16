<?php

namespace App\Enums;

enum EducationLevel: string
{
    case College = 'college';
    case K12 = 'K12';

    public function label(): string
    {
        return match ($this) {
            self::College => 'College',
            self::K12 => 'K-12',
        };
    }
}
