<?php

namespace SantosSabanari\LaravelFoundation;

include_once(__DIR__ . '/Utilities/helpers.php');

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use SantosSabanari\LaravelFoundation\Console\Commands\InstallCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\MasterCommand;
use SantosSabanari\LaravelFoundation\Http\Livewire\RolesDatatable;
use SantosSabanari\LaravelFoundation\Http\Livewire\UsersDatatable;

class LaravelFoundationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-foundation');

        Livewire::component('users-datatable', UsersDatatable::class);
        Livewire::component('roles-datatable', RolesDatatable::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('laravel-foundation.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/laravel-foundation'),
            ], 'public');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/laravel-foundation'),
            ], 'views');

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'migrations');

            // Registering package commands.
            $this->commands([
                InstallCommand::class,
                MasterCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravel-foundation');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-foundation', function () {
            return new LaravelFoundation;
        });
    }
}
