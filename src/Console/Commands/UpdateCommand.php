<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class UpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-foundation:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Laravel Foundation in your application';

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
        $this->info('Updating Laravel Foundation. Please wait...');

        (new Filesystem)->deleteDirectory(resource_path('views/vendor/laravel-foundation'));
        (new Filesystem)->deleteDirectory(public_path('vendor/laravel-foundation'));

        $this->call('vendor:publish', [
            '--provider' => "SantosSabanari\LaravelFoundation\LaravelFoundationServiceProvider",
            '--tag' => 'public',
        ]);

        $this->call('vendor:publish', [
            '--provider' => "SantosSabanari\LaravelFoundation\LaravelFoundationServiceProvider",
            '--tag' => 'views',
        ]);

        $this->info('All done!');
    }
}
