<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class ReportCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:report
                            {name : The name of the report}';

    protected $description = 'Create a report';

    protected $type = 'Report';

    protected $name = "";
    protected $fields = [];

    public function handle()
    {
        $this->info('Create Report');

        $this->processValidation();
        $this->getInput();

        // process
        $this->createSeeder();
        $this->createLivewire();
        $this->createDatatable();
        $this->createController();
        $this->createView();
        $this->createLivewireView();
        $this->createRoute();

        $this->comment('Please do:');
        $this->comment('1. set web.php in routes');
        $this->comment('2. sidebar menu');
        $this->comment('3. load seeder');
        $this->comment('4. report datatable');

        $this->info('All done!');
    }

    private function processValidation()
    {
        // Validation
        if ($this->isReservedName($this->argument('name'))) {
            $this->error('The name "' . $this->argument('name') . '" is reserved by PHP.');

            return false;
        }

        return true;
    }

    private function getInput()
    {
        $this->name = trim($this->argument('name'));
    }

    private function createSeeder()
    {
        $this->call('laravel-foundation:seeder-report', [
            'name' => $this->name,
        ]);
    }

    private function createLivewire()
    {
        $this->call('laravel-foundation:report-form-livewire', [
            'name' => $this->name,
        ]);
    }


    private function createDatatable()
    {
        $this->call('laravel-foundation:report-datatable', [
            'name' => $this->name,
        ]);
    }

    private function createController()
    {
        $this->call('laravel-foundation:report-controller', [
            'name' => $this->name,
        ]);
    }

    private function createView()
    {
        $this->call('laravel-foundation:report-view', [
            'name' => $this->name,
        ]);
    }

    private function createRoute()
    {
        $this->call('laravel-foundation:report-route', [
            'name' => $this->name,
        ]);
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/value.stub';
    }
}
