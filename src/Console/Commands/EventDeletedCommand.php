<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class EventDeletedCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:event-deleted
                            {name : The name of the event deleted}
                            {fields* : The event deleted fields}';

    protected $description = 'Create a event deleted';

    protected $type = 'Event Deleted';

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');
        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $LastNameBefore = Str::of($name)->afterLast('\\');
        $lastNameAfter = Str::of($name)->afterLast('\\')->studly()->append("Deleted");
        $name = str_replace($LastNameBefore, $lastNameAfter, $name);

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name;
    }

    protected function replaceClass($stub, $name)
    {
        $studly = Str::studly($this->argument('name'));
        $stub = str_replace('{{StudlyCase}}', $studly, $stub);

        $camel = Str::camel($this->argument('name'));
        $stub = str_replace('{{camelCase}}', $camel, $stub);

        return $stub;

    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/events/master.deleted.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Events';
    }
}
