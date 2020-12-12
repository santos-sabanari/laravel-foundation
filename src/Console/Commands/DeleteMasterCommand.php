<?php

namespace SantosSabanari\LaravelFoundation\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class DeleteMasterCommand extends GeneratorCommand
{
    protected $signature = 'laravel-foundation:delete-master
                            {name : The name of the master}';

    protected $description = 'Delete a master generated by package';

    protected $type = 'Remove Master';

    public function handle()
    {
        $name = $this->argument('name');
        $firstword = Str::title(str_replace('-',' ',$name));
        $studly = Str::studly($name);
        $camel = Str::camel($name);

        $this->info('Remove Master ' . $firstword);

        (new Filesystem())->delete(app_path("Services/$studly"."Service.php"));
        (new Filesystem())->delete(app_path("Models/$studly.php"));
        (new Filesystem())->delete(app_path("Events/$studly"."Created.php"));
        (new Filesystem())->delete(app_path("Events/$studly"."Deleted.php"));
        (new Filesystem())->delete(app_path("Events/$studly"."Updated.php"));
        (new Filesystem())->delete(app_path("Traits/$studly"."Attribute.php"));
        (new Filesystem())->delete(app_path("Traits/$studly"."Method.php"));
        (new Filesystem())->delete(app_path("Traits/$studly"."Scope.php"));
        (new Filesystem())->delete(app_path("Listeners/$studly"."EventListener.php"));
        (new Filesystem())->delete(database_path("factories/$studly"."Factory.php"));
        (new Filesystem())->delete(database_path("seeders/$studly"."Seeder.php"));
        (new Filesystem())->deleteDirectory(app_path("Http/Livewire/Backend/$studly"));
        (new Filesystem())->delete(app_path("Http/Controllers/Backend/$studly"."Controller.php"));
        (new Filesystem())->deleteDirectory(resource_path("views/backend/$name"));
        (new Filesystem())->deleteDirectory(resource_path("views/livewire/backend/$name"));

        $this->comment('Please remove manually:');
        $this->comment('1. Migration');
        $this->comment('2. Web Route');

        $this->info('Remove Master ' . $name . ' done!');
    }

    protected function getStub()
    {
        return '';
    }
}
