<?php

namespace App\Models\Fleet\Car;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Status extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'fleet_car_statues';
}
