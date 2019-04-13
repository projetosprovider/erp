<?php

namespace App\Models\DeliveryOrder;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Documents extends Model
{
    use Uuids;
    use LogsActivity;

    protected $table = 'delivery_order_documents';

    protected $fillable = ['document_id', 'delivery_order_id', 'user_id'];

    protected static $logAttributes = ['document_id', 'delivery_order_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function document()
    {
        return $this->belongsTo('App\Models\Documents');
    }

    public function deliveryOrder()
    {
        return $this->belongsTo('App\Models\DeliveryOrder');
    }
}
