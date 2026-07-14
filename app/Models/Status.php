<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['enrollment_status', 'student_portal_status', 'visible_grade', 'submission_of_grade'])]
class Status extends Model
{
    protected $table = 'statuses';
}
