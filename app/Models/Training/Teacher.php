<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Teacher extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'teachers';

    protected $fillable = ['name', 'email', 'phone', 'cpf'];

    protected static $logAttributes = ['name', 'email', 'phone', 'cpf'];
}
