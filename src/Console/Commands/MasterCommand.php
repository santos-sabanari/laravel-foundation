<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

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
//        $this->createService();
//        $this->createModel();
//        $this->createEvent();
//        $this->createTrait();
//        $this->createListener();
//        $this->createMigration();
//        $this->createFactory();
//        $this->createSeeder();
//        $this->createDatatable();
//        $this->createController();
        $this->createView();
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
        $this->call('laravel-foundation:model', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);
    }

    private function createEvent()
    {
        $this->call('laravel-foundation:event-created', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);

        $this->call('laravel-foundation:event-updated', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);

        $this->call('laravel-foundation:event-deleted', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);
    }

    private function createTrait()
    {
        $this->call('laravel-foundation:trait-attribute', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);

        $this->call('laravel-foundation:trait-method', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);

        $this->call('laravel-foundation:trait-scope', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);
    }

    private function createListener()
    {
        $this->call('laravel-foundation:listener', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);
    }

    private function createMigration()
    {
        $this->call('laravel-foundation:migration', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);
    }

    private function createFactory()
    {
        $this->call('laravel-foundation:factory', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);
    }

    private function createSeeder()
    {
        $this->call('laravel-foundation:seeder', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);
    }

    private function createDatatable()
    {
        $this->call('laravel-foundation:datatable', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);
    }

    private function createController()
    {
        $this->call('laravel-foundation:controller', [
            'name' => $this->name,
            'fields' => $this->fields,
        ]);
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
        return __DIR__ . '/stubs/value.stub';
    }
}
