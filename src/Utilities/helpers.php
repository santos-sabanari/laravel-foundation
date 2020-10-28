<?php

use Carbon\Carbon;
use JamesMills\LaravelTimezone\Timezone;

if (! function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'Laravel Boilerplate');
    }
}

if (! function_exists('carbon')) {
    /**
     * Create a new Carbon instance from a time.
     *
     * @param $time
     *
     * @return Carbon
     * @throws Exception
     */
    function carbon($time)
    {
        return new Carbon($time);
    }
}

if (! function_exists('homeRoute')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function homeRoute()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return 'backend.dashboard';
            }

            if (auth()->user()->isUser()) {
                return '/user';
            }
        }

        return '/';
    }
}

if (! function_exists('activeClass')) {
    /**
     * Get the active class if the condition is not falsy.
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function activeClass($condition, $activeClass = 'active', $inactiveClass = '')
    {
        return $condition ? $activeClass : $inactiveClass;
    }
}
