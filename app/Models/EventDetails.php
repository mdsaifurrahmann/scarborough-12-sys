<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventDetails extends Model
{
    protected $table = 'event_details';

    protected $fillable = [
        'key',
        'value',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
