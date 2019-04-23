<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configurations';

    protected $fillable = ['name', 'description', 'slug', 'value', 'active', 'type_id', 'model', 'can_drop'];

    public function type()
    {
        return $this->belongsTo('App\Models\Configuration\Type', 'type_id');
    }
}
