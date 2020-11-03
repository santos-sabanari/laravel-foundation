<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ListenerCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:listener
                            {name : The name of the listener}
                            {fields* : The listener fields}';

    protected $description = 'Create a listener';

    protected $type = 'Listener';

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');
        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $LastNameBefore = Str::of($name)->afterLast('\\');
        $lastNameAfter = Str::of($name)->afterLast('\\')->studly()->append("EventListener");
        $name = str_replace($LastNameBefore, $lastNameAfter, $name);

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name;
    }

    protected function replaceClass($stub, $name)
    {
        $studly = Str::studly($this->argument('name'));
        $stub = str_replace('{{StudlyCase}}', $studly, $stub);

        $camel = Str::camel($this->argument('name'));
        $stub = str_replace('{{camelCase}}', $camel, $stub);

        $properties = [];
        foreach ($this->argument('fields') as $field) {
            $properties[] = "'$field' => ".'$event'."->$camel->$field,";
        }

        $text = implode("\n\t\t\t\t\t", $properties);

        return str_replace('DummyProperties', $text, $stub);

    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/listeners/master.event.listener.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Listeners';
    }
}
