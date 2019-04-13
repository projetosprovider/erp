<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;
use App\User;

class Task extends Model
{
    use Uuids;
    use LogsActivity;

    const STATUS_PENDENTE = 1;
    const STATUS_EM_ANDAMENTO = 2;
    const STATUS_FINALIZADO = 3;
    const STATUS_CANCELADO = 4;

    protected $fillable = [
        'name', 'description', 'process_id',
        'sub_process_id', 'user_id',
        'frequency', 'time', 'method',
        'indicator', 'client_id', 'vendor_id',
        'severity', 'urgency', 'trend', 'owner_id',
        'status_id', 'created_by', 'active', 'is_model'
    ];

    protected static $logAttributes = [
      'name', 'description', 'process_id',
      'sub_process_id', 'user_id',
      'frequency', 'time', 'method',
      'indicator', 'client_id', 'vendor_id',
      'severity', 'urgency', 'trend', 'owner_id',
      'status_id', 'created_by', 'active', 'is_model'
    ];

    protected $dates = ['begin', 'end'];

    public function subprocess()
    {
        return $this->belongsTo(SubProcesses::class, 'sub_process_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function client()
    {
        return $this->belongsTo(Department::class, 'client_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Department::class, 'vendor_id');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function sponsor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mapper()
    {
        return $this->belongsTo(Mapper::class, 'mapper_id');
    }

    public function owner()
    {
        return $this->belongsTo(Client::class, 'owner_id');
    }


}
