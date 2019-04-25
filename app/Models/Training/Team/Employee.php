<?php

namespace App\Models\Training\Team;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Employee extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'team_employees';

    protected $fillable = ['team_id', 'employee_id', 'status', 'approved'];

    protected static $logAttributes = ['team_id', 'employee_id', 'status', 'approved'];
}
