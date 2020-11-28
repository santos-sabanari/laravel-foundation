<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ViewCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:view
                            {name : The name of the view}
                            {fields* : The view fields}
                            {--type= : The type for creating view}';

    protected $description = 'Create a view';

    protected $type = 'View';


    protected function getPath($name)
    {
        $lowerNamespace = Str::lower(config('laravel-foundation.namespace'));
        $lowerType = Str::lower($this->option('type'));

        $path = $this->laravel->resourcePath() . DIRECTORY_SEPARATOR . 'views/' . $lowerNamespace . '/' . str_replace('\\', '/', $name) . "/$lowerType" . '.blade.php';
        if ($lowerType == 'action') {
            $path = $this->laravel->resourcePath() . DIRECTORY_SEPARATOR . 'views/' . $lowerNamespace . '/' . str_replace('\\', '/', $name) . "/includes/$lowerType" . '.blade.php';
        }

        return $path;
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


        if ($this->option('type') == 'show') {
            $fieldRows = [];
            foreach ($this->argument('fields') as $field) {
                $fieldRow = str_replace('DummyField', Str::studly($field), file_get_contents(__DIR__ . '/stubs/view/show.field.stub'));
                $fieldRow = str_replace('LowerCaseField', Str::lower($field), $fieldRow);
                $fieldRow = str_replace('{{camelCase}}', $camel, $fieldRow);

                $fieldRows[] = $fieldRow;
            }

            $text = implode("\n\t\t\t", $fieldRows);

            $stub = str_replace('DummyFields', $text, $stub);
        }

        return $stub;
    }

    protected function getStub()
    {
        if ($this->option('type') == 'index') {
            return __DIR__ . '/stubs/view/index.stub';
        } elseif ($this->option('type') == 'create') {
            return __DIR__ . '/stubs/view/create.stub';
        } elseif ($this->option('type') == 'edit') {
            return __DIR__ . '/stubs/view/edit.stub';
        } elseif ($this->option('type') == 'show') {
            return __DIR__ . '/stubs/view/show.stub';
        } elseif ($this->option('type') == 'action') {
            return __DIR__ . '/stubs/view/includes/actions.stub';
        }

        return __DIR__ . '/stubs/view/index.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return '';
    }
}
