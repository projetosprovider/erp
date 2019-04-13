<?php

namespace App\Models\MessageBoard;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Type extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'meassage_board_types';

    protected $fillable = ['name'];
    protected static $logAttributes = ['name'];
}
