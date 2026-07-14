<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'type', 'image_url', 'title', 'description', 'event_date',
    'location', 'embedded_url', 'days', 'is_open', 'start_time',
    'end_time', 'email', 'contact', 'social_link',
])]
class Website extends Model
{
    protected function casts(): array
    {
        return [
            'is_open' => 'boolean',
            'event_date' => 'date',
        ];
    }
}
