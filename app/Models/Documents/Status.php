<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Status extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'documents_statuses';
    protected $fillable = ['name'];

    protected static $logAttributes = ['name'];
}
