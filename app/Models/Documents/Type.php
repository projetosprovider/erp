<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Type extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'document_types';

    protected $fillable = ['name', 'price', 'active'];

    protected static $logAttributes = ['name', 'price', 'active'];

}
