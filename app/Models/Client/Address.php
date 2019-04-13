<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Address extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'addresses';

    protected $fillable = ['description', 'complement', 'reference', 'zip', 'street', 'number', 'district', 'state', 'city', 'long', 'lat', 'user_id', 'client_id', 'is_default'];

    protected static $logAttributes = ['description', 'complement', 'reference', 'zip', 'street', 'number', 'district', 'state', 'city', 'long', 'lat', 'user_id', 'client_id', 'is_default'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        if($eventName == 'updated') {
            return "Endereço atualizado";
        } elseif ($eventName == 'deleted') {
            return "Endereço Removido";
        }

        return "Endereço Adicionado";
    }
}
