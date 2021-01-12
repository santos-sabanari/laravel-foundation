<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use function str_replace;
use const DIRECTORY_SEPARATOR;

class ReportDatatableCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:report-datatable
                            {name : The name of the report datatable}';

    protected $description = 'Create a report datatable';

    protected $type = 'Report Datatable';

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');
        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\IndexDatatable';
    }

    protected function replaceClass($stub, $name)
    {
        $studly = Str::studly($this->argument('name'));
        $stub = str_replace('{{StudlyCase}}', $studly, $stub);

        $camel = Str::camel($this->argument('name'));
        $stub = str_replace('{{camelCase}}', $camel, $stub);

        $firstword = Str::title(str_replace('-',' ',$this->argument('name')));
        $stub = str_replace('{{FirstWordCase}}', $firstword, $stub);

        $lower = Str::lower($this->argument('name'));
        $stub = str_replace('{{lowerCase}}', $lower, $stub);

        return $stub;

    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/datatables/report.datatable.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        $name = Str::studly($this->argument('name'));

        return $rootNamespace . '\Http\Livewire\\' . Str::studly(config('laravel-foundation.namespace')). '\\Report\\'. $name;
    }
}
