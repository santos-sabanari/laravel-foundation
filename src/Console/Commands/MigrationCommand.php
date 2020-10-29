<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use function date;
use function implode;
use function ltrim;
use function str_replace;
use function trim;
use const DIRECTORY_SEPARATOR;

class MigrationCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:migration
                            {name : The name of the migration}
                            {fields* : The migration fields}';

    protected $description = 'Create a migration';

    protected $type = 'Migration';

    protected function getPath($name)
    {
        $name = date("Y_m_d_His") . "_" . $name;

        return $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'migrations' . '/' . str_replace('\\', '/', $name) . '.php';
    }

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');
        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $LastNameBefore = Str::of($name)->afterLast('\\');
        $lastNameAfter = Str::of($name)->afterLast('\\')->lower()->prepend("create_")->append("_table");
        $name = str_replace($LastNameBefore, $lastNameAfter, $name);

        return $name;
    }

    protected function replaceClass($stub, $name)
    {
        $studly = Str::studly($this->argument('name'));
        $stub = str_replace('{{StudlyCase}}', $studly, $stub);

        $camel = Str::camel($this->argument('name'));
        $stub = str_replace('{{camelCase}}', $camel, $stub);

        $fields = [];
        foreach ($this->argument('fields') as $field) {
            $fields [] = '$table->string('."'$field');";
        }

        $text = implode("\n\t\t\t", $fields);

        return str_replace('DummyFields', $text, $stub);

    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/database/migration.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return '';
    }
}
