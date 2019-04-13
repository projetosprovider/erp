<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TaskMessages extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
