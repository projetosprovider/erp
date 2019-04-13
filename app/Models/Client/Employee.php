<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Employee extends Model
{
    use Uuids;
    use LogsActivity;

    protected $fillable = ['name', 'email', 'phone', 'cpf', 'biometric', 'company_id', 'created_by', 'active'];

    protected static $logAttributes = ['name', 'email', 'phone', 'cpf', 'biometric', 'company_id', 'created_by', 'active'];

    protected $table = 'employees';

    public function company()
    {
        return $this->belongsTo('App\Models\Client', 'company_id');
    }
}
