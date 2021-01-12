<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ReportFormLivewireCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:report-form-livewire
                            {name : The name of the create form livewire}';

    protected $description = 'Create a report form livewire';

    protected $type = 'Report Form';

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');
        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\Report\\IndexForm';
    }

    protected function replaceClass($stub, $name)
    {
        $name = Str::studly($this->argument('name'));
        $stub = str_replace('{{StudlyCase}}', $name, $stub);

        $camel = Str::camel($this->argument('name'));
        $stub = str_replace('{{camelCase}}', $camel, $stub);

        $lower = Str::lower($this->argument('name'));
        $stub = str_replace('{{lowerCase}}', $lower, $stub);

        $firstword = Str::title(str_replace('-',' ',$this->argument('name')));
        $stub = str_replace('{{FirstWordCase}}', $firstword, $stub);

        $lowerNamespace = Str::lower(config('laravel-foundation.namespace'));
        $stub = str_replace('{{lowerCaseNamespace}}', $lowerNamespace, $stub);

        return $stub;
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/livewire/report.form.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        $name = Str::studly($this->argument('name'));
        return $rootNamespace . '\Http\Livewire\\'. Str::studly(config('laravel-foundation.namespace')).'\\Report\\'.$name;
    }
}
