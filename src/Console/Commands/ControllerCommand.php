<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use function str_replace;

class ControllerCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:controller
                            {name : The name of the controller}
                            {fields* : The controller fields}';

    protected $description = 'Create a controller';

    protected $type = 'Controller';

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');
        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $LastNameBefore = Str::of($name)->afterLast('\\');
        $lastNameAfter = Str::of($name)->afterLast('\\')->studly()->append("Controller");
        $name = str_replace($LastNameBefore, $lastNameAfter, $name);

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name;
    }

    protected function replaceClass($stub, $name)
    {
        $studly = Str::studly($this->argument('name'));
        $stub = str_replace('{{StudlyCase}}', $studly, $stub);

        $camel = Str::camel($this->argument('name'));
        $stub = str_replace('{{camelCase}}', $camel, $stub);

        $lowerNamespace = Str::lower(config('laravel-foundation.namespace'));
        $stub = str_replace('{{lowerCaseNamespace}}', $lowerNamespace, $stub);

        $studlyNamespace = Str::studly(config('laravel-foundation.namespace'));
        $stub = str_replace('{{StudlyNamespace}}', $studlyNamespace, $stub);

        return $stub;
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/controllers/master.controller.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers\\'. Str::studly(config('laravel-foundation.namespace'));
    }
}
