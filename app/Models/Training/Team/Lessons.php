<?php

namespace App\Models\Training\Team;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Lessons extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'team_lessons';

    protected $fillable = ['team_id', 'start', 'end', 'biometric', 'lat', 'long'];

    protected static $logAttributes = ['team_id', 'start', 'end', 'biometric', 'lat', 'long'];
}
