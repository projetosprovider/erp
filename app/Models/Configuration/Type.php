<?php

namespace App\Models\configuration;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'configurations_types';

    protected $fillable = ['name', 'active'];
}
