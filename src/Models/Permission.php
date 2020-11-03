<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;
use SantosSabanari\LaravelFoundation\Traits\PermissionScope;
use SantosSabanari\LaravelFoundation\Traits\PermissionRelationship;

class Permission extends SpatiePermission
{
    use PermissionRelationship,
        PermissionScope;
}
