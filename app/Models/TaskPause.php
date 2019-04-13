<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Task;
use App\User;

class TaskPause extends Model
{
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
