<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use function ltrim;
use function str_replace;
use function trim;

class ModelCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:model
                            {name : The name of the model}
                            {fields* : The model fields}';

    protected $description = 'Create a model';

    protected $type = 'Model';

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

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name;
    }

    protected function replaceClass($stub, $name)
    {
        $studly = Str::studly($this->argument('name'));
        $stub = str_replace('{{StudlyCase}}', $studly, $stub);


        $fillable = "";
        foreach ($this->argument('fields') as $field) {
            $fillable .= "$field,";
        }

        return str_replace('DummyFillable', $fillable, $stub);
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/database/model.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models';
    }
}
