<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TaskModels extends Model
{
    protected $fillable = [
        'description', 'sub_process_id', 'user_id',
        'frequency', 'time', 'method',
        'indicator', 'client_id', 'vendor_id',
        'severity', 'urgency', 'trend',
        'created_by', 'active'
    ];

    protected $dates = ['begin', 'end'];

    public function process()
    {
        return $this->belongsTo(Process::class, 'process_id');
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
}
