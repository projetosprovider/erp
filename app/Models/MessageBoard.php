<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class MessageBoard extends Model
{
    use Uuids;
    use LogsActivity;

    protected $fillable = ['subject','created_by', 'type_id', 'content', 'like', 'important'];

    protected static $logAttributes = ['subject','created_by', 'type_id', 'content', 'like', 'important'];

    protected $table = 'meassage_boards';

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function attachments()
    {
        return $this->hasMany('App\Models\MessageBoard\Attachment', 'board_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\MessageBoard\User', 'board_id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        if($eventName == 'updated') {
            return "Recado atualizado";
        } elseif ($eventName == 'deleted') {
            return "Recado removido";
        }

        return "Recado adicionado";
    }
}
