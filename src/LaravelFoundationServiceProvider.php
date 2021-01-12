<?php

namespace SantosSabanari\LaravelFoundation;

include_once(__DIR__ . '/Utilities/helpers.php');

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Livewire\Livewire;
use SantosSabanari\LaravelFoundation\Console\Commands\ControllerCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\CreateFormCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\CreateFormLivewireCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\DatatableCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\DeleteMasterCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\DeleteReportCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\DeleteRequestCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\DeleteTableCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\EditFormLivewireCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\EditRequestCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\EventCreatedCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\EventDeletedCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\EventUpdatedCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\FactoryCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\InstallCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\ListenerCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\LivewireViewCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\MasterCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\MigrationCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\ModelCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\ReportCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\ReportControllerCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\ReportDatatableCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\ReportFormLivewireCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\ReportRouteCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\ReportViewCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\RouteCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\SeederCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\SeederReportCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\ServiceCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\StoreRequestCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\TableCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\TraitAttributeCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\TraitMethodCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\TraitScopeCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\UpdateCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\UpdateRequestCommand;
use SantosSabanari\LaravelFoundation\Console\Commands\ViewCommand;
use SantosSabanari\LaravelFoundation\Events\UserLoggedIn;
use SantosSabanari\LaravelFoundation\Http\Livewire\RolesDatatable;
use SantosSabanari\LaravelFoundation\Http\Livewire\UsersDatatable;
use SantosSabanari\LaravelFoundation\View\Components\FormDate;

class LaravelFoundationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-foundation');
        $this->processFortify();

        Livewire::component('users-datatable', UsersDatatable::class);
        Livewire::component('roles-datatable', RolesDatatable::class);
        Blade::component('form-date', FormDate::class);

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
                __DIR__ . '/../database/migrations' => database_path('migrations'),
                __DIR__ . '/../database/factories' => database_path('factories'),
                __DIR__ . '/../database/seeders' => database_path('seeders'),
                __DIR__ . '/Models' => app_path('Models'),
            ], 'database');

            // Registering package commands.
            $this->commands([
                InstallCommand::class,
                UpdateCommand::class,
                MasterCommand::class,
                TableCommand::class,
                DeleteMasterCommand::class,
                DeleteTableCommand::class,
                ServiceCommand::class,
                ModelCommand::class,
                EventCreatedCommand::class,
                EventUpdatedCommand::class,
                EventDeletedCommand::class,
                TraitAttributeCommand::class,
                TraitMethodCommand::class,
                TraitScopeCommand::class,
                ListenerCommand::class,
                MigrationCommand::class,
                FactoryCommand::class,
                SeederCommand::class,
                DatatableCommand::class,
                ControllerCommand::class,
                ViewCommand::class,
                LivewireViewCommand::class,
                CreateFormLivewireCommand::class,
                EditFormLivewireCommand::class,
                RouteCommand::class,

                // Report
                ReportCommand::class,
                DeleteReportCommand::class,
                ReportControllerCommand::class,
                ReportDatatableCommand::class,
                ReportFormLivewireCommand::class,
                ReportRouteCommand::class,
                ReportViewCommand::class,
                SeederReportCommand::class,
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

    private function processFortify()
    {
        if (class_exists(Fortify::class)) {
            // Login
            Fortify::loginView(function () {
                return view('laravel-foundation::auth.login');
            });

            Fortify::authenticateUsing(function (LoginRequest $request) {
                $user = User::where('email', $request->username)->first();
                if (! $user) {
                    $user = User::where('username', $request->username)->first();
                }

                if ($user &&
                    Hash::check($request->password, $user->password)) {
                    event(new UserLoggedIn($user));

                    return $user;
                }
            });
        }
    }
}
