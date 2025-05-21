<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    protected $casts = [
        'name' => 'string',
    ];

    public function permissions()
    {
        return $this->hasMany(PermissionModel::class);
    }
}
