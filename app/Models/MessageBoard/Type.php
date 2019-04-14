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

    public function getDescriptionForEvent(string $eventName): string
    {
        if($eventName == 'updated') {
            return "Tipo de atualizado";
        } elseif ($eventName == 'deleted') {
            return "Funcionário removido";
        }

        return "Novo tipo de adicionado";
    }
}
