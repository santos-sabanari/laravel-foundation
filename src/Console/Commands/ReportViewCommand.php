<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ReportViewCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:report-view
                            {name : The name of the view}';

    protected $description = 'Create a report view';

    protected $type = 'Report View';


    protected function getPath($name)
    {
        $lowerNamespace = Str::lower(config('laravel-foundation.namespace'));

        return $this->laravel->resourcePath() . DIRECTORY_SEPARATOR . 'views/' . $lowerNamespace . '/report/' . str_replace('\\', '/', $name) . '/index.blade.php';
    }

    protected function qualifyClass($name)
    {
        return Str::lower($name);
    }

    protected function replaceClass($stub, $name)
    {
        $studly = Str::studly($this->argument('name'));
        $stub = str_replace('{{StudlyCase}}', $studly, $stub);

        $lower = Str::lower($this->argument('name'));
        $stub = str_replace('{{lowerCase}}', $lower, $stub);

        $camel = Str::camel($this->argument('name'));
        $stub = str_replace('{{camelCase}}', $camel, $stub);

        $firstword = Str::title(str_replace('-', ' ', $this->argument('name')));
        $stub = str_replace('{{FirstWordCase}}', $firstword, $stub);

        $lowerNamespace = Str::lower(config('laravel-foundation.namespace'));
        $stub = str_replace('{{lowerCaseNamespace}}', $lowerNamespace, $stub);

        return $stub;
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/view/report-index.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return '';
    }
}
