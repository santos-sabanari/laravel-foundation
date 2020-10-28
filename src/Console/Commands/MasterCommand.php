<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use function trim;

class MasterCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:master
                            {name : The name of the master}
                            {fields* : The name of the fields}';

    protected $description = 'Create a master';

    protected $rootNamespace = "";
    protected $name = "";
    protected $fields = [];


    public function handle()
    {
        $this->info('Create Master');

        $this->processValidation();
        $this->getInput();

        $this->comment($this->rootNamespace."\Santos");
        return false;

        // process
        $this->createRequest();
//        $this->createService();
//        $this->createModel();
//        $this->createMigration();
//        $this->createFactory();
//        $this->createSeeder();
//        $this->createDatatable();
//        $this->createController();
//        $this->createView();
//        $this->createRoute();

        $this->info('All done!');
    }

    private function processValidation()
    {
        // Validation
        if ($this->isReservedName($this->argument('name'))) {
            $this->error('The name "' . $this->argument('name') . '" is reserved by PHP.');

            return false;
        }

        foreach ($this->argument('fields') as $field) {
            if ($this->isReservedName($field)) {
                $this->error('The field "' . $field . '" is reserved by PHP.');

                return false;
            }
        }
    }

    private function getInput()
    {
        $this->name = trim($this->argument('name'));

        foreach ($this->argument('fields') as $field) {
            $this->fields [] = trim($field);
        }

        $this->rootNamespace = $this->getLaravel()->getNamespace();
    }

    private function createRequest()
    {
        $this->info('Creating Request');
        $namespace = $this->rootNamespace . "Request";

        $this->comment($namespace);

        $this->info('Request Done');
    }

    private function createService()
    {
        $this->info('Creating Service');
        $this->info('Service Done');
    }

    private function createModel()
    {
        $this->info('Creating Model');
        $this->info('Model Done');
    }

    private function createMigration()
    {
        $this->info('Creating Migration');
        $table = Str::snake(Str::pluralStudly(class_basename($this->name)));

        $this->info('Migration Done');
    }

    private function createFactory()
    {
        $this->info('Creating Factory');
        $factory = Str::studly($this->name);

        $this->info('Factory Done');
    }

    private function createSeeder()
    {
        $this->info('Creating Seeder');
        $seeder = Str::studly(class_basename($this->name));

        $this->info('Seeder Done');
    }

    private function createDatatable()
    {
        $this->info('Creating Datatable');
        $this->info('Datatable Done');
    }

    private function createController()
    {
        $this->info('Creating Controller');
        $controller = Str::studly(class_basename($this->name));

        $this->info('Controller Done');
    }

    private function createView()
    {
        $this->info('Creating View');
        $this->info('View Done');
    }

    private function createRoute()
    {
        $this->info('Creating Route');
        $this->info('Route Done');
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/value.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Nebula\Metrics';
    }
}
