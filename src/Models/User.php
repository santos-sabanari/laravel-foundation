<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use SantosSabanari\LaravelFoundation\Traits\UserAttribute;
use SantosSabanari\LaravelFoundation\Traits\UserMethod;
use SantosSabanari\LaravelFoundation\Traits\UserScope;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UserMethod, HasRoles, UserAttribute, UserScope;

    public const TYPE_ADMIN = 'admin';
    public const TYPE_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'name',
        'username',
        'email',
        'email_verified_at',
        'password',
        'password_changed_at',
        'active',
        'timezone',
        'last_login_at',
        'last_login_ip',
        'to_be_logged_out',
        'provider',
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'last_login_at',
        'email_verified_at',
        'password_changed_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'last_login_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'to_be_logged_out' => 'boolean',
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'permissions',
        'roles',
    ];

    public function scopeSearch($query,$val)
    {
        return $query
            ->where('name','like','%'.$val.'%')
            ->orWhere('username','like','%'.$val.'%');
    }
}
