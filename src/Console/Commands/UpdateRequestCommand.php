<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use function ltrim;
use function str_replace;
use function trim;

class UpdateRequestCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:update-request
                            {name : The name of the update request}
                            {fields* : The update request fields}';

    protected $description = 'Create a update request';

    protected $type = 'Update Request';

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');
        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $LastNameBefore = Str::of($name)->afterLast('\\');
        $lastNameAfter = Str::of($name)->afterLast('\\')->studly()->prepend("Update")->append("Request");
        $name = str_replace($LastNameBefore, $lastNameAfter, $name);

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name;
    }

    protected function replaceClass($stub, $name)
    {
        $name = Str::studly($this->argument('name'));
        $stub = str_replace('{{StudlyCase}}', $name, $stub);

        $rules = "";
        foreach ($this->argument('fields') as $field) {
            $rules .= "'$field' => [required],";
        }

        return str_replace('DummyRules', $rules, $stub);

    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/requests/update.request.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Requests';
    }
}
