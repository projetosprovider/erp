<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class DeliveryOrder extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'delivery_order';

    protected $fillable = ['status_id', 'client_id', 'delivered_by', 'delivered_at', 'receipt', 'annotations', 'delivery_date'];

    protected static $logAttributes = ['status_id', 'client_id', 'delivered_by', 'delivered_at', 'receipt', 'annotations', 'delivery_date'];

    protected $dates = ['delivery_date'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function documents()
    {
        return $this->hasMany('App\Models\DeliveryOrder\Documents');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\DeliveryOrder\Status');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'delivered_by');
    }
}
