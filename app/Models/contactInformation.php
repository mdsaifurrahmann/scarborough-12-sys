<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contactInformation extends Model
{
    protected $table = 'contact_information';

    protected $fillable = [
        'key',
        'value',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
