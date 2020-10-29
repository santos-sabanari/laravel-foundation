<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use function implode;
use function ltrim;
use function str_replace;
use function trim;

class EditRequestCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:edit-request
                            {name : The name of the edit request}
                            {fields* : The edit request fields}';

    protected $description = 'Create a edit request';

    protected $type = 'Edit Request';

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');
        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $LastNameBefore = Str::of($name)->afterLast('\\');
        $lastNameAfter = Str::of($name)->afterLast('\\')->studly()->prepend("Edit")->append("Request");
        $name = str_replace($LastNameBefore, $lastNameAfter, $name);

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name;
    }

    protected function replaceClass($stub, $name)
    {
        $name = Str::studly($this->argument('name'));
        $stub = str_replace('{{StudlyCase}}', $name, $stub);

        $rules = [];
        foreach ($this->argument('fields') as $field) {
            $rules [] = "'$field' => [required],";
        }

        $text = implode("\n\t\t\t", $rules);

        return str_replace('DummyRules', $text, $stub);

    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/requests/edit.request.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Requests';
    }
}
