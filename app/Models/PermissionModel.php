<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;

class PermissionModel extends SpatiePermission
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = ['name', 'label', 'group_id', 'guard_name'];
}
