<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class SubProcesses extends Model
{
    use Uuids;
    use LogsActivity;

    protected $fillable = ['name', 'process_id'];

    protected static $logAttributes = ['name', 'process_id'];

    public function process()
    {
        return $this->belongsTo(Process::class, 'process_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'sub_process_id');
    }

    public function taskModels()
    {
        return $this->hasMany(TaskModels::class, 'sub_process_id');
    }
}
