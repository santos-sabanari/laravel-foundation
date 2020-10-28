<?php

namespace SantosSabanari\LaravelFoundation;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SantosSabanari\LaravelFoundation\Skeleton\SkeletonClass
 */
class LaravelFoundationFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-foundation';
    }
}
