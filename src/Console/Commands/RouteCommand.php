<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class RouteCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:route
                            {name : The name of the route}
                            {fields* : The route fields}';

    protected $description = 'Create a route';

    protected $type = 'Route';

    public function handle()
    {
        $name = $this->argument('name');
        $stub = str_replace('{{StudlyCase}}', Str::studly($name), file_get_contents($this->getStub()));
        $stub = str_replace('{{lowerCase}}', Str::lower($name), $stub);
        $stub = str_replace('{{camelCase}}', Str::camel($name), $stub);
        $stub = str_replace('{{FirstWordCase}}', Str::title(str_replace('-',' ',$name)), $stub);

        $lowerNamespace = Str::lower(config('laravel-foundation.namespace'));
        $stub = str_replace('{{lowerCaseNamespace}}', $lowerNamespace, $stub);

        file_put_contents(
            base_path('routes/web.php'),
            $stub,
            FILE_APPEND
        );
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/routes/master.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return '';
    }
}
