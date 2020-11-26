<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class CreateFormLivewireCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:create-form-livewire
                            {name : The name of the create form livewire}
                            {fields* : The create form livewire fields}';

    protected $description = 'Create a create form livewire';

    protected $type = 'Create Form';

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');
        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $LastNameBefore = Str::of($name)->afterLast('\\');
        $lastNameAfter = Str::of($name)->afterLast('\\')->studly();
        $name = str_replace($LastNameBefore, $lastNameAfter, $name);

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\CreateForm';
    }

    protected function replaceClass($stub, $name)
    {
        $name = Str::studly($this->argument('name'));
        $stub = str_replace('{{StudlyCase}}', $name, $stub);

        $camel = Str::camel($this->argument('name'));
        $stub = str_replace('{{camelCase}}', $camel, $stub);

        $lowerNamespace = Str::lower(config('laravel-foundation.namespace'));
        $stub = str_replace('{{lowerCaseNamespace}}', $lowerNamespace, $stub);

        $fields = [];
        $rules = [];
        $attributes = [];
        foreach ($this->argument('fields') as $field) {
            $fields[] = "public $$field;";
            $rules[] = "'$field' => 'required',";
            $attributes[] = "'$field' => '$field',";
        }

        $text = implode("\n\t", $fields);
        $textrules = implode("\n\t\t", $rules);
        $textattributes = implode("\n\t\t", $attributes);

        $stub = str_replace('DummyFieldsAttributes', $textattributes, $stub);
        $stub = str_replace('DummyFieldsRules', $textrules, $stub);
        $stub = str_replace('DummyFields', $text, $stub);

        return $stub;
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/livewire/master.create.form.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        $name = Str::studly($this->argument('name'));
        return $rootNamespace . '\Http\Livewire\\'. Str::studly(config('laravel-foundation.namespace')).'\\'.$name;
    }
}
