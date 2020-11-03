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

        // routes
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__ . '/stubs/routes/web.stub'),
            FILE_APPEND
        );

        $this->info('All done!');
    }
}
