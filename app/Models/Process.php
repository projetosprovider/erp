<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Process extends Model
{
    use Uuids;
    use LogsActivity;

    protected $fillable = ['name', 'department_id', 'frequency_id'];

    protected $dates = ['range_start', 'range_end'];

    protected static $logAttributes = ['name', 'department_id', 'frequency_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function subprocesses()
    {
        return $this->hasMany(SubProcesses::class, 'process_id');
    }

    public function tasks()
    {
        return $this->hasMany(SubProcesses::class, 'process_id');
    }
}
