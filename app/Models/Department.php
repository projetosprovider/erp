<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Department extends Model
{
    use Uuids;
    use LogsActivity;

    protected $fillable = ['name', 'user_id'];

    protected static $logAttributes = ['name', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function people()
    {
        return $this->hasMany('App\Models\People');
    }

    public function processes()
    {
        return $this->hasMany(Process::class);
    }

    public function occupations()
    {
        return $this->hasMany('App\Models\Department\Occupation');
    }

}
