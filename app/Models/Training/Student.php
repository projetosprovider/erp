<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{
    use Uuids;
    use LogsActivity;

    protected $fillable = ['name', 'email', 'phone', 'cpf', 'biometric', 'company_id', 'created_by'];

    protected static $logAttributes = ['name', 'email', 'phone', 'cpf', 'biometric', 'company_id', 'created_by'];

    protected $table = 'students';

    public function company()
    {
        return $this->belongsTo('App\Models\Client', 'company_id');
    }
}
