<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Car extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'fleet_cars';
}
