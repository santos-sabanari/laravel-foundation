<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class SeederReportCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:seeder-report
                            {name : The name of the seeder}';

    protected $description = 'Create a seeder';

    protected $type = 'Seeder Report';

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'seeders' . '/' . str_replace('\\', '/', $name) . '.php';
    }

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');
        $name = str_replace('/', '\\', $name);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $LastNameBefore = Str::of($name)->afterLast('\\');
        $lastNameAfter = Str::of($name)->afterLast('\\')->studly()->append("Seeder");
        $name = str_replace($LastNameBefore, $lastNameAfter, $name);

        return $name;
    }

    protected function replaceClass($stub, $name)
    {
        $name = $this->argument('name');

        $stub = str_replace('{{StudlyCase}}', Str::studly($name), $stub);
        $stub = str_replace('{{lowerCase}}', Str::lower($name), $stub);
        $stub = str_replace('{{camelCase}}', Str::camel($name), $stub);
        $stub = str_replace('{{FirstWordCase}}', Str::title(str_replace('-',' ',$name)), $stub);

        $lowerNamespace = Str::lower(config('laravel-foundation.namespace'));
        $stub = str_replace('{{lowerCaseNamespace}}', $lowerNamespace, $stub);

        return $stub;
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/database/seeder-report.stub';

    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return 'Database\Seeders';
    }
}
