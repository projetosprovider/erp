<?php

namespace App\Models\Training\Team;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'team_students';

    protected $fillable = ['team_id', 'student_id', 'status_student', 'approved'];

    protected static $logAttributes = ['team_id', 'student_id', 'status_student', 'approved'];
}
