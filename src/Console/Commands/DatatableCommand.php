<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use function str_replace;
use const DIRECTORY_SEPARATOR;

class DatatableCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:datatable
                            {name : The name of the datatable}
                            {fields* : The datatable fields}';

    protected $description = 'Create a datatable';

    protected $type = 'Datatable';

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');
        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $LastNameBefore = Str::of($name)->afterLast('\\');
        $lastNameAfter = Str::of($name)->afterLast('\\')->plural()->studly()->append("Datatable");
        $name = str_replace($LastNameBefore, $lastNameAfter, $name);

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name;
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

        $columns = [];
        foreach ($this->argument('fields') as $field) {
            $field = Str::title(str_replace('_',' ',$field));
            $columns[] = "Column::make(__('$field'))->searchable()->sortable(),";
        }

        $text = implode("\n\t\t\t", $columns);

        return str_replace('DummyColumns', $text, $stub);

    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/datatables/master.datatable.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        $name = Str::studly($this->argument('name'));

        return $rootNamespace . '\Http\Livewire\\' . Str::studly(config('laravel-foundation.namespace')). '\\'. $name;
    }
}
