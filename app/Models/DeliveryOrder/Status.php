<?php

namespace App\Models\DeliveryOrder;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'delivery_order_statuses';

    protected $fillable = ['name'];

    protected static $logAttributes = ['name'];
}
