<?php

namespace App\Enums;

enum RolePermissionLabels: string
{
    case VIEW = 'View';
    case CREATE = 'Create';
    case UPDATE = 'Update';
    case DELETE = 'Delete';
    case MANAGE = 'Manage';

}
