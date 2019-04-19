<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Message extends Model
{
    use Uuids;

    protected $fillable = ['message', 'receiver_id', 'user_id'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function receiver()
    {
      return $this->belongsTo('App\User', 'receiver_id');
    }
}
