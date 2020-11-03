<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SantosSabanari\LaravelFoundation\Traits\RoleAttribute;
use SantosSabanari\LaravelFoundation\Traits\RoleMethod;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use RoleAttribute,
        RoleMethod;

    /**
     * @var string[]
     */
    protected $with = [
        'permissions',
    ];
}
