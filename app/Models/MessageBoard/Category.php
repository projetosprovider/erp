<?php

namespace App\Models\MessageBoard;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Category extends Model
{
    use Uuids;

    protected $table = 'meassage_board_categories';

    protected $fillable = ['category_id', 'board_id'];
    protected static $logAttributes = ['category_id', 'board_id'];
}
