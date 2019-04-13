<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use Uuids;
    use LogsActivity;

    protected $fillable = ['name', 'email', 'phone', 'document', 'active'];

    protected static $logAttributes = ['name', 'email', 'phone', 'document', 'active'];

    public function documents()
    {
        return $this->hasMany('App\Models\Documents', 'client_id');
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Client\Address', 'client_id');
    }

    public function employees()
    {
        return $this->hasMany('App\Models\Client\Employee', 'company_id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        if($eventName == 'updated') {
            return "Cliente atualizado";
        } elseif ($eventName == 'deleted') {
            return "Cliente Removido";
        }

        return "Cliente Adicionado";
    }
}
