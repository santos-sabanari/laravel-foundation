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

class FactoryCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:factory
                            {name : The name of the factory}
                            {fields* : The factory fields}';

    protected $description = 'Create a factory';

    protected $type = 'Factory';

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'factories' . '/' . str_replace('\\', '/', $name) . '.php';
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
        $lastNameAfter = Str::of($name)->afterLast('\\')->studly()->append("Factory");
        $name = str_replace($LastNameBefore, $lastNameAfter, $name);

        return $name;
    }

    protected function replaceClass($stub, $name)
    {
        $studly = Str::studly($this->argument('name'));
        $stub = str_replace('{{StudlyCase}}', $studly, $stub);

        $camel = Str::camel($this->argument('name'));
        $stub = str_replace('{{camelCase}}', $camel, $stub);
        $stub = str_replace('DummyFactoryNamespace', 'Database\Factories', $stub);

        $fields = [];
        foreach ($this->argument('fields') as $field) {
//            $fields [] = '$table->string(' . "'$field');";
            $fields [] = "'$field'".' => $this->faker->name,';
        }

        $text = implode("\n\t\t\t", $fields);

        return str_replace('DummyDefinitions', $text, $stub);

    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/database/factory.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return 'Database\Factories';
    }
}
