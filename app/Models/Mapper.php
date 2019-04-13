<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Mapper extends Model
{
    public function tasks()
    {
        return $this->hasMany(Task::class, 'mapper_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(MapperStatus::class, 'status_id');
    }
}
