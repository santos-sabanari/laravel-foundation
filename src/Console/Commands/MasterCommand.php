<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use function array_filter;
use function file_exists;
use function file_get_contents;
use function file_put_contents;
use function is_dir;
use function ltrim;
use function str_replace;
use function trim;

class MasterCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:master
                            {name : The name of the master}
                            {fields* : The name of the fields}';

    protected $description = 'Create a master';

    protected $type = 'Master';

    protected $name = "";
    protected $fields = [];


    public function handle()
    {
        $this->info('Create Master');

        $this->processValidation();
        $this->getInput();

        // process
//        $this->createRequest();
        $this->createService();
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
    }

    private function createRequest()
    {
        $this->call('laravel-foundation:store-request', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);

        $this->call('laravel-foundation:update-request', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);

        $this->call('laravel-foundation:edit-request', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);

        $this->call('laravel-foundation:delete-request', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);
    }

    private function createService()
    {
        $this->call('laravel-foundation:service', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);
    }

    private function createModel()
    {
        $modelClass = $this->parseModel($this->option('model'));
        $this->call('make:model', ['name' => $modelClass]);
    }

    private function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    private function createFactory()
    {
        $factory = Str::studly($this->argument('name'));

        $this->call('make:factory', [
            'name' => "{$factory}Factory",
            '--model' => $this->qualifyClass($this->getNameInput()),
        ]);
    }

    private function createSeeder()
    {
        $seeder = Str::studly(class_basename($this->argument('name')));

        $this->call('make:seed', [
            'name' => "{$seeder}Seeder",
        ]);
    }

    private function createDatatable()
    {
        $this->info('Creating Datatable');
        $this->info('Datatable Done');
    }

    private function createController()
    {
        $controller = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:controller', array_filter([
            'name'  => "{$controller}Controller",
            '--model' => $this->option('resource') || $this->option('api') ? $modelName : null,
            '--api' => $this->option('api'),
        ]));
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
