<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Course extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'courses';

    protected $fillable = ['title', 'description', 'workload', 'created_by', 'grade'];

    protected static $logAttributes = ['title', 'description', 'workload', 'created_by', 'grade'];
}
