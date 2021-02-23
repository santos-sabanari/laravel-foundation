<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-foundation:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Laravel Foundation in your application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.x
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Installing Laravel Foundation. Please wait...');

        $this->call('vendor:publish', [
            '--provider' => "SantosSabanari\LaravelFoundation\LaravelFoundationServiceProvider",
            '--tag' => 'config',
        ]);

        $this->call('vendor:publish', [
            '--provider' => "SantosSabanari\LaravelFoundation\LaravelFoundationServiceProvider",
            '--tag' => 'public',
        ]);

        $this->call('vendor:publish', [
            '--provider' => "SantosSabanari\LaravelFoundation\LaravelFoundationServiceProvider",
            '--tag' => 'views',
        ]);

        $this->call('vendor:publish', [
            '--provider' => "SantosSabanari\LaravelFoundation\LaravelFoundationServiceProvider",
            '--tag' => 'database',
        ]);

        // Publish vendor package
        $this->call('vendor:publish', [
            '--provider' => "Laravel\Fortify\FortifyServiceProvider"
        ]);

        $this->call('log-viewer:publish');

        $this->call('vendor:publish', [
            '--provider' => "Spatie\Activitylog\ActivitylogServiceProvider"
        ]);

        $this->call('vendor:publish', [
            '--provider' => "Spatie\Permission\PermissionServiceProvider"
        ]);

        $this->call('vendor:publish', [
            '--provider' => "ProtoneMedia\LaravelFormComponents\Support\ServiceProvider"
        ]);

        $this->call('vendor:publish', [
            '--provider' => "Spatie\LaravelSettings\LaravelSettingsServiceProvider",
            '--tag' => 'migrations',
        ]);

        $this->call('vendor:publish', [
            '--provider' => "Spatie\LaravelSettings\LaravelSettingsServiceProvider",
            '--tag' => 'settings',
        ]);

        $this->call('vendor:publish', [
            '--provider' => "LaravelPWA\Providers\LaravelPWAServiceProvider"
        ]);

        // routes
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__ . '/stubs/routes/web.stub'),
            FILE_APPEND
        );

        $this->comment('Please do:');
        $this->comment('1. uncomment web.php');
        $this->comment('2. set pwa (config, offline route & view)');

        $this->info('All done!');
    }
}
