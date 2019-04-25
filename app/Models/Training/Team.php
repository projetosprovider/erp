<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Team extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'teams';

    protected $fillable = ['course_id', 'teacher_id', 'status', 'vacancies'];

    protected static $logAttributes = ['course_id', 'teacher_id', 'status', 'vacancies'];
}
