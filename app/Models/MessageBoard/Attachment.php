<?php

namespace App\Models\MessageBoard;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Attachment extends Model
{
    use Uuids;

    protected $table = 'meassage_board_attachments';

    protected $fillable = ['link', 'board_id', 'filename', 'extension'];
    protected static $logAttributes = ['link', 'board_id', 'filename', 'extension'];
}
