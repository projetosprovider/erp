<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\task;

class TaskLogs extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

}
