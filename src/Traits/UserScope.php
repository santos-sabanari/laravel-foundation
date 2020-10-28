<?php

namespace SantosSabanari\LaravelFoundation\Traits;

/**
 * Class UserScope.
 */
trait UserScope
{

    /**
     * @param $query
     * @param $type
     *
     * @return mixed
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeAllAccess($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', config('laravel-foundation.role_admin'));
        });
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeAdmins($query)
    {
        return $query->where('type', $this::TYPE_ADMIN);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeUsers($query)
    {
        return $query->where('type', $this::TYPE_USER);
    }
}
