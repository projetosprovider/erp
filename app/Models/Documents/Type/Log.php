<?php

namespace App\Models\Documents\Type;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Log extends Model
{
    use Uuids;

    protected $table = 'document_type_log';

    protected $fillable = ['type_id', 'old_price', 'new_price', 'updated_by'];

    protected static $logAttributes = ['type_id', 'old_price', 'new_price', 'updated_by'];
}
